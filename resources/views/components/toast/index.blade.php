@props(['position' => 'bottom-right'])

@php
$positionClasses = [
'bottom-left' => 'bottom-5 left-5',
'bottom-right' => 'bottom-5 right-5',
'top-left' => 'top-5 left-5',
'top-right' => 'top-5 right-5',
];
@endphp

<div x-data="toastComponent()" x-init="window.showToast = (message, type = 'default', theme = 'light', duration = null) => 
    $dispatch('create-toast', { message, type, theme, duration })"
    x-on:create-toast.window="createToast($event.detail.message, $event.detail.type, $event.detail.theme, $event.detail.duration)"
    class="fixed {{ $positionClasses[$position] ?? $positionClasses['bottom-right'] }} z-50 flex flex-col-reverse gap-3 w-120 sm:w-80 pointer-events-none"
    role="status" aria-live="polite">

    <template x-for="toast in toasts" :key="toast.id">
        <div x-show="toast.show"
            class="transform transition-all duration-300 ease-in-out flex items-center justify-between px-4 py-6 rounded-lg shadow-lg pointer-events-auto"
            :class="{
                'bg-gray-800 text-white outline outline-gray-400': toast.theme === 'dark',
                'bg-white text-black outline outline-gray-400': toast.theme === 'light',
                'outline-green-600': toast.type === 'success' && toast.theme === 'dark',
                'outline-red-600': toast.type === 'error' && toast.theme === 'dark',
                'outline-yellow-600': toast.type === 'warning' && toast.theme === 'dark',
                'outline-green-300': toast.type === 'success' && toast.theme === 'light',
                'outline-red-300': toast.type === 'error' && toast.theme === 'light',
                'outline-yellow-300': toast.type === 'warning' && toast.theme === 'light'
            }" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4">

            <x-typography.p x-text="toast.message"></x-typography.p>

            <button @click="removeToastWithAnimation(toast.id)" class="ml-3 transition-colors duration-200"
                :class="toast.theme === 'dark' ? 'text-white hover:text-gray-300' : 'text-black hover:text-gray-600'">
                <x-lucide-x class="w-4 h-4" />
            </button>
        </div>
    </template>
</div>

<script>
    function toastComponent() {
        return {
            toasts: [],
            defaultDuration: 3000,
            createToast(message, type = 'default', theme = 'dark', duration = null) {
                const id = Date.now();
                const toast = { id, message, type, theme, duration: duration || this.defaultDuration, show: false };
                this.toasts.push(toast);
                setTimeout(() => {
                    const t = this.toasts.find(t => t.id === id);
                    if (t) t.show = true;
                }, 50);
                if (duration !== 0) {
                    setTimeout(() => {
                        this.removeToastWithAnimation(id);
                    }, duration || this.defaultDuration);
                }
            },
            removeToastWithAnimation(id) {
                const toastIndex = this.toasts.findIndex(t => t.id === id);
                if (toastIndex === -1) return;
                this.toasts[toastIndex].show = false;
                setTimeout(() => {
                    this.toasts = this.toasts.filter(toast => toast.id !== id);
                }, 300);
            }
        };
    }
</script>