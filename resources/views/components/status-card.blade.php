<div
    {{ $attributes->merge(['class' => 'bg-base-300 transition duration-300 ease-in-out hover:-translate-y-1 hover:scale-105 flex flex-nowrap justify-between gap-2 rounded-2xl px-12 py-16 ']) }}>
    <div>
        <p class="text-xl font-black">
            {{ $title }}
        </p>
    </div>

    <div>
        <p class="text-xl">{{ $slot }}</p>
    </div>
</div>
