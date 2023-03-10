{{--<div class="tab-content">--}}
@if($guestpass->count()>=1)
<div class="tab-pane active" id="all_tab" role="tabpanel">
    <div class="row">
        @foreach($guestpass as $gp)
            {{--@if(ucfirst($gp->GuestPassLocation) == 'Karbala')--}}
            <div class="col-md-4 guestpass_view_detail">
                <i class="far fa-heart heart" PropertyID="{{$gp->GuestPassID}}" CategoryID="4" attr="@if($gp->getUserFavoriteProperties!=null){{'heart_checked'}}@else{{'heart_unchecked'}}@endif" style="@if($gp->getUserFavoriteProperties!=null){{'background:red'}} @else{{'background:grey'}}@endif" value="abc" id="heart"></i>
                <a href="{{route('guestsdetails')}}/{{$gp->GuestPassID}}/{{$gp->GuestPassName}}">
                    <div class="card">
                        @foreach($gp->getGuestPassDetails as $gp_pics)
                            @if($gp_pics->DefaultFlag == '1')
                                <img class="card-img-top" src="{{asset('website').'/'.$gp_pics->PhotoLocation}}" alt="{{$gp->AltText}}">
                            @endif
                        @endforeach
                        <div class="card-body">
                            <div class="card_body_content">
                                <p class="three_star"><i class="fas fa-map-marker-alt"></i>{{$gp->GuestPassLocation}}</p>
                                <h3 class="card-title" title="{{$gp->GuestPassName}}"> {{$gp->GuestPassName}}</h3>
                                <div class="mycardguestpassdescription">{!! $gp->GuestPassDesc !!}</div>
                            </div>
                            {{--<div class="mycardguestpassdescription">--}}
                                {{--{!! $gp->GuestPassDesc !!}--}}
                            {{--</div>--}}
                            <div class="final_price">
                                <p>
                                    @for( $a=1 ; $a <= round($gp->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @for( $a=1 ; $a <= 5-round($gp->getGuestPassreviewdetails->avg('Rating')) ; $a++ )
                                        <i class="far fa-star"></i>
                                    @endfor
                                </p>
                                <p> From <span>$ {{number_format($gp->Price, 2, '.', '')}} </span></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{--@endif--}}
        @endforeach
        {{ $guestpass->appends(request()->query())->links() }}
    </div>
</div>
@else
<p class="text-center">We're sorry. We were not able to find a match.</p>
@endif