@push('css')
    <style>

        /*Rameez Css*/
        .sec-4 .tab-content .card a img {
            width: 100%;
            height: 195px;
        }

        /*.sec-4 .tab-content .card {*/
            /*height: 610px;*/
        /*}*/


    </style>
@endpush
{{-- Packages Strat from here--}}
@if(sizeof($packages)>0)
@foreach($packages as $package)
    <div class="col-md-4 package_view_detail">
        <div class="card" style="width: 18re">
            <i class="far fa-heart heart" PropertyID="{{$package->id}}" CategoryID="1" attr="@if($package->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($package->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
            <a href="{{route('packagedetail')}}/{{$package->id??''}}/{{$package->package_deals_name??''}}">
                @if($package->getPackageDealsDefaultPhoto != null)
                    <img class="card-img-top" src="{{asset('website/' . $package->getPackageDealsDefaultPhoto->PhotoLocation??'Not Available')}}" alt="Card image cap" width="350px">
                @else
                    <img src='{{asset('website/img/karbala.png')}}' width="350px">
                @endif
                <div class="card-body">
                    <div class="card_body_content">
                        <p class="three_star"><i class="fas fa-map-marker-alt"></i>{{$package->package_deals_location??''}} </p>
                        <h3 class="card-title" title="{{$package->package_deals_name??''}}"> {{$package->package_deals_name??''}}</h3>
                        <ul class="list-unstyled">
                                                        <li class="date"><i class="far fa-calendar-plus"></i> {{$package->package_available_from??''}} to {{$package->package_available_to??''}}</li>
                            <li class="stay"><i class="fas fa-bed"></i> {{$package->accomodation??''}}</li>
                            <li class="house"><i class="fas fa-utensils"></i>{{$package->meal??''}}</li>
                            <li class="airfare"><i class="fas fa-bus"></i>{{$package->transportation??''}}</li>
                            <li class="airfare"><i class="fas fa-praying-hands"></i>{{$package->location??''}}</li>
                            <li class="airfare"><i class="fas fa-suitcase"></i>${{$package->airfare??''}}</li>
                        </ul>
                    </div>
                    <div class="final_price" >
                        <p>
                            @for( $a=1 ; $a <= round($package->getPackageReviewForView->avg('Rating')) ; $a++ )
                                <i class="fas fa-star"></i>
                            @endfor
                            @for( $a=1 ; $a <= 5-round($package->getPackageReviewForView->avg('Rating')) ; $a++ )
                                <i class="far fa-star"></i>
                            @endfor
                        </p>
                        <p> From <span> ${{$package->price}} </span></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endforeach
@else
    <p class="text-center">We're sorry. We were not able to find a match.</p>
@endif
{{ $packages->appends(request()->query())->links() }}

{{-- Packages Strat Ends here--}}
