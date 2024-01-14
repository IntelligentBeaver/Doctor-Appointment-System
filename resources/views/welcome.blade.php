@extends('layouts.app') @section('homecontent')
    <div class="px-12">
        <section class="home" id="home">
            <div class="image">
                <img src="{{ asset('images/Medicine-bro.svg') }}" alt="" />
            </div>
            <div class="content">
                <h3 class="heading mb-8 text-7xl font-semibold">
                    Getting sick is a pain. <br />
                    Urgent care shouldn't be.
                </h3>
                <p class="py-4 text-2xl">
                    A better way to access your local urgent care facilities & a
                    more proactive approach to care for you and your loved ones.
                </p>
                <a class="btnappointment" href="#">
                    Book An Appointment <span class="fas fa-chevron-right"></span></a>
            </div>
        </section>
        <section class="icons-container py-20">
            <div class="icons card-move-y hover:shadow-gray-300">
                <i class="fa-solid fa-file-medical"></i>
                <h3 class="mb-8 text-4xl font-semibold">Book An Appointment</h3>
                <p class="py-3 text-xl">
                    Appointment with the best doctors of your choice
                </p>
            </div>
            <div class="icons card-move-y hover:shadow-gray-300">
                <i class="fas fa-users"></i>
                <h3 class="mb-8 text-4xl font-semibold">Online Consultation</h3>
                <p class="py-3 text-xl">
                    Effective online consultation with top doctors
                </p>
            </div>
            <div class="icons card-move-y hover:shadow-gray-300">
                <i class="fa-solid fa-prescription-bottle-medical"></i>
                <h3 class="mb-8 text-4xl font-semibold">Health packages</h3>
                <p class="py-3 text-xl">
                    Buy best health packages at an affordable rate
                </p>
            </div>
            <div class="icons card-move-y hover:shadow-gray-300" x-show="isIntersecting"
                x-transition:enter="transition ease-out duration-500 opacity-0" x-transition:enter-end="opacity-100">
                <i class="fas fa-location"></i>
                <h3 class="mb-8 text-4xl font-semibold">Find a doctor near you</h3>
                <p class="py-3 text-xl">
                    Finding doctors near you made easy with us
                </p>
            </div>
        </section>
        <section class="about" id="about">
            <x-styling.header class="heading text-center">Prepared patients</x-styling.header>
            {{--
        <h1 class="heading">Prepared Patients</h1>
        --}}
            <div class="row">
                <div class="image">
                    <img src="{{ asset('images/Doctors-bro.svg') }}" alt="" />
                </div>
                <div class="content">
                    <h3 class="mb-8 text-6xl font-semibold">Compare Wait Times</h3>
                    <h3 class="mb-8 text-6xl font-semibold">Get In Line Early</h3>
                    <p class="py-4 text-2xl">
                        Random provides a place to compare wait times at
                        clinics,hospitals in your area and then get it right form
                        your phone-empowering you to find the right facility and
                        skip the agony of waiting room.
                    </p>
                </div>
            </div>
        </section>
        <section class="review" id="review">
            <x-styling.header class="heading text-center">Reviews!</x-styling.header>
            {{--
        <h1 class="heading">Reviews!</h1>
        --}}
            <div class="box-container px-32">
                <div class="box card-move-y hover:shadow-gray-300">
                    <h3 class="mb-8 text-4xl font-semibold">Chandler Bing</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="py-4 text-xl">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Esse laboriosam accusamus aperiam dolores soluta
                        repellendus. Ipsa, atque ratione. Repellendus ipsa voluptas
                        deserunt quod officiis quas, earum nemo animi culpa dolor.
                    </p>
                </div>
                <div class="box card-move-y hover:shadow-gray-300">
                    <h3 class="mb-8 text-4xl font-semibold">Monica Geller</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="py-4 text-xl">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Esse laboriosam accusamus aperiam dolores soluta
                        repellendus. Ipsa, atque ratione. Repellendus ipsa voluptas
                        deserunt quod officiis quas, earum nemo animi culpa dolor.
                    </p>
                </div>
                <div class="box card-move-y hover:shadow-gray-300">
                    <h3 class="mb-8 text-4xl font-semibold">Joey Tribbiani</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="py-4 text-xl">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Esse laboriosam accusamus aperiam dolores soluta
                        repellendus. Ipsa, atque ratione. Repellendus ipsa voluptas
                        deserunt quod officiis quas, earum nemo animi culpa dolor.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
