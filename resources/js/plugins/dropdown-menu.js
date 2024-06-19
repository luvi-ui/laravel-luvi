export default function (Alpine) {
    Alpine.directive("dropdown-menu", (el, directive) => {
        if (!directive.value) handleRoot(el, Alpine);
        else if (directive.value === "items") handleItems(el, Alpine);
        else if (directive.value === "item") handleItem(el, Alpine);
        else if (directive.value === "checkboxitem")
            handleCheckboxItem(el, Alpine);
        else if (directive.value === "radiogroup") handleRadioGroup(el, Alpine);
        else if (directive.value === "radioitem") handleRadioItem(el, Alpine);
        else if (directive.value === "button") handleButton(el, Alpine);
        else if (directive.value === "sub") handleSubRoot(el, Alpine);
        else if (directive.value === "subitems") handleSubItems(el, Alpine);
        else if (directive.value === "subbutton") handleSubButton(el, Alpine);
    }).before("bind");
}

function handleRoot(el, Alpine) {
    Alpine.bind(el, {
        "x-id"() {
            return [
                "alpine-dropdown-menu",
                "alpine-dropdown-menu-button",
                "alpine-dropdown-menu-items",
            ];
        },
        ":id"() {
            return this.$id("alpine-dropdown-menu");
        },
        "x-modelable": "__isOpen",
        "x-data"() {
            return {
                __itemEls: [],
                __firstEl: null,
                __lastEl: null,
                __activeEl: null,
                __isOpen: false,
                __next() {
                    let nextElement =
                        this.__itemEls.indexOf(document.activeElement) + 1;

                    if (nextElement > this.__itemEls.length - 1) {
                        return this.__firstEl.focus();
                    }

                    this.__itemEls[nextElement].focus();
                },
                __previous() {
                    let previousElement =
                        this.__itemEls.indexOf(document.activeElement) - 1;

                    if (previousElement < 0) {
                        return this.__lastEl.focus();
                    }

                    this.__itemEls[previousElement].focus();
                },
                __open(activationStrategy = "__firstEl") {
                    this.__isOpen = true;

                    this.$nextTick(() => {
                        activationStrategy &&
                            this[activationStrategy].focus({
                                preventScroll: true,
                            });
                    });
                },
                __close(focusAfter = true) {
                    this.__isOpen = false;

                    focusAfter &&
                        this.$nextTick(() =>
                            this.$refs.__button.focus({ preventScroll: true }),
                        );
                },
            };
        },
        "@keydown.tab"() {
            this.__close(false);
        },
    });
}

function handleButton(el, Alpine) {
    Alpine.bind(el, {
        "x-ref": "__button",
        "aria-haspopup": "true",
        ":aria-labelledby"() {
            return this.$id("alpine-dropdown-menu-label");
        },
        ":id"() {
            return this.$id("alpine-dropdown-menu-button");
        },
        ":aria-expanded"() {
            return this.$data.__isOpen;
        },
        ":aria-controls"() {
            return (
                this.$data.__isOpen && this.$id("alpine-dropdown-menu-items")
            );
        },
        "x-init"() {
            if (
                this.$el.tagName.toLowerCase() === "button" &&
                !this.$el.hasAttribute("type")
            )
                this.$el.type = "button";
        },
        "@click"() {
            this.$data.__open();
        },
        "@keydown.down.stop.prevent"() {
            this.$data.__open();
        },
        "@keydown.up.stop.prevent"() {
            this.$data.__open("__lastEl");
        },
        "@keydown.space.stop.prevent"() {
            this.$data.__open();
        },
        "@keydown.enter.stop.prevent"() {
            this.$data.__open();
        },
    });
}

// When patching children:
// The child isn't initialized until it is reached. This is normally fine
// except when something like this happens where an "id" is added during the initializing phase
// because the "to" element hasn't initialized yet, it doesn't have the ID, so there is a "key" mismatch

