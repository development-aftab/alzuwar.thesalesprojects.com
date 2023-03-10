@extends('sfmviews.layout.app')
@section('content')
<body>
   <section id="banner-sec">
      <div class="container">
         <div class="align-items-center d-flex hero-section row">
            <div class="col-lg-12">
               <div class="vidos-heading">
                  <h2>Videos</h2>
               </div>
            </div>
            <div class="col-lg-6 col-md-6">
            </div>
         </div>
      </div>
   </section>
   <section id="video-sec-2">
      <div class="swiper-container-4">
         <div class="swiper-wrapper">
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/car1.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/car2.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/car3.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/car1.png" alt="">
            </div>
            <div class="swiper-slide">
               <img class="img-fluid" src="./images/car2.png" alt="">
            </div>
         </div>
         <!-- Add Pagination -->
         
         <!-- Add Arrows -->
         <div class="swiper-button-next"></div>
         <div class="swiper-button-prev"></div>
         <div class="swiper-pagination"></div>
     
       
      </div>
   </section>
   <section class="game-sec-tab">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center game-tabs">
               <!-- <h2>Upcoming Games</h2>
                  <a href="#">Upcoming Games</a> <a href="#">Released Games</a><a href="#">Our best Games</a> -->
               <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Upcoming Games</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Released Games</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Our best Games</a>
                  </li>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <div class="tab-pane active" id="tabs-1" role="tabpanel">
                     <div class="row">
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/capsule1.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Astronaut.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Cars.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Fire.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/map.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/map2.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tabs-2" role="tabpanel">
                     <div class="row">
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/capsule1.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Astronaut.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Cars.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Fire.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/map.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/map2.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tabs-3" role="tabpanel">
                     <div class="row">
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/capsule1.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Astronaut.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Cars.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/Fire.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/map.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                        <div class="col-md-4">
                           <!-- Button trigger modal -->
                           <button type="button" class="btn img-video-btn" data-toggle="modal" data-target="#exampleModal">
                              <div class="img-size">      
                                 <img src="./images/map2.png" alt="" class="img-fluid">
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
                           <h2>Lorem Epsum</h2>
                           <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 
                              the industry's standard dummy text 
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

</body>
@endsection