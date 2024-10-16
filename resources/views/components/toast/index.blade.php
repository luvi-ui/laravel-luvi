@php
    $styles = implode(' ', [
        'group',
        'pointer-events-auto',
        'relative',
        'flex',
        'w-full',
        'items-center',
        'justify-between',
        'space-x-2',
        'overflow-hidden',
        'rounded-md',
        'border',
        'p-4',
        'pr-6',
        'shadow-lg',
        'transition-all',
        'data-[state=open]:animate-in',
        'data-[state=closed]:animate-out',
        'data-[state=closed]:fade-out',
        'data-[state=closed]:slide-out-to-right-full',
        'data-[state=open]:slide-in-from-top-full',
        'data-[state=open]:sm:slide-in-from-bottom-full',
    ]);
@endphp

<dialog
    popover=manual
    open
    class="bottom-0 left-auto right-0 top-auto w-full max-w-[420px] p-4 space-y-4 overflow-hidden"
    :class="{ 'p-4': toasts.length > 0 }"
    x-on:toast-show.document="showToast(event.detail)"
    x-on:mouseenter="pauseAllTimers()"
    x-on:mouseleave="resumeAllTimers()"
    x-on:focusin="pauseAllTimers()"
    x-on:focusout="resumeAllTimers()"
    x-on:keyup.escape="resumeAllTimers()"
    x-data="{
        toasts: [],
        timer: null,
        init() {
            this.showToasts({{ json_encode(session()->get('toasts', [])) }});
        },

        Timer: function(callback, delay) {
            var timerId, start, remaining = delay;

            this.pause = function() {
                window.clearTimeout(timerId);
                timerId = null;
                remaining -= Date.now() - start;
            };

            this.resume = function() {
                if (timerId) {
                    return;
                }

                start = Date.now();
                timerId = window.setTimeout(callback, remaining);
            };

            this.resume();

        },

        showToast(toast) {
            if (typeof toast.slots.action === 'string') {
                toast.slots.action = $wire[toast.slots.action];
            }

            toast.id = `toast-${window.getObjectId(toast)}`;

            toast.timer = new this.Timer(() => {
                const toastEl = this.$el.querySelector(`#${toast.id}`);
                toastEl.setAttribute('data-state', 'closed');
            }, toast.duration || 3000);

            this.toasts.push(toast);

        },

        removeToast({ animationName }, toast) {
            if (animationName === 'exit') {
                this.toasts.splice(this.toasts.indexOf(toast), 1);
            }
        },

        showToasts(toasts) {
            toasts.forEach(toast => this.showToast(toast))
        },

        pauseAllTimers() {
            this.toasts.forEach(toast => toast.timer.pause());
        },

        resumeAllTimers() {
            this.toasts.forEach(toast => toast.timer.resume());
        },
    }"
>
    <template
        x-for="toast in toasts"
        :key="toast.id"
    >
        <div>
            <div
                data-state="open"
                :id="toast.id"
                role="status"
                aria-live="off"
                aria-atomic="true"
                tabindex="0"
                x-on:animationend="removeToast($event, toast)"
                class="{{ $styles }}"
                :class="toast.variant === 'destructive' ?
                    'destructive group border-destructive bg-destructive text-destructive-foreground' :
                    'border bg-background text-foreground'"
            >
                <div class="grid gap-1">
                    <template x-if="toast.slots.title">
                        <div
                            class="text-sm font-semibold [&+div]:text-xs"
                            x-text="toast.slots.title"
                        ></div>
                    </template>
                    <div
                        class="text-sm opacity-90"
                        x-text="toast.slots.description"
                    ></div>
                </div>

                <template x-if="Object.keys(toast.slots).includes('action')">
                    <x-button
                        class="bg-transparent hover:bg-secondary group-[.destructive]:border-muted/40 group-[.destructive]:hover:border-destructive/30 group-[.destructive]:hover:bg-destructive group-[.destructive]:hover:text-destructive-foreground group-[.destructive]:focus:ring-destructive"
                        x-on:click="toast.slots.action"
                        variant="outline"
                        x-text="toast.slots.actionText || 'Action'"
                    >
                    </x-button>
                </template>

            </div>
        </div>
    </template>
</dialog>
