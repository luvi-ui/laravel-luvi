export default function (Alpine) {
    Alpine.directive("accordion", (el, directive) => {
        if (!directive.value) handleRoot(el, Alpine);
        else if (directive.value === "item") handleItem(el, Alpine);
        else if (directive.value === "trigger") handleTrigger(el, Alpine);
        else if (directive.value === "content") handleContent(el, Alpine);
    }).before("bind");
}

function handleRoot(el, Alpine) {
    const active = el.getAttribute("defaultValue")
        ? [el.getAttribute("defaultValue")]
        : [];
    const multiple = el.getAttribute("type") === "multiple" ? true : false;
    // prettier-ignore
    const collapsible = el.getAttribute("collapsible") === "collapsible" ? true : false;

    Alpine.bind(el, {
        "x-id"() {
            return ["alpine-accordion"];
        },
        ":id"() {
            return this.$id("alpine-accordion");
        },
        "x-data"() {
            return {
                __multiple: multiple,
                __collapsible: collapsible,
                __active: active,

                __isOpen(item) {
                    return this.__active.includes(item);
                },

                __toggle(item) {
                    if (
                        this.__isOpen(item) &&
                        (this.__collapsible || this.__multiple)
                    ) {
                        return this.__remove(item);
                    }

                    this.__add(item);
                },

                __add(item) {
                    if (this.__multiple) {
                        return this.__active.push(item);
                    }

                    this.__active = [item];
                },

                __remove(item) {
                    if (this.__multiple) {
                        return (this.__active = this.__active.filter(
                            (activeItem) => activeItem !== item,
                        ));
                    }

                    this.__active = [];
                },

                __getDataState(item) {
                    return this.__isOpen(item) ? "open" : "closed";
                },
            };
        },
    });
}

function handleItem(el, Alpine) {
    Alpine.bind(el, {
        // "x-show"() {
        //     return this.$data.__open;
        // },
    });
}

function handleTrigger(el, Alpine) {
    Alpine.bind(el, {
        "x-ref": "__accordion-trigger",
        ":id"() {
            return this.$id("alpine-accordion-trigger");
        },
        "@click"() {
            this.$data.__open = !this.$data.__open;
        },
    });
}

function handleContent(el, Alpine) {
    Alpine.bind(el, {
        "x-show"() {
            return this.$data.__open;
        },
    });
}
