@extends('sfmviews.layout.app')
@section('content')
<body>
   <section id="banner-sec">
      <div class="container">
         <div class="align-items-center d-flex hero-section row">
            <div class="col-lg-12">
               <div class="vidos-heading">
                  <h2>Photos Gallery</h2>
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
            </div>
         </div>
      </div> 
   </section>


   <section id="diff-images">
      <div class="container">
      <div class="row">
         
         <div class="col-md-9 my-img">
            <div class="my-img-text">
          <h2> Lorem Epsum </h2>
          <p> Lorem Ipsum is simply dummy text of the printing <br>
            and typesetting industry. Lorem Ipsum has been <br>
            the industry's standard dummy text </p>
            </div>  
         </div>

         <div class="col-md-3">
         
            <div class="Img-1">
               <img src="./images/gun.png" alt="" class="img-fluid">
            </div>
            <div class="Img-2">
               <img src="./images/gun3.png" alt="" class="img-fluid">
            </div>
            <div class="Img-3">
               <img src="./images/gun2.png" alt="" class="img-fluid">
            </div>
          
         </div>
      </div>
      </div>
   </section>

   <hr>

   <section id="video-sec-2">
      <div class="swiper-container">
         <div class="swiper-wrapper">
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/fantasy-1.jpg" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/tggcards.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/fortnite1.jpg" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/fantasy-1.jpg" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/tggcards.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/fortnite1.jpg" alt="">
            </div>
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
      </div>
   </section>


   <section id="video-sec-2b">
      <div class="swiper-container">
         <div class="swiper-wrapper">
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/chess.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/tggcards.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/fortnite1.jpg" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/chess.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/tggcards.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/fortnite1.jpg" alt="">
            </div>
         </div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
         <!-- Add Pagination -->
         <div class="swiper-pagination"></div>
      </div>
   </section>
 
      </div>
   </section>

</body>
@endsection