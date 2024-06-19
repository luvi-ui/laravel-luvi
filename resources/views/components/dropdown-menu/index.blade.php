<div x-data="{ menuOpen: false }">
    <div x-dropdown-menu x-model="menuOpen" class="relative flex items-center">
        {{ $slot }}
    </div>
</div>