function handleItems(el, Alpine) {
    Alpine.bind(el, {
        "x-ref": "__items",
        "aria-orientation": "vertical",
        role: "menu",
        ":id"() {
            return this.$id("alpine-dropdown-menu-items");
        },
        ":aria-labelledby"() {
            return this.$id("alpine-dropdown-menu-button");
        },
        ":aria-activedescendant"() {
            return this.$data.__activeEl && this.$data.__activeEl.id;
        },
        "x-show"() {
            return this.$data.__isOpen;
        },
        "x-init"() {
            this.$data.__itemEls = Array.from(
                this.$el.querySelectorAll(
                    [
                        // descendents
                        ':scope > li[role^="menuitem"]',
                        // submenu trigger
                        ':scope > li[role="none"] > div[role="menuitem"]',
                        // descendents in a group
                        ':scope > li[role="none"] > ul[role="group"] > li[role^="menuitem"]',
                        // submenu trigger in a group
                        ':scope > li[role="none"] > ul[role="group"] > li[role="none"] > div[role="menuitem"]',
                    ].join(", "),
                ),
            );
            this.$data.__firstEl = this.$data.__itemEls[0];
            this.$data.__lastEl =
                this.$data.__itemEls[this.$data.__itemEls.length - 1];
        },
        "@click.outside"() {
            this.$data.__close();
        },
        "@keydown"(e) {
            if (this.$data.__itemEls.indexOf(e.target) < 0) return;
            dom.search(Alpine, this.$data.__itemEls, e.key, (el) => el.focus());
        },
        "@keydown.down.stop.prevent"() {
            this.$data.__next();
        },
        "@keydown.up.stop.prevent"() {
            this.$data.__previous();
        },
        "@keydown.home.stop.prevent"() {
            this.$data.__firstEl.focus();
        },
        "@keydown.end.stop.prevent"() {
            this.$data.__lastEl.focus();
        },
        "@keydown.page-up.stop.prevent"() {
            this.$data.__firstEl.focus();
        },
        "@keydown.page-down.stop.prevent"() {
            this.$data.__lastEl.focus();
        },
        "@keydown.escape.stop.prevent"() {
            this.$data.__close();
        },
    });
}

function handleItem(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            "x-data"() {
                return {
                    __isDisabled: false,
                    init() {
                        this.__isDisabled = this.$el.ariaDisabled === "true";
                    },
                };
            },
            "x-id"() {
                return ["alpine-dropdown-menu-item"];
            },
            ":id"() {
                return this.$id("alpine-dropdown-menu-item");
            },
            "@mousemove"() {
                this.$el.focus();
            },
            "@keydown.space.stop.prevent"() {
                if (this.__isDisabled) return;
                this.$el.click();
            },
            "@keydown.enter.stop.prevent"() {
                if (this.__isDisabled) return;
                this.$el.click();
                this.$data.__close();
            },
            // Required for firefox, event.preventDefault() in handleKeyDown for
            // the Space key doesn't cancel the handleKeyUp, which in turn
            // triggers a *click*.
            "@keyup.space.prevent"() {},
        };
    });
}

function handleCheckboxItem(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            "x-data"() {
                return {
                    __isDisabled: false,
                    __isChecked: false,
                    __toggle() {
                        this.__isChecked = !this.__isChecked;
                    },
                    init() {
                        this.__isDisabled = this.$el.ariaDisabled === "true";
                    },
                };
            },
            "x-modelable": "__isChecked",
            "x-id"() {
                return ["alpine-dropdown-menu-item"];
            },
            ":id"() {
                return this.$id("alpine-dropdown-menu-item");
            },
            ":aria-checked": "__isChecked",
            "@click"() {
                if (this.__isDisabled) return;
                this.__toggle();
            },
            "@mousemove"() {
                this.$el.focus();
            },
            "@keydown.space.stop.prevent"() {
                if (this.__isDisabled) return;
                this.__toggle();
            },
            "@keydown.enter.stop.prevent"() {
                if (this.__isDisabled) return;
                this.__toggle();
                this.$data.__close();
            },
            // Required for firefox, event.preventDefault() in handleKeyDown for
            // the Space key doesn't cancel the handleKeyUp, which in turn
            // triggers a *click*.
            "@keyup.space.prevent"() {},
        };
    });
}

