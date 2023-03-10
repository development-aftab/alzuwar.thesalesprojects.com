@if(sizeof($guides)>0)
<div class="tab-pane active" id="tabs-1" role="tabpanel">
    <style>.mycardguidedescription{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}</style>
    <div class="row">
        @foreach($guides as $guide)
            <div class="col-md-4 guide_view_detail">
                <div class="card" style="width: 18rem">
                    {{--<a href="./tansportation-details.php">--}}
                    <i class="far fa-heart heart" PropertyID="{{$guide->GuidesID}}" CategoryID="5" attr="@if($guide->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($guide->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
                    <a href="{{route('guide-details')}}/{{$guide->GuidesID??''}}/{{$guide->GuidesName??''}}?data={{json_encode(request()->all())}}">
                        @if(isset($guide->getGuideDefaultPic->PhotoLocation))
                            <img class="card-img-top" src="{{asset('website')}}/{{$guide->getGuideDefaultPic->PhotoLocation}}" alt="{{$guide->getGuideDefaultPic->AltText}}" title="{{$guide->getGuideDefaultPic->PhotoTitle}}">
                        @else
                            <img class="card-img-top" src="{{asset('website/img/not_available.png')}}" alt="Not Available" title="Not Available">
                        @endif
                    </a>
                    <div class="card-body">
                        <div class="card_body_content">
                            <p class="three_star">
                                @for( $a=1 ; $a <= round($guide->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($guide->getGuideReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                @if(count($guide->getGuideReviewForView)>1)
                                    {{ count($guide->getGuideReviewForView) }} reviews
                                @else
                                    {{ count($guide->getGuideReviewForView) }} review
                                @endif
                            </p>
                            <h3 class="card-title">{{$guide->GuidesName}}</h3>														<div class="mycardguidedescription">															{!! $guide->GuidesDesc !!}															</div>
                            {{--<ul class="list-unstyled">--}}
                            {{--<li class="date"><i class="fas fa-bus"></i> Deluxe Bus </li>--}}
                            {{--<li class="stay"><i class="fas fa-coffee"></i> Tea or Coffee Complimentry </li>--}}
                            {{--<li class="house"><i class="fas fa-utensils"></i> Lunch Included</li>--}}
                            {{--<li class="airfare"><i class="fas fa-headphones"></i> Headphones Available </li>--}}
                            {{--</ul>--}}
                        </div>
                        <div class="final_price">
                            <p class="duration"><i class="fa fa-language"></i> Language : {{$guide->Languages}} 
                            </p>
                            <p>  <span> ${{number_format($guide->PricePerDay, 0, '.', '')}}/day</span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{$guides->appends(request()->query())->links()}}
    </div>
</div>
@else
    <p class="text-center">We're sorry. We were not able to find a match.</p>
@endif