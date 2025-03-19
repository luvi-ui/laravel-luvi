export default function (Alpine) {
    Alpine.store("toasts", {
        items: [],
        defaultDuration: 3000,
        maxToasts: 5,
        toastQueue: [],
        activeTimers: {},

        init() {
            window.showToast = (
                message,
                type = "default",
                theme = "light",
                duration = null,
                action = null
            ) => {
                if (
                    !message ||
                    typeof message !== "string" ||
                    message.trim() === ""
                ) {
                    console.error("Toast message cannot be empty");
                    return;
                }

                Alpine.store("toasts").createToast(
                    message,
                    type,
                    theme,
                    duration,
                    action
                );
            };
        },

        processQueue() {
            if (
                this.toastQueue.length === 0 ||
                this.items.length >= this.maxToasts
            )
                return;

            const nextToast = this.toastQueue.shift();
            this.addToastToDisplay(
                nextToast.message,
                nextToast.type,
                nextToast.theme,
                nextToast.duration,
                nextToast.action
            );
        },

        createToast(
            message,
            type = "default",
            theme = "light",
            duration = null,
            action = null
        ) {
            if (
                !message ||
                typeof message !== "string" ||
                message.trim() === ""
            ) {
                console.error("Toast message cannot be empty");
                return;
            }

            if (this.items.length >= this.maxToasts) {
                this.toastQueue.push({
                    message,
                    type,
                    theme,
                    duration,
                    action,
                });
            } else {
                this.addToastToDisplay(message, type, theme, duration, action);
            }
        },

        addToastToDisplay(
            message,
            type = "default",
            theme = "light",
            duration = null,
            action = null
        ) {
            const id = Date.now() + Math.floor(Math.random() * 1000);
            const actualDuration =
                duration !== null ? duration : this.defaultDuration;

            let actionLabel = null;
            let actionCallback = null;

            if (action) {
                if (typeof action === "string") {
                    actionLabel = action;
                    actionCallback = () => this.removeToastWithAnimation(id);
                } else if (
                    typeof action === "object" &&
                    action.label &&
                    typeof action.callback === "function"
                ) {
                    actionLabel = action.label;
                    actionCallback = action.callback;
                }
            }

            const toast = {
                id,
                message,
                type,
                theme,
                duration: actualDuration,
                show: false,
                actionLabel,
                actionCallback,
                remainingTime: actualDuration,
                startTime: 0,
                isPaused: false,
            };

            this.items.push(toast);

            requestAnimationFrame(() => {
                setTimeout(() => {
                    const t = this.items.find((t) => t.id === id);
                    if (t) {
                        t.show = true;
                        t.startTime = Date.now();
                    }
                }, 20);
            });

            if (actualDuration > 0) {
                this.activeTimers[id] = setTimeout(() => {
                    this.removeToastWithAnimation(id);
                }, actualDuration);
            }
        },

        pauseToast(id) {
            const toast = this.items.find((t) => t.id === id);
            if (!toast || toast.duration <= 0) return;
            if (this.activeTimers[id]) {
                clearTimeout(this.activeTimers[id]);
                delete this.activeTimers[id];
            }
            if (!toast.isPaused && toast.startTime > 0) {
                const elapsedTime = Date.now() - toast.startTime;
                toast.remainingTime = Math.max(0, toast.duration - elapsedTime);
            }

            toast.isPaused = true;
        },

        resumeToast(id) {
            const toast = this.items.find((t) => t.id === id);
            if (!toast || toast.duration <= 0 || !toast.isPaused) return;

            toast.isPaused = false;
            toast.startTime = Date.now();
            this.activeTimers[id] = setTimeout(() => {
                this.removeToastWithAnimation(id);
            }, toast.remainingTime);
        },

        handleAction(toast) {
            if (
                toast.actionCallback &&
                typeof toast.actionCallback === "function"
            ) {
                toast.actionCallback(toast);
            }
            this.removeToastWithAnimation(toast.id);
        },

        removeToastWithAnimation(id) {
            const toastIndex = this.items.findIndex((t) => t.id === id);

            if (toastIndex === -1) return;
            if (this.activeTimers[id]) {
                clearTimeout(this.activeTimers[id]);
                delete this.activeTimers[id];
            }

            this.items[toastIndex].show = false;

            setTimeout(() => {
                this.items = this.items.filter((toast) => toast.id !== id);
                this.processQueue();
            }, 300);
        },
    });
}