function handleRadioGroup(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            "x-data"() {
                return {
                    __isDisabled: false,
                    __selected: null,
                    __defaultValue: "",
                    // FIX:
                    //__proxyIsChecked is a duplicate of __isChecked but
                    //__isChecked does not work because of x-modelable?!
                    __proxyIsChecked(value) {
                        return value === this.__selected;
                    },
                    __isChecked(value) {
                        return value === this.__selected;
                    },
                    __toggle() {
                        this.__isChecked = !this.__isChecked;
                    },
                    init(defaultValue) {
                        this.__selected = defaultValue;
                    },
                };
            },
            "x-modelable": "__isChecked",
            "x-id"() {
                return ["alpine-dropdown-menu-item"];
            },
            ":id"() {
                return this.$id("alpine-dropdown-menu-item");
            },
            ":aria-checked": "__isChecked",
            "@input"() {
                if (this.__isDisabled) return;
                this.__selected = this.$event.target.dataset.value;
            },
            "@mousemove"() {
                this.$el.focus();
            },
            "@keydown.space.stop.prevent"() {
                if (this.__isDisabled) return;
                this.$dispatch("input", this.$event);
            },
            "@keydown.enter.stop.prevent"() {
                if (this.__isDisabled) return;
                this.$dispatch("input", this.$event);
                this.$data.__close();
            },
            // Required for firefox, event.preventDefault() in handleKeyDown for
            // the Space key doesn't cancel the handleKeyUp, which in turn
            // triggers a *click*.
            "@keyup.space.prevent"() {},
        };
    });
}

function handleRadioItem(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            "x-data"() {
                return {
                    __isDisabled: false,
                    init() {
                        this.__isDisabled = this.$el.ariaDisabled === "true";
                    },
                };
            },
            "x-modelable": "__isChecked",
            "x-id"() {
                return ["alpine-dropdown-menu-item"];
            },
            ":id"() {
                return this.$id("alpine-dropdown-menu-item");
            },
            ":aria-checked"() {
                return this.$data.__selected;
            },
            "@click"() {
                if (this.__isDisabled) return;
                this.$dispatch("input", this.$event);
            },
            "@mousemove"() {
                this.$el.focus();
            },
            "@keydown.space.stop.prevent"() {
                if (this.__isDisabled) return;
                this.$dispatch("input", this.$event);
            },
            "@keydown.enter.stop.prevent"() {
                if (this.__isDisabled) return;
                this.$dispatch("input", this.$event);
                this.$data.__close();
            },
            // Required for firefox, event.preventDefault() in handleKeyDown for
            // the Space key doesn't cancel the handleKeyUp, which in turn
            // triggers a *click*.
            "@keyup.space.prevent"() {},
        };
    });
}

function handleSubRoot(el, Alpine) {
    Alpine.bind(el, {
        "x-id"() {
            return [
                "alpine-dropdown-menu",
                "alpine-dropdown-menu-button",
                "alpine-dropdown-menu-items",
            ];
        },
        ":id"() {
            return this.$id("alpine-dropdown-menu");
        },
        "x-data"() {
            return {
                __itemEls: [],
                __firstEl: null,
                __lastEl: null,
                __activeEl: null,
                __button: null,
                __isOpen: false,
                __next() {
                    let nextElement =
                        this.__itemEls.indexOf(document.activeElement) + 1;

                    if (nextElement > this.__itemEls.length - 1) {
                        return this.__firstEl.focus();
                    }

                    this.__itemEls[nextElement].focus();
                },
                __previous() {
                    let previousElement =
                        this.__itemEls.indexOf(document.activeElement) - 1;

                    if (previousElement < 0) {
                        return this.__lastEl.focus();
                    }

                    this.__itemEls[previousElement].focus();
                },
                __open(activationStrategy = "__firstEl") {
                    this.__isOpen = true;

                    this.$nextTick(() => {
                        activationStrategy &&
                            this[activationStrategy].focus({
                                preventScroll: true,
                            });
                    });
                },
                __close(focusBefore = true) {
                    focusBefore &&
                        this.__button.focus({
                            preventScroll: true,
                        });
                    this.__isOpen = false;
                },
            };
        },
        "@focusout"() {
            if (this.$el.contains(this.$event.relatedTarget)) return;
            this.$data.__close(false);
        },
    });
}

