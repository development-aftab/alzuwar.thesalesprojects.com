@push('css')
    <style>
        .card>a>img {height: 227px;object-fit: cover;}
    </style>
@endpush
<div class="tab-pane active" id="view-all" role="tabpanel">
    <div class="row">
        @foreach($transports as $transport)
            <div class="col-md-4 transportation_view_detail">
                <div class="card" style="width: 18re">
                    <i class="far fa-heart heart" PropertyID="{{$transport->VehicleRouteID}}" CategoryID="3" attr="@if($transport->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($transport->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>

                    <a href="{{route('Transportdetails')}}/{{$transport->VehicleRouteID}}/{{$transport->NameofVehicle}}?data={{json_encode(request()->all())}}">
                        <img class="card-img-top" src="{{asset('website')}}/{{$transport->getTransportDefaultPic->PhotoLocation??'img/not_available.png'}}" alt="{{$transport->getTransportDefaultPic->AltText??''}}" alt="{{$transport->getTransportDefaultPic->PhotoTitle??''}}">
                    </a>
                    <div class="card-body">
                        <div class="card_body_content">
                            <p class="three_star">
                                @for( $a=1 ; $a <= round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for( $a=1 ; $a <= 5-round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ )
                                    <i class="far fa-star"></i>
                                @endfor
                                @if(count($transport->getTransportReviewForView)>1)
                                    {{ count($transport->getTransportReviewForView) }} reviews
                                    @else
                                    {{ count($transport->getTransportReviewForView) }} review
                                @endif
                            </p>
                            <h3 class="card-title">{{$transport->NameofVehicle}}</h3>
                            <?php
                            $featuresIds =  explode(',',$transport->FeatureID);
                            $features = App\VehicleFeaturesList::whereIn('FeatureID',$featuresIds)->take(4)->get();
                            ?>
                            <ul class="list-unstyled">
                                @foreach($features as $myfeature)
                                    <li class="stay">
                                        @if($myfeature->ImageIcon)
                                            {!! $myfeature->ImageIcon !!}
                                        @else
                                            <i class="fas fa-dot-circle"></i>
                                        @endif
                                        {{$myfeature->Title}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="final_price">
                            <p class="duration" title="Number Of Seats"> <i class="fas fa-chair"></i> {{$transport->getTransporttype->NumOfSeats.' Seats'??''}} </p>
                            <p class="duration" title="Luggage Capacity"><i class="fas fa-briefcase"></i> {{$transport->getTransporttype->LuggageCapacity.' Bags'??''}} </p>
                            {{--<p class="duration"><i class="fas fa-clock"></i> Pick up Date & Time</p>--}}

                            {{--<?php--}}
                                {{--foreach ($transport->getTransportRoutes as $transportRoutes){--}}
                                    {{--$transportPrice[] = $transportRoutes->Price;--}}
                                {{--}--}}
                            {{--?>--}}
                            {{--<?php--}}
                                {{--foreach ($transport->getTransportRoutes as $transportRoutes){--}}
                                    {{--$transportPrice[] = $transportRoutes->TwoWayPrice;--}}
                                {{--}--}}
                            {{--?>--}}
                            {{--{{$transport->Price??''}}--}}
                            <p> From <span> $ {{number_format($transport->getTransportRoutes[0]->Price??0,2)}}
                                    {{--{{number_format($transport->Price??0,2)}}--}}
                                </span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{$transports->appends(request()->query())->links()}}
    </div>
</div>