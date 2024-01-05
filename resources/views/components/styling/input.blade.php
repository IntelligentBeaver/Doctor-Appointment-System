<div class="py-2">
    <label class="form-control w-full">
        <div class="label">
            <span class="label-text text-base font-semibold">{{ $label }}</span>
        </div>
        <input class="input input-bordered w-full rounded-xl" id="{{ $name }}" name="{{ $name }}"
            type="{{ $type }}" value="{{ old($name) }}" placeholder="Enter {{ $label }}" autofocus>
    </label>
</div>
