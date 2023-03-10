@extends('layouts.master')

@push('css')
@endpush

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if(session('message'))
                  <!-- <div class="account-title">{{session('message')}}</div> -->
                  <div class="account-title">  

                     <p class="alert alert-success" >{{session('message')}}</p>
                     
                  </div>
                @endif


<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Edit City</h3>
					<br/>
					<br/>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <form  class="form-horizontal" method="POST" action="{{route('updatecity')}}"  >

                {{csrf_field()}}

                <input type="hidden" name="cityid" class="form-control"  value="{{$city->id}}"> 
                    <div class="form-group">
                        <label class="col-md-4">City Name</label>
                        <div class="col-md-8">
                            <input type="text" name="cityname" class="form-control" placeholder="City Name" value="{{$city->GuestPassLocation}}">
						</div>
							
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type='submit' >
                    </div>
                </form>
            </div>
        </div>
    </div>




<!-- ===== Right-Sidebar ===== -->
@include('layouts.partials.right-sidebar')
</div>
@endsection