<div
    {{ $attributes->merge(['class' => 'bg-base-300 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 flex flex-nowrap justify-between gap-2 rounded-2xl px-12 py-16 ']) }}>
    <div>
        <h1 class="text-xl font-bold">
            {{ $title }}
        </h1>
    </div>

    <div>
        <p class="text-xl">{{ $slot }}</p>
    </div>
</div>
