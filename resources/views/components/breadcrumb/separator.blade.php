  <li
      role="presentation"
      aria-hidden="true"
      {{ $attributes->twMerge('[&>svg]:w-3.5 [&>svg]:h-3.5') }}
  >
      @if ($slot->isEmpty())
          <x-lucide-chevron-right />
      @else
          {{ $slot }}
      @endif
  </li>
