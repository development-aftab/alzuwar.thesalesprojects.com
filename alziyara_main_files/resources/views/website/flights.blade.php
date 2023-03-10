@extends('website.layout.master')

<body class="flights">

@section('content')


   <!----------------- ALZIYARA SECTION ----------------------->
   <section class="sec-3">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 Alziyara" data-aos="fade-right" data-aos-duration="3000">
               <h3>{!!($pages->where('slug','flights')->first()->title??'Not Available') !!}</h3>
               {!!($pages->where('slug','flights')->first()->description??'Not Available') !!}
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
                <div class="hotel_bg_img">
                     <img src="{{asset('website')}}/{!!($pages->where('slug','flights')->first()->image??'Not Available') !!}" alt="Quran" class="img-fluid">
                </div>
             </div>
         </div>
      </div>
   </section>
   <!-- =========== TRavel Agency SEction ========== -->  
   <section class="flight-sec">
      <div class="container">
        <div class="row flight_row">
         <div class="col-md-12 flight-col1">
            <p class="pt-5">* * We advise all our Zaiars to book flights to Najaf airport and plan departure from baghdad airport. This will save you one day of road trip.</p>
            <div class="card-deck">
               @foreach($agencies as $item)
               <div class="card">
                  <div class="card-body">
                     <h4 class="card-title">{{$item->name??""}}</h4>
                     <p class="card-text">{{$item->contact??""}}</p>
                  </div>
               </div>
               @endforeach
            </div>
            
         </div>
            @foreach($agencyImages as $item)
            <div class="col-md-4 text-center">
               <img src="{{asset('website')}}/{{$item->image??''}}" alt="" class="img-fluid">
            </div>
            @endforeach
            <!-- <div class="col-md-4 text-center">
               <img src="./img/img2.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-4 text-center">
               <img src="./img/img3.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-4 text-center">
               <img src="./img/img4.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-4 text-center">
               <img src="./img/img5.png" alt="" class="img-fluid">
            </div>
            <div class="col-md-4 text-center">
               <img src="./img/img6.png" alt="" class="img-fluid">
            </div> -->
         </div>
          <!--<p class="pt-5">* * We advise all our Zaiars to book flights to Najaf airport and plan departure from baghdad airport. This will save you one day of road trip.</p>-->
      </div>
   </section>



 @endsection