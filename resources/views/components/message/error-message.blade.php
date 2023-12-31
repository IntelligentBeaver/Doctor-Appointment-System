<div>
    @if ($errors->any())
        <div class="alert alert-error px-8">
            <ul style="list-style-type:disc">
                @foreach ($errors->all() as $error)
                    <li class="font-bold">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
<br>
@if (session('errormessages'))
    <div class="alert alert-error">
        <ul class="px-10" style="list-style-type: disc">
            @foreach (session('errormessages') as $messageindex)
                <li class="font-bold">{{ $messageindex }}</li>
            @endforeach

        </ul>
    </div>
@endif
