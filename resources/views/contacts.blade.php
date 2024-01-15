@extends('layouts.app')

@section('contactssection')
    {{-- If you submit, admin will get the message from the contacts table
    and be related with their user email --}}

    {{-- Create contacts table --}}
    {{-- Create a relation for users and contacts table --}}
    <x-styling.header>
        Contact Us
    </x-styling.header>
    <main class="flex flex-col flex-wrap justify-around gap-8 py-8 sm:flex-row sm:px-8">
        <div class="get-in-touch sm:max-w-80 bg-base-200 card-move-y mx-auto w-full sm:rounded-xl">
            <div class="my-4">
                <h2 class="text-2xl font-bold">Get in Touch</h2>
                <p>Connect with us on social media:</p>
            </div>
            <div class="social-media flex flex-col justify-around">
                <a class="my-3" href="https://www.twitter.com/yourpage" target="_blank"><i
                        class="fab fa-twitter"></i>Twitter</a>
                <a class="my-3" href="https://www.facebook.com/yourpage" target="_blank"><i
                        class="fab fa-facebook"></i>Facebook</a>
                <a class="my-3" href="https://www.instagram.com/yourpage" target="_blank"><i
                        class="fab fa-instagram"></i>Instagram</a>
            </div>
        </div>


        <div class="contact-form bg-base-200 card-move-y sm:rounded-xl">
            <h2 class="text-2xl font-bold">Contact Form</h2>
            <form action="{{ route('contacts') }}" method="POST">
                @csrf
                <x-styling.input name="email" type="email" label="Email" />

                <x-styling.input name="phone" type="number" label="Phone" />

                <div class="py-2">
                    <label class="form-control">
                        <div class="label">
                            <span class="label-text text-base font-semibold">Your Message</span>
                        </div>
                        <textarea class="textarea textarea-bordered h-24 w-full" id="description" name="description" placeholder="Description"
                            required></textarea>
                    </label>
                </div>

                <div class="py-2">
                    <button id="contact-btn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </main>
@endsection
