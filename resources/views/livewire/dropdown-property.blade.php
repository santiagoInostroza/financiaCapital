<x-jet-dropdown align="right" width="48">
    <x-slot name="trigger">
        <svg x-on:click="isOpenDropdown=true" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
    </x-slot>

    <x-slot name="content">
       
        <div class="block px-4 py-2 text-xs text-gray-400">
            Propiedades
        </div>

        <x-jet-dropdown-link href="{{ route('properties.create') }}">
           Agregar propiedad
        </x-jet-dropdown-link>
        <x-jet-dropdown-link href="{{ route('properties.index') }}">
           Mis propiedades
        </x-jet-dropdown-link>

        {{-- <div class="border-t border-gray-100"></div> --}}
       
    </x-slot>
</x-jet-dropdown>