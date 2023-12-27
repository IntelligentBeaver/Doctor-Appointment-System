<x-dashboard>
    <x-slot:title>
        {{ Auth::user()->name }}
    </x-slot>
    <x-slot:subtitle>
        Your Dashboard
    </x-slot>
    {{-- 
    <div>
        <x-styling.header class="mx-10">{{ Auth::user()->name }}</x-styling.header>
        <x-styling.subheader class="mx-10">Your dashboard</x-styling.subheader>
    </div> --}}

</x-dashboard>
