export default function (Alpine) {
    Alpine.directive("form", (el, directive) => {
        if (!directive.value) handleRoot(el, Alpine);
        else if (directive.value === "item") handleItem(el, Alpine);
        else if (directive.value === "label") handleLabel(el, Alpine);
        else if (directive.value === "control") handleControl(el, Alpine);
        else if (directive.value === "description")
            handleDescription(el, Alpine);
        else if (directive.value === "message")
            handleMessage(el, Alpine, directive.modifiers);
    }).before("bind");
}

function handleRoot(el, Alpine) {}

function handleItem(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            "x-id"() {
                return [
                    "form-item",
                    "form-item-control",
                    "form-item-description",
                    "form-item-message",
                ];
            },
            "x-data"() {
                return {
                    __error: false,
                    init() {
                        this.__error = Alpine.extractProp(el, "error", false);
                    },
                };
            },
            ":id"() {
                return this.$id("form-item");
            },
        };
    });
}

function handleLabel(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            ":for"() {
                return this.$id("form-item-control");
            },
        };
    });
}

function handleControl(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            ":id"() {
                return this.$id("form-item-control");
            },
            ":aria-invalid"() {
                return this.$data.__error;
            },
            ":aria-describedby"() {
                return this.$id("form-item-description");
            },
            ":aria-errormessage"() {
                return this.$id("form-item-message");
            },
        };
    });
}

function handleDescription(el, Alpine) {
    Alpine.bind(el, () => {
        return {
            ":id"() {
                return this.$id("form-item-description");
            },
        };
    });
}

function handleMessage(el, Alpine, modifiers) {
    Alpine.bind(el, () => {
        return {
            ":id"() {
                return this.$id("form-item-message");
            },
            ":aria-live"() {
                return getAriaLive(modifiers);
            },
        };
    });
}

function getAriaLive(modifiers) {
    if (!modifiers.length) return "off";

    let types = ["polite", "assertive", "off"];
    return types.find((i) => modifiers.includes(i));
}
