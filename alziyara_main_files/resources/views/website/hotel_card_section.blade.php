<div class="container">
    @if($route_name == 'view-favorites')
        @foreach($hotelsData as $hotelData)
            @if($hotelData->getUserFavoriteProperties != null)
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="hotel_img">
                            @foreach($hotelData->getHotelPics as $hotelPic)
                                @if($hotelPic==null)
                                    <img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">
                                @elseif($hotelPic->DefaultFlag==1)
                                    <img class="card-img-top" src="{{asset('website')}}/{{$hotelPic->PhotoLocation}}" alt="{{$hotelPic->AltText}}" title="{{$hotelPic->PhotoTitle}}">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="hotel_detail">
                            <p class="three_star">
                                @for( $a=1 ; $a <= round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                @if(count($hotelData->getHotelReview)>1)
                                    {{ count($hotelData->getHotelReview) }} reviews
                                @else
                                    {{ count($hotelData->getHotelReview) }} review
                                @endif
                            </p>
                            <h3 class="card-title"> {{$hotelData->Name}}</h3>
                            <p class=""> {{$hotelData->Address}}, {{$hotelData->City}}</p>
                            <ul class="list-unstyled">



                                <li class="date"><i class="fas fa-door-open"></i> {{$hotelData->getMinPriceRooms->RoomType}}</li>
                                <li class="house"><i class="fas fa-bread-slice"></i> Breakfast Included </li>
                                <li class="stay"><i class="fas fa-bed"></i> {{ $hotelData->getMinPriceRooms->QtyOfBed }} {{ $hotelData->getMinPriceRooms->getBedType->BedTypeDesc??'' }}    </li>
                                @if($hotelData->PropertyShuttle == 1)
                                    <li class="airfare"><i class="fas fa-shuttle-van"></i> {{$hotelData->PropertyDistance}}km Shuttle Service </li>
                                @else
                                    <li class="airfare"><i class="fas fa-walking"></i> {{$hotelData->PropertyDistance}}km Walking Distance</li>
                                @endif




                            </ul>
                            @if($route_name == 'search-hotels')

                                <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> @if($days==0) 1 Night @else {{$days}} Nights @endif &amp; {{$days+1}} Days </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hotel_view_detail">
                            <i class="far fa-heart heart" PropertyID="{{$hotelData->PropertyID}}" attr="@if($hotelData->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($hotelData->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
                            <div class="hotel_view_detail_content">
                                {{--<p> From <span> ${{number_format($hotelData->Price, 0, '.', '')}}</span></p>--}}
                                <p> From <span>${{number_format($hotelData->getRooms->min('Price'), 0, '.', '')}}</span></p>
                                <a href="{{route('hotelsdetails')}}/{{$hotelData->PropertyID}}/{{$hotelData->Name}}?data={{json_encode(request()->all())}}" class="view_detail">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        @if(sizeof($hotelsData)>0)
            @foreach($hotelsData as $hotelData)
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="hotel_img">

                            @foreach($hotelData->getHotelPics as $hotelPic)
                                @if($hotelPic==null)
                                    <img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">
                                @elseif($hotelPic->DefaultFlag==1)
                                    <img class="card-img-top" src="{{asset('website')}}/{{$hotelPic->PhotoLocation}}" alt="{{$hotelPic->AltText}}" title="{{$hotelPic->PhotoTitle}}">
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="hotel_detail">
                            <p class="three_star">
                                @for( $a=1 ; $a <= round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                @if(count($hotelData->getHotelReview)>1)
                                    {{ count($hotelData->getHotelReview) }} reviews
                                @else
                                    {{ count($hotelData->getHotelReview) }} review
                                @endif
                            </p>
                            <h3 class="card-title"> {{$hotelData->Name}}</h3>
                            <p class=""> {{$hotelData->Address}}, {{$hotelData->City}}</p>
                            <ul class="list-unstyled">
                                <li class="date"><i class="fas fa-door-open"></i> {{$hotelData->getMinPriceRooms->RoomType}}</li>
                                <li class="house"><i class="fas fa-bread-slice"></i> Breakfast Included </li>
                                <li class="stay"><i class="fas fa-bed"></i> {{ $hotelData->getMinPriceRooms->QtyOfBed }} {{ $hotelData->getMinPriceRooms->getBedType->BedTypeDesc??'' }}    </li>
                                @if($hotelData->PropertyShuttle == 1)
                                    <li class="airfare"><i class="fas fa-shuttle-van"></i> {{$hotelData->PropertyDistance}}km Shuttle Service </li>
                                @else
                                    <li class="airfare"><i class="fas fa-walking"></i> {{$hotelData->PropertyDistance}}km Walking Distance</li>
                                @endif
                            </ul>
                            @if($route_name == 'search-hotels')
                                <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> @if($days==0) 1 Night @else {{$days}} Nights @endif &amp; {{$days+1}} Days </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hotel_view_detail">
                            <i class="far fa-heart heart" PropertyID="{{$hotelData->PropertyID}}" CategoryID="2" attr="@if($hotelData->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($hotelData->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
                            <div class="hotel_view_detail_content">
                                {{--<p> From <span> ${{number_format($hotelData->Price, 0, '.', '')}}</span></p>--}}
                                <p> From <span>${{number_format($hotelData->getRooms->min('Price'), 0, '.', '')}}</span></p>
                                <a href="{{route('hotelsdetails')}}/{{$hotelData->PropertyID}}/{{$hotelData->Name}}?data={{json_encode(request()->all())}}" class="view_detail">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{--@endif--}}
            @endforeach
        @else
            <p class="text-center">We're sorry. We were not able to find a match.</p>
        @endif
    @endif
    {{ $hotelsData->appends(request()->query())->links() }}
</div>