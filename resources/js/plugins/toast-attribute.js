export default function (Alpine) {
    document.addEventListener("alpine:initialized", () => {
        document
            .querySelectorAll("[toast-message], [data-toast-message]")
            .forEach((el) => {
                if (el.__toastBound) return;
                el.__toastBound = true;
                el.addEventListener("click", (e) => {
                    const getMessage = (attr) =>
                        el.getAttribute(`toast-${attr}`) ||
                        el.getAttribute(`data-toast-${attr}`);
                    const message = getMessage("message");
                    if (!message) return;
                    const duration = getMessage("duration")
                        ? parseInt(getMessage("duration"))
                        : null;
                    const action = getMessage("action") || null;
                    const actionUrl = getMessage("action-url") || null;

                    let toastAction = action;

                    if (action && actionUrl) {
                        toastAction = {
                            label: action,
                            callback: () => (window.location.href = actionUrl),
                        };
                    }

                    window.showToast(message, duration, toastAction);
                });
            });
    });
}
