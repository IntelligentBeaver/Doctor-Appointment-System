@extends('layouts.app')
@section('about-section')

<style>
    .all {
        overflow: hidden;
    }

    .contain1 {
        display: flex;
        justify-content: center;
        width: 100%;
        padding: 23px 105px;
        border: none;
        margin: 0px 0px 60px 0px;
    }

    .contain1 .text1 {
        width: 100%;
        float: left;
        margin-top: 118px;
        font-size: 55px;
        color: black;
    }

    .contain1 .icon1 {
        width: 50%;
    }

    .icon1 img {
        width: 400px;
    }

    /* browse card slider */
    .top_searched{
        margin:20px;
        width:100%;
    }
    .wrapper {
        display: flex;
        width: 100%;
        padding-top: 20px;
        text-align: center;
        background-color: rgb(173, 218, 246,0.2);
        /* border-radius: 20px; */
    }

    .carousel {
        display:flex;
        width: 90%;
        gap:10px;
        margin: 0px auto;
    }
    .carousel div{
        width:100%;
    }

    .slick-slide {
        margin: 10px;
    }

    .slick-slide img {
        width: 100%;
        border: 2px solid #fff;
    }

    .wrapper .slick-dots li button:before {
        font-size: 20px;
        color: white;
    }

    .cardtext {
        font-weight:600;
        /* background-color: pink; */
        padding: 20px;
    }

    .wrapper a {
        text-decoration: none;
    }

    /* browse card slider ends */

    .doc_id_card {
        width: 90%;
        padding: 50px 20px;
    }

    .doc_id_card h2,
    .top_searched h2 {
        font-weight: bold;
        font-size: 30px;
        /* margin-left: 20px; */
    }

    .docprofile {
        display: flex;
        justify-content: space-around;
        padding: 25px 20px;
        /* align-items: center; */
    }

    .doc_info {
        width: 100%;
        display: flex;
        justify-content: center;
        font-size: 20px;
    }

    .doc_info h3 {
        font-weight: 600;
    }

    .doc {
        display: flex;
        flex-direction: column;
        border: none;
        background-color: rgb(176, 179, 180, 0.3);
        box-shadow: 5px 5px 10px 2px rgba(0, 0, 0, 0.3);
        padding: 60px;
        align-items: center;
        border-radius: 6px;
    }

    .doc button {
        background-color: rgb(38, 38, 194);
        border-radius: 6px;
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    .doc img {
        height: 80px;
        width: 80px;
        border-radius: 50%;
    }

    .why_book {
        display: flex;
        width: 100%;
        font-size: 22px;
        /* background-color: rgb(143, 209, 237); */
    }

    .card_left {
        width: 50%;
        padding: 155px 46px;
        /* margin-top: 66px; */
    }

    .card_left h1 {
        font-size: 2em;
    }

    .card_left p {
        font-size: 1.3em;
        font-weight: 100px;
    }

    .card_right {
        width: 50%;
        display: flex;
    }

    .card1 {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .card1 img {
        width: 196px;
        height: 196px;
        padding-left: 16px;
    }

    .card1 h4 {
        padding: 0px 0px 0px 60px;
    }

    .save_time,
    .save_money,
    .payment,
    .folow_up {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* For mobile devices */
    @media only screen and (max-width: 600px) {
        .contain1 {
            /* flex-direction: column; */
            padding: 75px 32px;
            margin:20px;
        }

        .contain1 .text1 {
            width: 100%;
            /* text-align: center; */
            margin-top: 10px;
            font-size: 25px;
        }

        .icon1 {
            width: 100%;
            height:40px;
            align: center;
        }

        .icon1 img {
            width: 100%;
            margin-top:-32px;
        }

        /* slider */
        .wrapper {
            /* padding-top: 10px; */
            width:100%;
            display:flex;
            justify-content:center;
        }

        .carousel {
            display: flex;
            flex-direction:column;
            width: 100%;
            gap:0px;
            align:center;
            
        }
        .carousel div{
            width:60%;
            padding:20px 20px;
            margin:0px 20px;
        }
        .carousel div img{
            width:100%;
            border:2px solid white;
           
        }

        /* slider */
        .doc_id_card {
        padding: 20px;
    }
    .docprofile {
        flex-direction: column;
    }

        .doc {
            width: 100%;
            align-self: center;
            background-color: rgb(156, 153, 153, 0.3);
            margin-bottom: 14px;
        }

        .doc button {
            width: 100%;
        }

        .why_book {
            flex-direction: column;
        }

        .card_left {
            font-size: 20px;
        }

        .card_right h4,
        .card_left p {
            font-size: 18px;
        }

        .card_left,
        .card_right {
            width: 100%;
            padding: 10px;
        }

        .card_right {
            display: flex;
        }

        .card {
            margin-bottom: 20px;
        }
    }
</style>


<div class="all">

    <div class="contain1">
        <div class="text1">
            <h1>Heal in a Click:</h1>
            <span style="color: blue;">Your Wellness Starts Here!</span>
        </div>
        <div class="icon1">
            <img src="{{ asset('images/appointment/card1pic.png') }}" alt="">
        </div>
    </div>
    <!-- browse card slider starts -->
    <div class="top_searched">
        <h2>Top-searched specialties</h2>
        <br>
        <div class="wrapper">
            <div class="carousel">
                <div class="box"><a href="{{ route('appointments') }}"><img src="{{ asset('images/appointment/primary-care.png') }}"
                            alt="">
                        <div class="cardtext">
                            Primary Care
                        </div>
                    </a>
                </div>
                
                <div class="box"><a href="{{ route('appointments') }}"><img src="{{ asset('images/appointment/obgyn.png') }}"
                            alt="">
                        <div class="cardtext">
                            OB-GYN
                        </div>
                    </a>
                </div>

                <div class="box"><a href="{{ route('appointments') }}"><img src="{{ asset('images/appointment/eye.png') }}" alt="">
                        <div class="cardtext">
                            Eye Care
                        </div>
                    </a>
                </div>

                <div class="box"><a href="{{ route('appointments') }}"><img src="{{ asset('images/appointment/Cardiology.png') }}"
                            alt="">
                        <div class="cardtext">
                            Cardiology
                        </div>
                    </a>
                </div>

                <div class="box"><a href="{{ route('appointments') }}"><img src="{{ asset('images/appointment/psychology.png') }}"
                            alt="">
                        <div class="cardtext">
                            Psychology
                        </div>
                    </a>
                </div>

                <div class="box"><a href="{{ route('appointments') }}"><img src="{{ asset('images/appointment/Vaccine.png') }}"
                            alt="">
                        <div class="cardtext">
                            Vaccination
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- browse card slider ends -->

    <div class="doc_id_card">
        <h2>Browse Doctor Profiles</h2>
        <div class="docprofile">
            <div class="doc">
                <div class="image">
                    <img src="{{ asset('images/appointment/doc1.jpg') }}" alt="" width="20px" height="20px">
                </div>
                <br>
                <div class="doc_info">
                    <div class="about">
                        <h3>Dr. Kamal Lamsal</h3>
                        <p>Dermatologist</p>
                    </div>

                </div>
                <a href="{{ route('appointments') }}">
                    <br><button>Book Appointment</button>
                </a>
            </div>

            <div class="doc">
                <div class="image">
                    <img src="{{ asset('images/appointment/doc1.jpg') }}" alt="" width="20px" height="20px">
                </div>
                <br>
                <div class="doc_info">
                    <div class="about">
                        <h3>Dr. Arun Sayami</h3>
                        <p>Cardiologist</p>
                    </div>
                </div>
                <a href="{{ route('appointments') }}">
                    <br><button>Book Appointment</button>
                </a>
            </div>
            <div class="doc">
                <div class="image">
                    <img src="{{ asset('images/appointment/doc1.jpg') }}" alt="" width="60px" height="90px">
                </div>
                <br>
                <div class="doc_info">
                    <div class="about">
                        <h3>Dr. K.I Guragain</h3>
                        <p>Dermatologist</p>
                    </div>
                </div>
                <a href="{{ route('appointments') }}">
                    <br><button>Book Appointment</button>
                </a>
            </div>

            <div class="doc">
                <div class="image">
                    <img src="{{ asset('images/appointment/doc1.jpg') }}" alt="" width="60px" height="90px">
                </div>
                <br>
                <div class="doc_info">
                    <div class="about">
                        <h3>Dr. Madan Kumar</h3>
                        <p>Opthalmologist</p>
                    </div>
                </div>
                <a href="{{ route('appointments') }}">
                    <br>
                    <button>Book Appointment</button>
                </a>
            </div>
        </div>
    </div>
    <div class="why_book">
        <div class="card_left">
            <h1>Why book an appointment through our website?</h1>
            <p>Book an appointment online with Hamro Doctor at a hospital/clinic without a hectic process.</p>
        </div>
        <div class="card_right">
            <div class="card1">
                <div class="save_time">
                    <img src="{{ asset('images/appointment/Time.png') }}" alt="">
                    <h4>Save Precious Time</h4>
                </div>
                <div class="payment">
                    <img src="{{ asset('images/appointment/payments.png') }}" alt="">
                    <h4>Convenient payment </h4>
                </div>
            </div>
            <div class="card1">
                <div class="save_money">
                    <img src="{{ asset('images/appointment/Banknote.png') }}" alt="">
                    <h4>Save Your Money</h4>
                </div>
                <div class="follow_up">
                    <img src="{{ asset('images/appointment/msg.png') }}" alt="">
                    <h4>Instant follow up</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="FAQs-slider">
        <div class="title"></div>
        <div class="questions"></div>


    </div>


</div>
@endsection