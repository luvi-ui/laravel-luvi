export default function (Alpine) {
    Alpine.directive("sidebar", (el, directive) => {
        if (!directive.value) handleRoot(el, Alpine, JSON.parse(el.dataset.options));
        else if (directive.value === "trigger") handleTrigger(el, Alpine);
        else if (directive.value === "collapsible") handleCollapsible(el, Alpine, el.dataset.icon, el.dataset.offcanvas);
    }).before("bind");
}

function handleRoot(el, Alpine, options) {
    const savedState = localStorage.getItem('sidebar-open');
    const isOpen = savedState !== null ? JSON.parse(savedState) : false;

    Alpine.bind(el, {
        "x-data"() {
            return {
                __open: isOpen,
                __collapsible: options.collapsible,
                __toggle() {
                    this.__open = !this.__open;
                    localStorage.setItem('sidebar-open', JSON.stringify(this.__open));
                }
            };
        },
    });
}

function handleTrigger(el, Alpine) {
    Alpine.bind(el, {
        "@click"() {
            this.$data.__toggle();
            console.log(this.$data.__open);
        },
    });
}

function handleCollapsible(el, Alpine, icon, offcanvas) {
    Alpine.bind(el, {
        ":class"() {
            if (!this.$data.__open) {
                if (this.$data.__collapsible == "offcanvas") return offcanvas;
                else if (this.$data.__collapsible == "icon") return icon;

                return "";
            }
        }
    });
}