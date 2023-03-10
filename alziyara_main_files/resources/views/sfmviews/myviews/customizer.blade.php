@extends('sfmviews.layout.app')
@section('content')
<style>
.colors ul{list-style:none; padding:0; margin: 0;}

.colors li{margin: 0 20px 0 0; display: inline-block;}

.colors label{cursor: pointer;}

.colors input{display:none;}

.colors input[type="radio"]:checked + .swatch{box-shadow: inset 0 0 0 2px white;}

.swatch{
  display:inline-block;
  vertical-align: middle;
  height: 30px;
  width:30px;
  margin: 0 5px 0 0 ;
  border: 1px solid #d4d4d4;
}


#container { width: 100%;height: 50%;}
.ui-widget-header h3 {width: 100%;height: 50%;}
#container h3 { text-align: center;}
.mova {background-position: center ;  width: 20%; height: 50%; opacity: 0.5; position:absolute;inset:88px auto auto 460px;}

</style>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css"/>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>

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
               
            </div>
         </div>
      </div>
   </section>

   <section id="game-sec-2">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 pt-5">
               <h2 class="section-heading text-uppercase">T-shirt Customizer</h2>
            </div>

            <div class="col-lg-12 col-md-12 mb-5">
               <div class="game-card-wrapper">
                  <div class="image-container">
                     <div id="container">
                     
                     <div id="resizable" style="background-position: center ;  width: 18%; height: 53%; opacity: 0.5; position:absolute;inset:94px auto auto 470px;">
                     <h4 class="ui-widget-header" style="font-size:1vw;">Customizable</h4>
                     <textarea id="summernote"  class="form-control" rows="6"></textarea>
                     </div>
                  
                     <div id="imageshow">
                        <img class="img-fluid" src="./images/t4tinywhite.jpg" alt="Workplace" usemap="#workmap" width="400" height="379" >
                     </div>
                     </div>
                     <!--<map name="workmap" id="tshirt">
                     <area  style="background-color:#20b2aa" shape="poly" href="computer.htm" coords="159,6,148,11,135,17,122,24,103,33,96,36,87,45,76,54,68,66,55,85,51,95,45,104,40,112,34,119,29,125,61,143,77,152,88,152,94,144,101,136,105,143,111,163,111,182,112,204,106,223,104,236,101,249,101,263,102,285,102,293,101,303,100,310,98,318,98,337,95,361,98,348,105,349,112,351,111,357,109,371,116,372,123,372,132,373,148,373,177,373,203,373,222,374,238,375,260,376,271,378,283,376,296,374,300,369,300,361,299,354,297,342,296,331,295,321,291,308,287,289,289,280,289,271,289,263,290,256,290,243,290,235,291,224,290,211,290,198,289,186,289,174,291,166,293,157,296,147,299,134,304,137,306,143,311,146,320,146,328,143,335,139,345,136,353,131,361,128,368,123,364,114,357,105,351,93,342,79,334,64,330,54,321,43,314,36,307,31,287,23,271,17,259,11,249,5,241,2,229,7,210,12,186,13"  >
                    </map>-->
                        <div class="colors">
                        <label class="label">T-Shirt Colour</label>
                        <ul>
                            <li>
                            <label>
                                <input type="radio" class="shirtcolor" name="color" value="56">
                                <span class="swatch" style="background-color:#44c28d"></span> Green
                            </label>
                            </li>
                            <li>
                            <label>
                                <input type="radio" class="shirtcolor" name="color" value="57">
                                <span class="swatch" style="background-color:#6e8cd5"></span> Blue
                            </label>
                            </li>
                            <li>
                            <label>
                                <input type="radio" class="shirtcolor" name="color" value="58">
                                <span class="swatch" style="background-color:#FFFFFF"></span> White
                            </label>
                            </li>
                        </ul> 
                        </div> 
                        
                        <button onclick='designapply();'>Apply Changes</button>
                        
                  </div>
                  <!--<h3>What Is The Sentence?</h3>
                  <p>WITS challenges players to create a bonafide sentence from the letter 
                  cards while playing against time, action cards, and the judgement of other 
                  players. The gamers must also protect their sentences and points from being 
                  stolen by their opponents. WITS is an exciting and entertaining board game 
                  that promotes family fun along with helping students develop critical learning 
                  objectives.
                  </p>

                  <div class="sharry-btn-container">
                  <a class="sherry-btn" href="#">Buy now</a>
                  </div>-->
                    
                
               </div>


            </div>
            <!---<div class="col-lg-6 col-md-6 mb-5">
               <div class="game-card-wrapper">
                  <div class="image-container">
                     <img class="img-fluid" src="./images/t2.png" alt="">
                  </div>
                  <h3>What Is The Scripture?</h3>
                  <p>I'm a paragraph. Click here to add your own text and edit me. 
                  It’s easy. Just click “Edit Text” or double click me to add your own 
                  content and maake changes to the font. Feel free to drag and drop me 
                  anywhere you like on your page. I’m a great place for you to tell a 
                  story and let your users know a little more about you.
                  </p>

                  <div class="sharry-btn-container">
                  <a class="sherry-btn" href="#">Buy now</a>
                  </div>
               </div>


            </div>-->
            


            </div>
         </div>
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
               <a href="{{url('sfmtshirtcustom')}}"><img src="./images/t3.jpg" class="img-fluid tiny"></a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
  

  $(document).ready(function() {

       $('#summernote').summernote({
         toolbar: [
            // [groupName, [list of button]]
            ['fontname', ['fontname']],
            ['style', ['bold', 'italic', 'underline']],
            ['fontsize', ['fontsize']],
            ['fontNames', ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']],
            ['color', ['color']],

         ],
         placeholder: 'write here...',
         
       });

   });


   $(document).on('click','.shirtcolor',function(){

   var shirtcol =  $(this).val();



   if(shirtcol == 56){

         var appendshirt = "<img class='img-fluid' src='./images/t4tinygreen1.jpg' alt='Workplace' usemap='#workmap' width='400' height='379' >";
   
   }else if(shirtcol == 57){

         var appendshirt = "<img class='img-fluid' src='./images/t4tinyblue1.jpg' alt='Workplace' usemap='#workmap' width='400' height='379' >"

   }else if(shirtcol == 58){

      var appendshirt = "<img class='img-fluid' src='./images/t4tinywhite.jpg' alt='Workplace' usemap='#workmap' width='400' height='379' >"

   }

      $('#imageshow').empty();
      $('#imageshow').html(appendshirt);

   });

   

   function designapply(){
      alert('hello');

     var imageshirt = $( "#imageshow" ).html();

      var txt = document.getElementById("summernote").value ;

      // var txtposition = document.getElementById("summernote").css;

      // console.log(txtposition);



     var tagcss = document.getElementById("resizable").style.getPropertyValue('inset');

     var tagcssheight = document.getElementById("resizable").style.getPropertyValue('height');

     var tagcsswidth = document.getElementById("resizable").style.getPropertyValue('width');


     console.log(imageshirt);
     console.log(tagcss);
     console.log(txt);

     var div = document.createElement("div");
      div.setAttribute("id", "shirttext");
      div.style.inset = tagcss;
      div.style.width = tagcsswidth;
      div.style.height = tagcssheight;
      div.style.position = "absolute";
      // div.style.padding = "8% 0 0 0";
      div.style.opacity = "0.5";
      div.style.border
      div.setAttribute("class", "ui-widget-content");
      

      var remove = document.getElementById("resizable").display = 'none' ;

      // var elementimage = document.getElementById("container");
      // element.appendChild(imageshirt);

      // $(function() {
      // $( ".mova" ).draggable({containment: "#shirttext"}).resizable({
      //    containment: "#shirttext"
      //    });
      // });

      $('#container').html(imageshirt);
      


      var element = document.getElementById("container");
      element.appendChild(div);
      $('#shirttext').html(txt);

      $( "#shirttext" ).children().attr("class","ui-state-active mova");

      $( "#shirttext" ).children().attr("class","mova");

      // document.getElementById("main").appendChild(div).parent();

       //   $('#imageshow').html(txt);

       $( ".mova" ).draggable({containment: "#shirttext"});

      //  $( "#shirttext" ).children().attr("style","inset:20px auto auto 20px;");
   }

   
   
</script>



@endsection