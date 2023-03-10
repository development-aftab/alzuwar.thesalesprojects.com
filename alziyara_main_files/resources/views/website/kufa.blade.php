@extends('website.layout.master')
<body class="hotels transportation faq_page">
@section('content')
<section class="privacy_policy_sec">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="privacy_policy_content">
                  <h1>{!!($pages->where('slug','kufa')->first()->title??'Not Available') !!}</h1>
                  {!!($pages->where('slug','kufa')->first()->description??'Not Available') !!}
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection

