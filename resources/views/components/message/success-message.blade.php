@if (session('success'))
    <div class="p-8">
        <div class="alert alert-success">
            <ul class="px-10" style="list-style-type: disc">
                @foreach (session('success') as $messageindex)
                    <li class="font-bold">{{ $messageindex }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
