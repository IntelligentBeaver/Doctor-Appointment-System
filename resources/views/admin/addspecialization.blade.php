<x-dashboard>
    {{-- First need to show all the specialization from the specializations table --}}
    <x-styling.header>
        Specializations
    </x-styling.header>


    <div class="my-8 overflow-clip">
        <x-styling.subheader>
            Available Specializations:
        </x-styling.subheader>
        <div>
            <div class="carousel carousel-center rounded-box max-w-full space-x-8 p-4">
                @foreach ($specialization as $specializationindex)
                    <div class="carousel-item max-w-30">
                        <x-status-card>
                            <x-slot:title>{{ $specializationindex->SpecializationName }}</x-slot>
                        </x-status-card>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="my-8">
        <x-styling.subheader>
            Add a new Specialization:
        </x-styling.subheader>
        <div class="px-20">
            <div class="bg-base-200 mx-auto my-8 flex items-center rounded-xl px-10 py-10">
                <form class="w-full" action="{{ route('admin.addspecialization') }}" method="POST">
                    @csrf
                    <x-styling.input name="specializationname" type="text" label="Specialization" />
                    <div class="py-2">
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text text-base font-semibold">Description</span>
                            </div>
                            <textarea class="textarea textarea-bordered h-24 w-full" id="description" name="description" placeholder="Description"></textarea>
                        </label>
                    </div>
                    <div class="py-2">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Then Form for adding new Specialization --}}
</x-dashboard>
