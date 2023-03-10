<!doctype html>
<html lang="en">

    @include('ziyaraviews.layout.header')


    <section class="header-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <a class="navbar-brand" href="index.php"><img src="./img/logo.png" class="img-fluid" alt=""></a>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="action_bar">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <div class="container nav-header">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="#"><i class="fas fa-list-ul"></i>List your
                                                        Services<span class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#"><i class="far fa-user"></i>Register<span
                                                            class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#"><i class="fas fa-sign-in-alt"></i>Login</a>
                                                </li>
                                                <li>
                                                    <a class="nav-link" href="#"><i class="fas fa-globe"></i><select
                                                            class="form-select" aria-label="Default select example">
                                                            <option selected>Select Language</option>
                                                            <option value="1">English</option>
                                                            <option value="2">Arabic</option>
                                                        </select></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="primary_nav">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <div class="container nav-header">

                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="#">Home <span
                                                            class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="about-us.php">About Us</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#">Contact Us</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link cart_icon" href="./cart.php"><i
                                                            class="fas fa-shopping-cart"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="secondary_nav">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <div class="container nav-header">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>

                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav ml-auto">
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="packages-deals.php"><i
                                                            class="far fa-envelope-open"></i>Package deals<span
                                                            class="sr-only">(current)</span></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="visa.php"><i
                                                            class="fas fa-ticket-alt"></i>Visa</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="flights.php"><i
                                                            class="fas fa-plane-departure"></i>Flights</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hotels.php"><i
                                                            class="fas fa-hotel"></i>Hotel</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="guest-passes.php"><i
                                                            class="fas fa-user"></i>Guest Pass</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="transportation.php"><i
                                                            class="fas fa-bus"></i>Transportation</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="guide.php"><i class="fas fa-bus"></i>Guide</a>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <body>
        @yield('content')
    </body>
    @include('ziyaraviews.layout.footer')

</html>