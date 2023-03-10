@extends('website.layout.master')
@push('css')
<style>

    .sp_banner{
        background-image: url({{asset('website/img/banner_img.png')}});
        background-size: 100% 100%;
        background-repeat: no-repeat;
        padding: 110px 130px;
    }
    .sp_banner .banner_txt h1{
        font-size: 46px;
        font-weight: 600;
        color: white;
        line-height: 72px;
    }
    .sp_banner .banner_txt h1 span{
        color: #DDC01A;
        margin-right: 10px;
    }
    .sp_banner .banner_txt p{
        color: white;
        font-size: 19px;
        width: 49%;
        margin-bottom: 44px;
    }
    .sp_banner .banner_txt a{
        padding: 12px 36px;
        background-color: #DDC01A;
        color: white;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
    }
    .sp_listing{
        padding: 60px 76px;
        background-color: #F8F8F8;
    }
    .sp_listing .list_boxes{
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px 10px;
    }
    .sp_listing .list_boxes h4 {
        font-size: 24px;
        font-weight: 600;
        margin-top: 25px;
        margin-bottom: 20px;
    }

    .sp_listing .list_boxes p{
        color: #8D8D8D;
        font-size: 15px;
        text-align: center;
    }
    .sp_listing .list_boxes img {
        width: 25%;
    }
    .desk_divs{
        padding: 60px 0px;
    }
    .desk_divs .cus_cont{
        max-width: 100%;
        padding:0px;
    }
    .desk_divs .desk_box h2{
        text-align: center;
        font-size: 35px;
        font-weight: 500;
        margin-bottom: 45px;
    }
    .desk_divs .desk_txt{
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: center;
    }
    .desk_divs .desk_txt h4{
        font-size: 25px;
        font-weight: 500;
    }
    .desk_divs .desk_txt p{
        margin-left: 28px;
        margin-top: 19px;
        font-size: 19px;
        color: #8D8D8D;
        letter-spacing: -1px;
    }
    .desk_divs .desk_img_2{
        text-align: right;
    }
    .req_sec_table{
        padding: 70px 0px 100px 0px;
        background-color: #F8F8F8;
    }
    .req_sec_table .cus_cont{
        max-width: 87%;
    }
    .req_sec_table .col-md-12 h5{
        background-color: #365CA9;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        text-align: center;
        color: white;
        padding: 20px;
        margin: 0px;
        font-size: 18px;
        font-weight: 500;
    }
    .req_sec_table .req_table th:first-child{
        text-align: center;
    }
    .req_sec_table .req_table td,
    .req_sec_table .req_table th{
        border: 3px solid #F8F8F8;
    }
    .req_sec_table .req_table td:first-child{
        text-align: center;
        border-left: 1px solid #365CA9;
        width: 26%;
    }
    .req_sec_table .req_table th{
        background-color: white;
        padding: 15px;
    }
    .req_sec_table .req_table td{
        padding: 20px 0px;
        background-color: white;
    }
    .req_sec_table .req_table td:last-child {
        padding-left: 50px;
        border-right: 1px solid #365CA9;
        width: 74%;
    }
    .req_sec_table .req_table td p,
    .req_sec_table .req_table th{
        font-size: 16px;
        font-weight: 600;
    }
    .req_sec_table .req_table td img {
        margin-bottom: 5px;
    }
    .req_sec_table .req_table{
        width: 100%;
        box-shadow: rgb(0 0 0 / 10%) 0px 10px 30px 9px, rgb(0 0 0 / 0%) 0px 4px 20px 9px;
    }
    .req_sec_table .req_table tr:last-child td{
        border-bottom: 1px solid #365CA9;
    }
    .req_sec_table .req_table ul{
        list-style-image: url({{asset('website/img/check2-all.png')}});
    }
    .req_sec_table .req_table ul li{
        font-size: 16px;
        color: #8D8D8D;
    }
    .req_sec_table .req_table th:last-child {
        padding-left: 50px;
    }
    .adds{
        padding: 75px 90px;
        background-color: #365CA9;
    }
    .adds .add{
        display: flex;
        align-items: center;
    }
    .adds .add1,
    .adds .add2{
        width: 24%;
    }
    .adds .add3{
        width: 52%;
    }
    .adds .add h2 {
        color: white;
        font-size: 35px;
        margin-left: 35px;
        margin-bottom: 0;
    }
    .desk_img img {
        width: 85%;
        margin-bottom: 40px;
    }
    #vendor-sec-3 {
        padding-top:7%;
        padding-bottom: 3%;
        padding-left: 16%;
        padding-right: 16%;
    }
    #accordion .panel-heading {
        background-color: #fff;
        box-shadow: 0 5px 12px 2px #0000001a;
        margin-bottom: 20px;
    }
    #accordion .panel-title>a {
        padding: 20px;
    }
    #accordion a>i {
        float: right;
        font-size: 16px;
        color: black;
    }
    #vendor-sec-3 textarea {
        padding: 15px 20px;
        border-radius: 8px;
    }
    #vendor-sec-3 input {
        padding: 20px;
        border-radius: 8px;
        box-shadow: none !important;
    }
    #vendor-sec-3 .ball_button.accordian_btn:before {
        width: 50px;
        height: 50px;
        top: -10px;
    }
    button.ball_button.accordian_btn{
        background-color: transparent;
        position: relative;
        border: none;
        font-weight: 600;
        margin-top: 13px;
        color: #000 !important;
        text-transform: uppercase;
        font-size: 16px;
        padding-left: 20px;
    }
    .ball_button.accordian_btn i {
        color: black;
        font-weight: 600;
        font-size: 18px;
    }
    .desk_divs .row {
        padding: 15px 50px;
        margin: 0;
    }
    .desk_divs .row:nth-child(3) {
        background-color: #F8F8F8;
    }
