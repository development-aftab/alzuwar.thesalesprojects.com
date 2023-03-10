@extends('website.layout.master')
@push('css')
<style type="text/css">
    .error{color: red; font-size: 15px;}
</style>
@endpush
    @section('content')
    <section class="privacy_policy_sec">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="privacy_policy_content">
                  <h1>{!!($pages->where('slug','help_faq')->first()->title??'Not Available') !!}</h1>
                  {!!($pages->where('slug','help_faq')->first()->description??'Not Available') !!}
               </div>
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
            <div class="col-xl-8 col-lg-7 col-md-6" data-aos="fade-right" data-aos-duration="2000">
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
            <div class="col-xl-4 col-lg-5 col-md-6 Form-text" data-aos="fade-left" data-aos-duration="2000">
               <h2> Ask a Question </h2>
               <form action="{{route('ask_A_Question')}}" method="post" name="ask_question_form">
                  @csrf
                  <div class="form-group">
                     <input type="email" class="form-control" id="email" placeholder="Email Address"
                            aria-describedby="emailHelp" name="email">
                  </div>

                  <div class="form-group">
                           <textarea class="form-control" id="description" placeholder="Message" rows="3" name="description"></textarea>
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