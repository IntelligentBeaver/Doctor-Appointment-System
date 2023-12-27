<x-dashboard>
    <x-slot:title>
        {{ Auth::user()->name }}
    </x-slot>
    <x-slot:subtitle>
        Your Dashboard
    </x-slot>
</x-dashboard>
