@extends('website.layout.master')
@push('css')
  <style type="text/css">
        .contactus_page{
background-image: linear-gradient(rgba(54,92,169,0.7),rgba(54,92,169,0.7)),url({{asset('website/img/Mask_Group_12.png')}});
min-height: 100vh;
}
.inner_col {
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0px 4px 10px rgb(94 92 169 / 40%);
    margin: 50px 0;
    width: 100%;
    max-width: 60%;
    margin: 0 auto;
}
.contactus_page .icon_position {
    position: relative;
    border: 1px solid #E8E8E8;
    padding: 15px 10px;
    border-radius: 5px;
    box-shadow: 0px 5px 10px rgb(0 0 0 / 15%);
}

.contactus_page input ,.contactus_page textarea {
    border: none;
    outline: none !important;
    padding: 0 10px;
    font-size: 18px;
    background: none;
    width: 100%;
}

.contactus_page textarea {
    min-height: 200px;
}
.contactus_page .buttons button {
    background-color: #365CA9;
    padding: 10px 40px;
    color: white;
    font-size: 20px;
}

.contactus_page .inner_col{
    background: #fff;
}

.contactus_page .contactheading {
    padding-top: 30px;
    font-size: 47px;
    font-weight: bold;
    color: white;
}

.contactus_page .contactheading span{
    color: #DDC01A;
}


.contactus_page input::placeholder, .contactus_page textarea::placeholder{
    color:#000000;
}
    </style>
    @endpush
@section('content')
    <section class="contactus_page">
        <h2 class="text-center contactheading pb-4">Contact <span>Us</span></h2>
        <div class="container">
            <div class="inner_col">
                <form class="row" action="{{route('contact_request')}}" method="post">
                    @csrf
                    <div class="col-12 col-lg-6 mb-4 ">
                        <div class="icon_position">
                            <input type="text" placeholder="First Name" name="first_name" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-4 ">
                        <div class="icon_position">
                            <input type="text" placeholder="Last Name" name="last_name" aria-label="sername" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-4 ">
                        <div class="icon_position">
                            <input type="email" placeholder="Email Address" name="email" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 mb-4 ">
                        <div class="icon_position">
                            <input type="text" placeholder="Contact Number" name="phone" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-12 mb-4 ">
                        <div class="icon_position">
                            <textarea placeholder="Message" name="description"></textarea>
                        </div>
                    </div>
                    <div class="buttons text-center mt-4">
                        <button type="submit" class="btn">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
    </section>
@endsection