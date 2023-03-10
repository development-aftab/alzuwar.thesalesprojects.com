@extends('website.layout.master')
@push('css') <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <style>
        .tablecontentstyle tbody img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        .tablecontentstyle .Actions .row .col-md-6 a {

            text-decoration: none;
        }
        .tablecontentstyle .Actions .row .col-md-6 a i {
            color: white;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 5px;
            border-radius: 50%;
        }
        .tablecontentstyle .Actions .row .col-md-6 a .fa-eye{
            background-color: blue;
        }
        .tablecontentstyle .Actions .row .col-md-6 a .fa-heart{
            background-color: red;

        }
        .cart_s1 table tbody>tr>td.actions {
            padding-top: 21px !important;
        }
        .sec_hotel_detail .row {
            box-shadow: none !important}

        .desc p ,.price p{
            margin-top: 50px;
        }
        .cart_s1 {
            padding: 0px 0;
        }
    </style>
@endpush
@section('content')
    <!----------------- ALZIYARA SECTION ----------------------->
    <section class="sec-3">
        <div class="container">
            <div class="row">
                @if($route_name == 'view-favorites')
                    <div class="col-lg-12 Alziyara text-center" data-aos="fade-right" data-aos-duration="3000">
                        <h3>Favorites</h3>
                        <p>Your favorites show here...</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="sec_hotel_detail" id="sec_hotel_detail">
        <div class="container">
            @if($route_name == 'view-favorites')
                <section class="cart_s1">
                    <div class="container">
                        <table id="cart" class="table table-hover table-condensed  tablecontentstyle">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                {{--<th style="width:10%">Quantity</th>--}}
                                {{--<th>Starting From</th>--}}
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($favourites))
                                @foreach($favourites as $favourite)
                                    <tr>
                                        <td data-th="Image"><img src="{{asset('website')}}/{{$favourite['image']??'img/not_available.png'}}" alt="" class="img-responsive"></td>
                                        <td data-th="Name" class="desc">
                                            <p>
                                                {{$favourite['name']??''}}
                                            </p>

                                        </td>
                                        {{--<td data-th="Price" class="price">--}}
                                            {{--<p>--}}
                                                {{--${{number_format($favourite['price']??'', 2, '.', '')}}--}}
                                            {{--</p>--}}
                                        {{--</td>--}}
                                        <td class="Actions">
                                            <div class="row d-block">
                                                <div class="col-md-6">
                                                    <a type="" href="{{$favourite['route']??''}}" class="" title="Watch"><i class="fa fa-eye"></i></a>
                                                </div>
                                                <div class="col-md-6">
                                                    <a type="" class="" title="Delete from favorites">
                                                        {{--<i class="fa fa-heart"></i>--}}
                                                        <i class="far fa-heart heart" PropertyID="{{$favourite['property_id']}}" CategoryID="{{$favourite['category_id']}}" attr="@if($favourite!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="cursor: pointer; @if($favourite!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </section>
            @endif
            {{--            {{ $favourites->links() }}--}}
        </div>
    </section>
@endsection
@push('js')<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script><script>$(document).ready(function() {			var table = $('#cart').DataTable({				aLengthMenu: [			  [15,25, 50,100,500, -1],			  [15,25, 50,100,500,"All"]				],				iDisplayLength:15,				stateSave: true,				order: [0, 'asc']			});					});</script>
    <script>
        $(document).ready(function(){
            $(".heart").click(function(){
                if($(this).attr('attr') =='heart_checked'){
                    @if(Auth::id())
                        @if($route_name=='view-favorites')
                            $(this).parent().parent().parent().parent().parent().css( "display", "none" );
                        @endif
                        $.get('{{ URL::to("remove-favorite-property")}}/'+$(this).attr('PropertyID')+'/'+$(this).attr('CategoryID'),function(data){
                            console.log(data);
                            Swal.fire({
                                icon: 'success',
                                title: 'Favorites',
                                text: data,
                            })
                        });
                        $(this).css('background','gray');
                        $(this).attr('attr','heart_unchecked');
                    @else
                    Swal.fire({
                        icon: 'info',
                        title: 'Favorites',
                        text: 'Please login to remove from favorites.',
                        footer: '<a href="login">Login?</a>'
                    })
                    @endif
                }else{
                    @if(Auth::id())
                    // alert('Add Favorite');
                        $.get('{{ URL::to("add-favorite-property")}}/'+$(this).attr('PropertyID')+'/'+$(this).attr('CategoryID'),function(data){
                            console.log(data);
                            Swal.fire({
                                icon: 'success',
                                title: 'Favorites',
                                text: data,
                            })
                        });
                        $(this).css('background','red');
                        $(this).attr('attr','heart_checked');
                    @else
                        Swal.fire({
                            icon: 'info',
                            title: 'Favorites',
                            text: 'Please login to add in favorites.',
                            footer: '<a href="login">Login?</a>'
                        })
                    @endif
                }
            });
        });

    </script>
@endpush