function handleSubButton(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            "x-ref": "__subbutton",
            "x-data"() {
                return {
                    __isDisabled: false,
                    init() {
                        this.$data.__button = this.$el;
                        this.__isDisabled = this.$el.ariaDisabled === "true";
                    },
                };
            },
            ":aria-expanded"() {
                return this.$data.__isOpen;
            },
            ":id"() {
                return this.$id("alpine-dropdown-menu-button");
            },
            "@keydown.right.stop.prevent"() {
                if (this.__isDisabled) return;
                this.$data.__open();
            },
            "@mousemove"() {
                this.$el.focus();
                if (this.__isDisabled) return;
                this.$data.__open(null);
            },
        };
    });
}

function handleSubItems(el, Alpine) {
    Alpine.bind(el, {
        "x-ref": "__items",
        "aria-orientation": "vertical",
        role: "menu",
        ":id"() {
            return this.$id("alpine-dropdown-menu-items");
        },
        ":aria-labelledby"() {
            return this.$id("alpine-dropdown-menu-button");
        },
        ":aria-activedescendant"() {
            return this.$data.__activeEl && this.$data.__activeEl.id;
        },
        "x-show"() {
            return this.$data.__isOpen;
        },
        "x-init"() {
            this.$data.__itemEls = Array.from(
                this.$el.querySelectorAll(
                    [
                        // descendents
                        ':scope > li[role^="menuitem"]',
                        // submenu trigger
                        ':scope > li[role="none"] > div[role="menuitem"]',
                        // descendents in a group
                        ':scope > li[role="none"] > ul[role="group"] > li[role^="menuitem"]',
                        // submenu trigger in a group
                        ':scope > li[role="none"] > ul[role="group"] > li[role="none"] > div[role="menuitem"]',
                    ].join(", "),
                ),
            );
            this.$data.__firstEl = this.$data.__itemEls[0];
            this.$data.__lastEl =
                this.$data.__itemEls[this.$data.__itemEls.length - 1];
        },
        "@click.outside"() {
            this.$data.__close();
        },
        "@keydown"(e) {
            if (this.$data.__itemEls.indexOf(e.target) < 0) return;
            dom.search(Alpine, this.$data.__itemEls, e.key, (el) => el.focus());
        },
        "@keydown.down.stop.prevent"() {
            this.$data.__next();
        },
        "@keydown.up.stop.prevent"() {
            this.$data.__previous();
        },
        "@keydown.left.stop.prevent"() {
            this.$data.__close();
        },
        "@keydown.home.stop.prevent"() {
            this.$data.__firstEl.focus();
        },
        "@keydown.end.stop.prevent"() {
            this.$data.__lastEl.focus();
        },
        "@keydown.page-up.stop.prevent"() {
            this.$data.__firstEl.focus();
        },
        "@keydown.page-down.stop.prevent"() {
            this.$data.__lastEl.focus();
        },
        "@keydown.escape"() {
            this.$data.__close();
        },
    });
}

let dom = {
    searchQuery: "",
    debouncedClearSearch: undefined,
    clearSearch(Alpine) {
        if (!this.debouncedClearSearch) {
            this.debouncedClearSearch = Alpine.debounce(function () {
                this.searchQuery = "";
            }, 350);
        }

        this.debouncedClearSearch();
    },
    search(Alpine, parentItemEls, key, receiver) {
        if (key.length > 1) return;

        this.searchQuery += key;

        // we have to start searching at the activeElement position
        // so we can iterate over the list with 'p', for ex.:
        // Ping, Pong, Peng
        // clone the itemEls, otherwise we shift the order
        // and destroy keyboard navigation
        let els = Array.from(Alpine.raw(parentItemEls));
        let activeEl = document.activeElement;

        if (activeEl) {
            // get the elements after activeEl
            let decendants = els.splice(els.indexOf(activeEl) + 1);
            // put the decendants in front of the first El to find the last match first
            els.unshift(...decendants);
        }

        let el = els.find((el) => {
            return el.textContent
                .trim()
                .toLowerCase()
                .startsWith(this.searchQuery);
        });

        el && receiver(el);

        this.clearSearch(Alpine);
    },
};
