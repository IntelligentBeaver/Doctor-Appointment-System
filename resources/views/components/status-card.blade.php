<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'bg-base-300  duration-300 card-move-y flex flex-nowrap justify-between items-center align-middle gap-4 rounded-2xl px-12 py-16 ']) }}>
    <div>
        <p class="text-xl font-black">
            {{ $title }}
        </p>
    </div>

    <div>
        <p class="text-xl">{{ $slot }}</p>
    </div>
</a>
