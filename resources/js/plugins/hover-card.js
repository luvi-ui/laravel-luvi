export default function (Alpine) {
    Alpine.directive("hover-card", (el, directive) => {
        if (!directive.value) handleRoot(el, Alpine);
        else if (directive.value === "trigger") handleTrigger(el, Alpine);
        else if (directive.value === "content") handleContent(el, Alpine);
    }).before("bind");
}

function handleRoot(el, Alpine) {
    Alpine.bind(el, {
        "x-id"() {
            return ["alpine-hover-card", "alpine-hover-card-trigger"];
        },
        ":id"() {
            return this.$id("alpine-hover-card");
        },
        "x-data"() {
            return {
                __open: false,
                __openDelay: 700,
                __closeDelay: 300,
                __close() {
                    this.__open = false;
                },
            };
        },
    });
}

function handleTrigger(el, Alpine) {
    Alpine.bind(el, {
        "x-ref": "__hover-card-trigger",
        ":id"() {
            return this.$id("alpine-hover-card-trigger");
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
        // "x-anchor"() {
        //     return document.getElementById(
        //         this.$id("alpine-hover-card-trigger"),
        //     );
        // },
    });
}
