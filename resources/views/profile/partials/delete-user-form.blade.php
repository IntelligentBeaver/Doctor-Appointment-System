<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')
        <div><a class="btn btn-error w-28 rounded-xl" href="#my_modal_8">Delete</a></div>
        {{-- The popup if we click the Delete Button --}}
        <div class="modal" id="my_modal_8" role="dialog">
            <div class="modal-box">
                <form method="dialog">
                </form>
                <h3 class="text-xl font-extrabold">Delete Record</h3>
                <p class="py-4">Are you sure you want to delete this record</p>
                <div class="flex flex-row-reverse gap-4">
                    <div class="modal-action">
                        <button class="btn btn-error rounded-xl" type="submit">Delete</button>
                    </div>
                    <div class="modal-action">
                        <a class="btn btn-neutral rounded-xl" href="{{ route('profile.edit') }}">Close</a>
                    </div>
                </div>
            </div>

    </form>
    </div>
    {{-- </div>
    </div> --}}

</section>
