export default function (Alpine) {
    Alpine.directive("tooltip", (el, directive) => {
        if (!directive.value) handleRoot(el, Alpine);
        else if (directive.value === "trigger") handleTrigger(el, Alpine);
        else if (directive.value === "content") handleContent(el, Alpine);
    }).before("bind");
}

function handleRoot(el, Alpine) {
    Alpine.bind(el, {
        "x-id"() {
            return ["alpine-tooltip", "alpine-tooltip-trigger"];
        },
        ":id"() {
            return this.$id("alpine-tooltip");
        },
        "x-data"() {
            return {
                __open: false,
                __close() {
                    this.__open = false;
                },
            };
        },
    });
}

function handleTrigger(el, Alpine) {
    Alpine.bind(el, {
        "x-ref": "__tooltip-trigger",
        ":id"() {
            return this.$id("alpine-tooltip-trigger");
        },
        "@focusin"() {
            this.$data.__open = !this.$data.__open;
        },
        "@focusout"() {
            this.$data.__close();
        },
        "@mouseenter"() {
            this.$data.__open = !this.$data.__open;
        },
        "@mouseleave"() {
            this.$data.__close();
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