</style>

{{--<style>--}}
{{--header{--}}
{{--display: none;--}}
{{--}--}}
{{--.listservices_nav{--}}
{{--margin-left: auto;--}}
{{--}--}}

{{--.list-of-services-banner{--}}
{{--background-image:--}}
{{--linear-gradient(to bottom, rgba(54, 92, 169, 0.9), rgba(54, 92, 169, 0.9)),--}}
{{--url('./Mask\ Group\ 12.png');--}}
{{--min-height: 100vh;--}}
{{--background-size: cover;--}}
{{--color: white;--}}
{{--padding: 150px 0;--}}
{{--}--}}
{{--.left_content{--}}
{{--display: flex;--}}
{{--justify-content: center;--}}
{{--align-items: center;--}}
{{--min-height: 100%;--}}
{{--}--}}

{{--.accountbanner{--}}
{{--display: flex;--}}
{{--justify-content: center;--}}
{{--align-items: center;--}}
{{--min-height: 100%;--}}
{{--flex-direction: column;--}}
{{--}--}}
{{--.left_content h1{--}}
{{--font-size: 50px;--}}
{{--font-weight: bold;--}}
{{--}--}}

{{--.left_content .yellow{--}}
{{--color: #DDC01A;--}}
{{--}--}}

{{--.accountbanner {--}}
{{--background: #fff;--}}
{{--padding: 30px;--}}
{{--/* border: 1px solid blue; */--}}
{{--border-radius: 13px;--}}
{{--text-align: center;--}}
{{--}--}}

{{--.createaccount {--}}
{{--border: 2px solid #365CA9;--}}
{{--width: 100%;--}}
{{--display: inline-block;--}}
{{--padding: 10px;--}}
{{--border-radius: 5px;--}}
{{--margin: 8px 0;--}}
{{--color: #365CA9;--}}
{{--}--}}
{{--.createaccount:hover {--}}
{{--text-decoration: none;--}}
{{--}--}}

{{--.loginaccount {--}}
{{--/* border: 2px solid blue; */--}}
{{--background: #365CA9;--}}
{{--color: white;--}}
{{--width: 100%;--}}
{{--display: inline-block;--}}
{{--padding: 10px;--}}
{{--border-radius: 5px;--}}
{{--margin: 8px 0;--}}
{{--}--}}
{{--.loginaccount:hover {--}}
{{--color: white; text-decoration: none;--}}
{{--}--}}




{{--.digital_channals {--}}
{{--padding: 33px 0;--}}
{{--}--}}
{{--.digital_channals .inner_container {--}}
{{--margin: 9px;--}}
{{--border-radius: 10px;--}}
{{--box-shadow: 0px 0px 14px #dddddd;--}}
{{--}--}}
{{--.black_head {--}}
{{--background: #2D2D2D;--}}
{{--padding: 20px;--}}
{{--color: white;--}}
{{--text-align: center;--}}
{{--border-top-left-radius: 10px;--}}
{{--border-top-right-radius: 10px;--}}
{{--}--}}
{{--.black_head h2 {--}}
{{--font-size: 18px;--}}
{{--}--}}
{{--.spacing{--}}
{{--padding: 20px 40px;--}}
{{--}--}}


{{--.account_btns .account_btns_createaccount {--}}
{{--display: inline-block;--}}
{{--width: 100%;--}}
{{--color: #365CA9;--}}
{{--border: 2px solid #365CA9;--}}
{{--padding: 8px 20px;--}}
{{--text-align: center;--}}
{{--border-radius: 6px;--}}
{{--}--}}

{{--.account_btns_loginaccount {--}}
{{--display: inline-block;--}}
{{--width: 100%;--}}
{{--color: white;--}}
{{--background: #365CA9;--}}
{{--padding: 10px 20px;--}}
{{--text-align: center;--}}
{{--border-radius: 6px;--}}
{{--}--}}

{{--.account_btns .account_btns_createaccount:hover {--}}
{{--color: #365CA9;--}}
{{--text-decoration: none;--}}
{{--}--}}

{{--.account_btns_loginaccount:hover {--}}
{{--color: white;--}}
{{--text-decoration: none;--}}
{{--}--}}


{{--.account_btns.spacing ul {--}}
{{--margin: 0;--}}
{{--padding: 0;--}}
{{--list-style: none;--}}
{{--}--}}

{{--.account_btns.spacing ul li img {--}}
{{--margin-right: 13px;--}}
{{--}--}}

{{--.mobile img {--}}
{{--width: 19px !important;--}}
{{--}--}}
{{--.account_btns.spacing ul li {--}}
{{--color: #365CA9;--}}
{{--font-size: 16px;--}}
{{--padding: 5px 0;--}}
{{--}--}}
{{--.icon_size img {--}}
{{--width: 31px;--}}
{{--}--}}
{{--.full_height{--}}
{{--height: 96%;--}}
{{--position: relative;--}}
{{--}--}}
{{--.center_content{--}}
{{--position: relative;--}}
{{--top: 50%;--}}
{{--transform: translateY(-76%);--}}
{{--}--}}
{{--.website{--}}
{{--font-size: 24px;--}}
{{--}--}}


{{--.list-of-services-table {--}}
{{--width: 100%;--}}
{{--padding: 30px 0;--}}
{{--}--}}
{{--.list-of-services-table .table {--}}
{{--width: 85%;--}}
{{--/* margin-bottom: 1rem; */--}}
{{--color: #212529;--}}
{{--margin: 42px auto;--}}
{{--}--}}
{{--th{--}}
{{--background: #365CA9;--}}
{{--color: white;--}}
{{--border-collapse: collapse;--}}
{{--border: 1px solid #6180BF;--}}
{{--padding: 20px;--}}
{{--text-align: center;--}}
{{--}--}}
{{--td {--}}
{{--border: 1px solid #6180BF;--}}
{{--border-collapse: collapse; padding: 20px;--}}
{{--text-align: center;--}}

{{--}--}}
{{--tr{--}}
{{--padding: 20px;--}}
{{--}--}}
{{--@media(max-width:1200px){--}}

{{--.account_btns .account_btns_createaccount {--}}
{{--margin-bottom: 10px;--}}
{{--}--}}
{{--.spacing {--}}
{{--padding: 22px;--}}
{{--}--}}
{{--}--}}

{{--@media(max-width:768px){--}}
{{--.center_content {--}}
{{--position: relative;--}}
{{--top: 50%;--}}
{{--transform: translateY(-59%);--}}
{{--}--}}
{{--.left_content h1 {--}}
{{--font-size: 39px;--}}
{{--font-weight: bold;--}}
{{--padding-bottom: 32px;--}}
{{--}--}}
{{--.account_btns .account_btns_createaccount {--}}
{{--margin-bottom: 10px;--}}
{{--}--}}
{{--.list-of-services-banner {--}}
{{--padding: 60px 0;--}}
{{--}--}}
{{--}--}}
{{--</style>--}}
@endpush
@section('content')

    <section class="sp_banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner_txt">
                        <h1><span>Experience</span>The World.<br> A World Of <span>Guests.</span></h1>
                        <p>Join us to get booking of your hotels, transport, tours, travel packages, religious events and promote your business to millions of Zuwar worldwide.</p>
                        <a href="{{url('home')}}">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sp_listing">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="{{asset('website/img/assign-user-line.png')}}" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="{{asset('website/img/globe.png')}}" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="{{asset('website/img/noot-book.png')}}" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="{{asset('website/img/commission.png')}}" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="desk_divs">
        <div class="container cus_cont container-fluid" >
            <div class="row">
                <div class="col-md-12">
                    <div class="desk_box">
                        <h2>Selling with us is simple. Here's how it works...</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-3">
                    <div class="desk_img">
                        <img src="{{asset('website/img/desk-img-1.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="desk_txt">
                        <h4>1. Create your AlZuwar listing</h4>
                        <p>Enter your details to create a new listing-or find your existing one. Easily manage your reviews to build trust with travelers and grow your sales.</p>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-5">
                    <div class="desk_txt">
                        <h4>2. Build products at your own pace</h4>
                        <p>Use the Management Center to create products, adding photos, pricing, availability and more. Save as you go along and publish when you're ready.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="desk_img desk_img_2">
                        <img src="{{asset('website/img/desk-img-2.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-3">
                    <div class="desk_img">
                        <img src="{{asset('website/img/desk-img-1.png')}}" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="desk_txt">
                        <h4>3. Start earning and stay in control</h4>
                        <p>You decide exactly how much you want to earn from each booking and manage your business on your own terms. Simple, hassle-free and flexible.</p>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>
    <section class="req_sec_table">
        <div class="container cus_cont">
            <div class="row">
                <div class="col-md-12">
                    <h5>What Are The Requirements?</h5>
                    <table class="req_table">
                        <thead>
                        <tr>
                            <th>Service</th>
                            <th>Requirements</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <img src="{{asset('website/img/Travel-Package.png')}}" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset('website/img/hotel.png')}}" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset('website/img/transportation.png')}}" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset('website/img/guid.png')}}" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="{{asset('website/img/Shrines-Program.png')}}" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <section class="adds">
        <div class="container-fluid">
            <div class="row">

                <div class="add add1">
                    <img src="{{asset('website/img/website.png')}}" alt="">
                    <h2>Website</h2>
                </div>


                <div class="add add2">
                    <img src="{{asset('website/img/mobile-phone.png')}}" alt="">
                    <h2>Mobile</h2>
                </div>


                <div class="add add3">
                    <img src="{{asset('website/img/house.png')}}" alt="">
                    <h2>With the Local Help center</h2>
                </div>

            </div>
        </div>
    </section>
    <section id="vendor-sec-3">
        <div class="container custom-comtainer">
            <div class="row">
                <div class="col-lg-12 text-center faq_text" data-aos="zoom-in" data-aos-duration="2000">
                    <h1>{!!($pages->where('slug','faq')->first()->title??'Not Available') !!}</h1>
                    {!!($pages->where('slug','faq')->first()->description??'Not Available') !!}
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($faqs as $key=>$item)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$key}}"
                                           aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fas fa-plus"></i>
                                            {{$item->title??''}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne{{$key}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body"> {!! $item->description??'' !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 Form-text" data-aos="fade-left" data-aos-duration="2000">
                    <h2> Ask a Question </h2>
                    <form action="{{route('ask_A_Question')}}" method="post" name="ask_question_form">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email Address"
                                   aria-describedby="emailHelp" name="email">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="description" placeholder="Message" rows="2" name="description"></textarea>
                        </div>

                        <div class="ball_button accordian_btn">
                            <!-- <a href="#"> SEND &nbsp;<i class="fas fa-arrow-right"></i></a> -->
                            <button class="ball_button accordian_btn" type="submit">Send &nbsp;<i class="fas fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("form[name='ask_question_form']").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                description: "required",
            },
            messages: {
                email:           "Please enter your valid Email*",
                description:     "Please enter your Message*",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endpush
{{--@if ($errors->any())--}}
{{--<div class="alert alert-danger">--}}
{{--<ul>--}}
{{--@foreach ($errors->all() as $error)--}}
{{--<li>{{ $error }}</li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--</div>--}}
{{--@endif--}}
{{--@if(session('message'))--}}
{{--<!-- <div class="account-title">{{session('message')}}</div> -->--}}
{{--<div class="account-title">--}}
{{--<p class="alert alert-success">{{session('message')}}</p>--}}
{{--</div>--}}
{{--@endif--}}
{{--<section class="list-of-services-banner">--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-md-8 col-sm-12">--}}
{{--<div class="">--}}
{{--@if(!Auth::user())--}}
{{--<h1>AlZuwar.com – <span class="yellow">Services Providers</span></h1>--}}
{{--<p>Now Open A Free Account Digitally And Provide Services</p>--}}
{{--@else--}}
{{--@if(Auth::user()->hasRole('SuperAdmin'))--}}
{{--<h1>AlZuwar.com –  <span class="yellow">Admin</span></h1>--}}
{{--<p>Manager View</p>--}}
{{--@else--}}
{{--<h1>AlZuwar.com – <span class="yellow">Services Providers</span></h1>--}}
{{--<p>Your Free business Account to provide Services</p>--}}
{{--@endif--}}
{{--@endif--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-4 col-sm-12">--}}
{{--<div class="accountbanner">--}}
{{--<img class="img-fluid" src="{{ asset('website') }}/img/logo.png">--}}
{{--@if(!Auth::user())--}}
{{--<a href="{{url('vendor-signup')}}" class="createaccount mt-5">Create New Account</a>--}}
{{--<a href="{{url('user-login')}}" class="loginaccount">Login</a>--}}
{{--@else--}}
{{--@if(Auth::user()->hasRole('SuperAdmin'))--}}
{{--<a href="{{url('vendor-signup')}}" class="createaccount mt-5">{{Auth::user()->name}}</a>--}}
{{--@else--}}
{{--<a href="{{url('vendor-signup')}}" class="createaccount mt-5">{{Auth::user()->name}}</a>--}}
{{--@endif--}}
{{--<a href="{{route('logout')}}" class="loginaccount">Logout</a>--}}
{{--@endif--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</section>--}}

{{--<section class="digital_channals">--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-md-6">--}}
{{--<div class="row">--}}
{{--<div class="col-12">--}}
{{--<div class="inner_container">--}}
{{--<div class="black_head"><h2>Your Account</h2></div>--}}
{{--<div class="account_btns spacing row mt-2">--}}
{{--<div class="col-lg-6 col-md-12 col-sm-12">--}}
{{--<a href="{{url('vendor-signup')}}" class="account_btns_createaccount">Create New Account</a>--}}
{{--</div>--}}
{{--<div class="col-lg-6 col-md-12 col-sm-12">--}}
{{--<a href="{{url('user-login')}}" class="account_btns_loginaccount">Login</a>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-12">--}}
{{--<div class="inner_container">--}}
{{--<div class="black_head"><h2>Who Can Open An Account</h2></div>--}}
{{--<div class="account_btns spacing">--}}
{{--<ul>--}}
{{--<li><img src="{{ asset('website') }}/img/Ellipse 19.png" alt="">Resident citizens with valid identity, phone and email account</li>--}}
{{--<li><img src="{{ asset('website') }}/img/Ellipse 19.png" alt="">Organizations with government issued tax id/documentation.</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-6">--}}
{{--<div class="inner_container full_height">--}}
{{--<div class="black_head"><h2>Digital Channels To Open An Account</h2></div>--}}
{{--<div class="row center_content">--}}
{{--<div class="col-md-6 col-sm-12 ">--}}
{{--<div class="website spacing icon_size">--}}
{{--<img class="img-fluid mr-2" src="{{ asset('website') }}/img/Group 3043.png" alt=""> Website--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-6 col-sm-12">--}}
{{--<div class="website spacing icon_size mobile">--}}
{{--<img class="img-fluid mr-2" src="{{ asset('website') }}/img/mobile-phone.png" alt="">Mobile--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-12">--}}
{{--<div class="website spacing icon_size">--}}
{{--<img class="img-fluid mr-2" src="{{ asset('website') }}/img/Icons.png" alt="">With the Local Help center--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</section>--}}

{{--<section class="digital_channals">--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-12">--}}
{{--<div class="inner_container">--}}
{{--<div class="black_head"><h2>Account Categories and Required Customer Information</h2></div>--}}
{{--<div class="list-of-services-table">--}}
{{--<table class="table table-responsive-sm">--}}
{{--<thead>--}}
{{--<tr>--}}
{{--<th class="account_col" width="30%">Account Categories</th>--}}
{{--<th class="Currency_col"  width="20%"> Currency</th>--}}
{{--<th class="Information_col"  width="50%">Required Information</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}
{{--<tr>--}}
{{--<td>Package Deals</td>--}}
{{--<td>USD ($)</td>--}}
{{--<td></td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td>Hotels</td>--}}
{{--<td>USD ($)</td>--}}
{{--<td></td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td>Transports</td>--}}
{{--<td>USD ($)</td>--}}
{{--<td></td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td>Guests Pass</td>--}}
{{--<td>USD ($)</td>--}}
{{--<td></td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td>Guide</td>--}}
{{--<td>USD ($)</td>--}}
{{--<td></td>--}}
{{--</tr>--}}
{{--</tbody>--}}
{{--</table>--}}
{{--</div>--}}

{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</section>--}}
