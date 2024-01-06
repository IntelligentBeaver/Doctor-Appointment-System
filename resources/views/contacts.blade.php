@extends('layouts.app')

@section('contactssection')
    {{-- If you submit, admin will get the message from the contacts table
    and be related with their user email --}}

    {{-- Create contacts table --}}
    {{-- Create a relation for users and contacts table --}}
    <x-styling.header>
        Contact Us
    </x-styling.header>
    <main class="xs:flex-col flex flex-wrap justify-around p-8 sm:flex-row">
        <div
            class="get-in-touch bg-base-200 sm:max-w-80 card rounded-xl shadow-xl transition-all ease-in-out hover:-translate-y-2 hover:shadow-gray-300">
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


        <div
            class="contact-form bg-base-200 rounded-xl shadow-xl transition-all ease-in-out hover:-translate-y-2 hover:shadow-gray-300">
            <h2 class="text-2xl font-bold">Contact Form</h2>
            <form action="{{ route('contacts') }}" method="POST">
                @csrf
                <x-styling.input name="email" type="email" label="Email" />

                <x-styling.input name="phone" type="number" label="Phone" />

                <div class="py-2">
                    <label class="form-control">
                        <div class="label">
                            <span class="label-text text-base">Your Message</span>
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
