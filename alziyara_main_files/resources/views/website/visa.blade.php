@extends('website.layout.master')

<body class="visa">

    @section('content')

    <!----------------- ALZIYARA SECTION ----------------------->
    <section class="sec-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 Alziyara" data-aos="fade-right" data-aos-duration="3000">
                    <h3>{!!($pages->where('slug','visa')->first()->title??'Not Available') !!}</h3>
                    {!!($pages->where('slug','visa')->first()->description??'Not Available') !!}
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
                    <div class="hotel_bg_img">
                        <img src="{{asset('website')}}/{{($pages->where('slug','visa')->first()->image??'Not Available') }}" alt="Quran" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="visa-sec pb-5 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row v-row1">
                        <div class="col-md-12 pb-3">
                            <h2>{!!($pages->where('slug','visaarival')->first()->title??'Not Available') !!}</h2>
                            {!!($pages->where('slug','visaarival')->first()->description??'Not Available') !!}
                        </div>
                        @foreach($visaArrivals as $item)
                        <div class="col-md-6"><img src="{{asset('website')}}/{{$item->image??''}}" alt="" class="img-fluid">{{$item->title}}</div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <p>Nationals of the following countries may obtain a visa on arrival at Al Najaf
                                    International
                                    Airport and Basra International Airport, or otherwise as noted:</p>
                            </div>
                        @foreach($lowercases as $item)
                                <div class="col-md-6 mt-3"><img src="{{asset('website')}}/{{$item->image??''}}" alt="" class="img-fluid">{{$item->title}}</div>
                        @endforeach
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <p>1 May obtain a visa on arrival in any port of entry</p>
                                <h3>{!!($pages->where('slug','source')->first()->title??'Not Available') !!}</h3>
                            </div>
                            <div class="col-md-12">
                                <ul class="list-unstyled">
                                {!!($pages->where('slug','source')->first()->description??'Not Available') !!}                                        
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row v-row4">
                        <div class="col-md-12 pb-3">
                            <h2>{!!($pages->where('slug','visaservice')->first()->title??'Not Available') !!}</h2>
                        </div>
                        <div class="col-md-12">
                            {!!($pages->where('slug','visaservice')->first()->description??'Not Available') !!}
                        </div>
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <h2>{!!($pages->where('slug','ourteam')->first()->title??'Not Available') !!}</h2>
                            </div>
                            <div class="col-md-12">
                                {!!($pages->where('slug','ourteam')->first()->description??'Not Available') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pb-3">
                                <h2>{!!($pages->where('slug','contact')->first()->title??'Not Available') !!}</h2>
                            </div>
                            <div class="col-md-12">
                                <ul class="list-unstyled pb-5">
                                    {!!($pages->where('slug','contact')->first()->description??'Not Available') !!}
                                </ul>
                                <p>Thanks <br> Al-Ziarah Team.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row our_processing">
                <div class="col-lg-12">
                    <h2>{!!($pages->where('slug','aboutziyara')->first()->title??'Not Available') !!}</h2>
                    {!!($pages->where('slug','aboutziyara')->first()->description??'Not Available') !!}
                    <h2>{!!($pages->where('slug','processing')->first()->title??'Not Available') !!}</h2>
                    {!!($pages->where('slug','aboutziyara')->first()->description??'Not Available') !!} 
                    {!!($pages->where('slug','contactat')->first()->title??'Not Available') !!} {!!($pages->where('slug','contactat')->first()->description??'Not Available') !!}
                    <p>Thanks <br>
                     Al-Ziarah Team.</p>
                </div>
            </div>
        </div>
    </section>
    <!--------------- PEOPLE SAY ABOUT US ------------------->
    @endsection