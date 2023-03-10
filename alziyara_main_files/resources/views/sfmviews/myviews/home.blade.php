@extends('sfmviews.layout.app')
@section('content')
<body>
   <section id="banner-sec">
      <div class="container">
         <div class="align-items-center d-flex hero-section row">
            <div class="col-lg-6 col-md-6">
               <div class="hero-text-block">
                  <h2>Welcome to<span> SFM INTL </span> HOME OF The AWARD WINNING game </h2>
                  <small>"WHAT IS THE SENTENCE"</small>
                  <div class="row">
                     <div class="col-md-6 text-uppercase">
                        <a class="btn custom-btn" href="#">win a free game</a>
                     </div>
                     <div class="col-md-6 text-uppercase">
                        <a class="btn custom-btn" href="#">shop now</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="hero-img">
                  <img class="img-fluid" src="./images/123.png" alt="">
               </div>
            </div>
         </div>
      </div>
   </section>
   <section id="home-sec-2" class="hm-s3">
      <div class="container">
         <div class="row d-flex align-items-center">
            <div class="col-lg-12 pt-5">
               <hr>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="left-cont">
                  <h3 class="sub-heading">WANT TO WIN A FREE GAME?</h3>
                  <p>To win a free "What is the Sentence?"
                     game all you have to do is tag 100 friends on 
                     Facebook under the Sentence of the 
                     Week challenge.
                  </p>
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="image-container">
                  <img class="img-fluid" src="./images/p2.png" alt="">
               </div>
            </div>
         </div>
         <!-- row end-->
      </div>
   </section>
   <section class="modal-serv-sec pt-5 pb-5">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12 l-play">
               <h2 class="text-center">LEARN TO PLAY WUTS</h2>
               <hr>
               
            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
               <div class="img-size">      
                  <img src="./images/modal-bc.png" alt="" class="img-fluid">
               </div>
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-body">
                        <iframe width="470px" height="400" src="https://www.youtube.com/embed/5Peo-ivmupE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>      
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-12 l-play pt-5 text-center">
               <p>WITS challenges players to create a bonafide sentence from the letter cards 
                  while playing against time, action cards, and  the judgement of other players.
                   The gamers  must also protect their sentences and points  from being stolen
                    by their opponents. WITS is  an exciting and entertaining board game  that
                     promotes family fun along with helping  students develop critical learning objectives.</p>
               
               
            </div>
         </div>
      </div>
   </section>
   <section class="home-sec-two">
      <div class="container">
         <div class="row">
            <div class="col-md-12 hr-two">
               <h3 class="text-center">CONTEST</h3>
               <hr>
               <div class="img-fluid pt-5">
                  <img src="./images/two.png" class="img-fluid">
               </div>
            </div>
            <div class="col-md-12 pt-5 t-hr">
               <h2>LOREM EPSUM DOLOR</h2>
               <hr>
               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                  Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
               </p>
            </div>
            <div class="row pt-5 t-hr2 ">
               <div class="col-md-4">
                  <div class="img-fluid">
                     <img src="./images/p6.png" class="img-fluid">
                  </div>
               </div>
               <div class="col-md-8">
                  <h2>LOREM EPSUM DOLOR</h2>
                  <hr>
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                     Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                  </p>
               </div>
            </div>
         </div>
      </div>
   </section>
   <section id="home-sec-3">
      <div class="container">
         <div class="row d-flex align-items-center">
            <div class="col-lg-12">
               <h2 class="section-heading text-uppercase">Raise money. raise wits.</h2>
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="left-content">
                  <h3 class="sub-heading">PROGRAM DESCRIPTION</h3>
                  <hr>
                  <p>SFM Intl, Inc. offers an easy way for groups and organizations to raise money for small project and organizational goals through its Raise Money: Raise WITS Fundraising Program.  We offer a generous 40% share of retail price sales to our participating organizations.  The program is perfect for after-school clubs and groups, classrooms, after-school programs, small organization intending to become nonprofits, small nonprofits, homeschool groups and co-ops seeking to raise funds for small projects, field trips and resources for their organizations.               
                  </p>
                  <a class="btn custom-btn" href="#">win a free game</a>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 h-in-col">
               <div class="image-container">
                  <img class="img-fluid" src="./images/p1.png" alt="">
               </div>
            </div>
         </div>
         <!-- row end-->
      </div>
   </section>
   <section class="home-shop">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center pb-5">
               <h2>SHOP</h2>
               <hr>
            </div>
            <div class="col-md-3">
               <img src="./images/t1.png" class="img-fluid tiny">
               <h6>What Is The Sentence</h6>
               <h5>$28</h5>
               <button class="shop-btn">SHOP NOW</button>
            
            </div>
            <div class="col-md-3">
               <img src="./images/t2.png" class="img-fluid tiny">
               <h6>What is the Scripture</h6>
               <h5>$28</h5>
               <button class="shop-btn">SHOP NOW</button>
            </div>

            <div class="col-md-3">
               <img src="./images/t3.jpg" class="img-fluid tiny">
               <h6>Applied Lessons Kit</h6>
               <h5>$28</h5>
               <button class="shop-btn">SHOP NOW</button>
            </div>
            <div class="col-md-3">
               <img src="./images/t4.jpg" class="img-fluid tiny">
               <h6>What Is The Sentence</h6>
               <h5>$28</h5>
               <button class="shop-btn">SHOP NOW</button>
            </div>
         </div>
      </div>
   </section>
   
</body>
@endsection