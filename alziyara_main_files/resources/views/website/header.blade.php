<style>
    .list_your_services_header {
        padding: 30px 140px 30px 160px;
    }
    .list_your_services_header .logo_side img {
        width: 30%;
        margin-top: 0px;
        margin-bottom: 20px;
    }
    .list_your_services_header .head_txt h1 {
        font-size: 36px;
    }
    .list_your_services_header .head_txt p {
        font-size: 19px ;
    }
    .list_your_services_header .col-md-12 {
        padding: 0px;
    }
    .list_your_services_header .logo_side {
        width: 19%;
        text-align: center;
    }
    .home .navbar h2 {color: #fff;}
    .updatedheader_sec .navbar h2{margin-top: 25px;}

</style>

@if(Route::current()->getName() == 'list-your-services')
    <section class="sp_header list_your_services_header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="in_head">
                        <div class="head_txt">
                            <h1>Alziyara.com - Services Providers</h1>
                            <p>Now Open A Free Account Digitally And Provide Services</p>
                        </div>
                        <div class="logo_side">
                            <img src="{{asset('website/img/logo.png')}}" alt="">
                            <div class="head_btns">
                                <a href="{{url('user-signup')}}"><i class="far fa-user"></i>Create Account</a>
                                <a href="{{url('user-login')}}"><i class="fas fa-sign-in-alt"></i>Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
<header>
    <section class="updatedheader_sec">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                {{--<div class="container-fluid">--}}
                <a class="navbar-brand" href="{{route('index')}}"><img src="{{ asset('website') }}/img/alziyara_white_background_logo.png" alt="Logo"></a>
                <h2>AlZuwar.com</h2>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="row mainnavbar">
                        <div class="col-md-12">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 primarynavbar">
                                <li class="nav-item pt-2">
                                    @if(!Auth::user())
                                        <a class="nav-link" aria-current="page" href="{{url('list-your-services')}}"><i class="fas fa-list-ul"></i>List your Services<span class="sr-only">(current)</span></a>
                                    @elseif(Auth::user()->hasRole('SuperAdmin'))
                                        <a class="nav-link" aria-current="page" href="{{url('dashboard')}}"><i class="fas fa-desktop mr-2"></i>Dashboard<span class="sr-only">(current)</span></a>
                                    {{--@else--}}
                                        {{--<a class="nav-link"  aria-current="page" @if(Auth::user()->hasRole('customer'))href="{{url('profile')}}"@endif><i class="far fa-envelope mr-2"></i>{{Auth::user()->email??''}}<span class="sr-only"> (current)</span></a>--}}
                                    @endif
                                </li>
                                <li class="nav-item pt-2">
                                    @if(!Auth::user())
                                        <a class="nav-link"  aria-current="page" href="{{url('user-signup')}}"><i class="far fa-user mr-2"></i>Register<span class="sr-only"> (current)</span></a>
                                    @else
                                        <a class="nav-link"  aria-current="page" @if(Auth::user()->hasRole('customer'))href="{{url('profile')}}" @elseif(Auth::user()->hasRole('SuperAdmin'))href="{{url('account-settings')}}" @endif><i class="far fa-user mr-2"></i>{{Auth::user()->name??''}}<span class="sr-only"> (current)</span></a>
                                    @endif
                                </li>
                                <li class="nav-item pt-2">
                                    @if(isset(Auth::user()->name))
                                        <a class="nav-link"  aria-current="page" href="{{url('logout')}}"><i class="fas fa-sign-in-alt mr-2"></i>Logout</a>
                                    @else
                                        <a class="nav-link"  aria-current="page" href="{{url('user-login')}}"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
                                    @endif
                                </li>

                                {{--<li class="nav-item"><a  aria-current="page" href="#" class="spanish translation-links" data-lang="Arabic"><img style="height: 40px" src="https://www.countryflags.io/IQ/shiny/64.png"></a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item "><a  aria-current="page" href="#" class="English translation-links" data-lang="English"><img style="height: 40px" src="https://www.countryflags.io/US/shiny/64.png"></a>--}}
                                {{--</li>--}}
                                {{--<li class="dropdown">--}}
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-globe mr-2"></i>Language <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a aria-current="page" href="#" class="spanish translation-links black" data-lang="Arabic">Arabic
                                                {{--<img style="height: 40px" src="https://www.countryflags.io/IQ/shiny/64.png">--}}
                                            </a>
                                </li>
                                        <li>
                                            <a aria-current="page" href="#" class="English translation-links black" data-lang="English">English
                                                {{--<img style="height: 40px" src="https://www.countryflags.io/US/shiny/64.png">--}}
                                            </a>
                                        </li>
                                        <li>
                                            <a aria-current="page" href="#" class="English translation-links black" data-lang="Urdu">Urdu
                                                {{--<img style="height: 40px" src="https://www.countryflags.io/US/shiny/64.png">--}}
                                            </a>
                                        </li>
                                        <li>
                                            <a aria-current="page" href="#" class="English translation-links black" data-lang="Persian">Farsi
                                                {{--<img style="height: 40px" src="https://www.countryflags.io/US/shiny/64.png">--}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 secondarynavbar">
                                <li class="nav-item">
                                    <a class="nav-link"  aria-current="page" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"  aria-current="page" href="{{route('aboutus')}}">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="{{route('contact_us')}}">Contact Us</a>
                                </li>
                                @if(Auth::check())
                                    @if(Auth::user()->hasRole('customer'))
                                        <li class="nav-item">
                                            <a class="nav-link cart_icon"  aria-current="page" href="{{route('checkout')}}"><i class="fas fa-shopping-cart"></i></a>
                                        </li>
                                    @endif
                                @endif
                                @if(isset(Auth::user()->name))
                                    <li class="nav-item">
                                        @if(sizeof(\App\PropertyFavorite::where(['user_id' => Auth::id()])->get())>0)
                                            <a class="nav-link cart_icon_red" aria-current="page" href="{{route('view-favorites')}}"><i class="fas fa-heart"></i></a>
                                        @else
                                            <a class="nav-link cart_icon" aria-current="page" href="{{route('view-favorites')}}"><i class="fas fa-heart"></i></a>
                                        @endif
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>
                {{--</div>--}}
            </nav>
        </div>
    </section>

    <section class="navv">
        <div class="row outernav">
            <div class="col-md-12">
                <ul class="mb-2 mb-lg-0 tertiarynavbar">
                    <li class="nav-item @if((\Request::route()->getName()=='packages')) active @endif">
                        <a class="nav-link" aria-current="page" href="{{route('packages')}}"><i class="far fa-envelope-open"></i> <span>Packages</span></a>
                    </li>
                    <li class="nav-item @if((\Request::route()->getName()=='visa')) active @endif">
                        <a class="nav-link" aria-current="page" href="{{route('visa')}}"><i class="fas fa-ticket-alt"></i> <span>Visa</span></a>
                    </li>
                    <li class="nav-item @if((\Request::route()->getName()=='flight')) active @endif">
                        <a class="nav-link" aria-current="page" href="{{route('flight')}}"><i class="fas fa-plane-departure"></i> <span>Flights</span></a>
                    </li>
                    <li class="nav-item @if((\Request::route()->getName()=='hotels')) active @endif">
                        <a class="nav-link" aria-current="page" href="{{route('hotels')}}"><i class="fas fa-hotel"></i> <span>Hotels</span></a>
                    </li>
                    <li class="nav-item @if((\Request::route()->getName()=='guestspasses')) active @endif">
                        <a class="nav-link" aria-current="page" href="{{route('guestspasses')}}"><i class="fas fa-user"></i> <span>Shrines Programs</span></a>
                    </li>
                    <li class="nav-item @if((\Request::route()->getName()=='Transport')) active @endif">
                        <a class="nav-link" aria-current="page" href="{{route('Transport')}}"><i class="fas fa-bus"></i> <span>Transports</span></a>
                    </li>
                    <li class="nav-item @if((\Request::route()->getName()=='guide')) active @endif">
                        <a class="nav-link" aria-current="page" href="{{route('guide')}}"><i class="fas fa-bus"></i> <span>Guides</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</header>
@endif