@extends('website.layout.master')

<body class="hotels transportation about_us">

    @section('content')

    <section class="sec-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 Alziyara" data-aos="fade-right" data-aos-duration="3000">
                    <h3> {!!($abouts->where('slug','about')->first()->title??'Not Available') !!}</h3>
                    {!!($abouts->where('slug','about')->first()->description??'Not Available') !!}
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
                    <div class="hotel_bg_img">
                        <img src="{{asset('website')}}/{{($abouts->where('slug','about')->first()->image??'Not Available') }}" alt="Transport-service" class="img-fluid">
                    </div>

                </div>
            </div>
        </div>
    </section>



    @endsection