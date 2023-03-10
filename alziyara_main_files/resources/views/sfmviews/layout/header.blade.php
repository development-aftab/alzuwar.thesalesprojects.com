<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{URL::asset('/css/css/style.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{URL::asset('/css/css/responsive.css')}}" >
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    
    <title>{{ config('app.name', 'sfmInternational') }}</title>

  </head>
  <header class="collin-header">
    <div class="container-fluid collin-container">
      <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" href="{{url('sfmhome')}}"><img src="./images/header-Logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="nav-center navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('sfmhome')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('sfmgame')}}">Game</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('sfmfundraising')}}">FundRaising</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('sfmshop')}}">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('sfmabout')}}">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('sfmcoming')}}">Coming soon</a>
            </li>

            </ul>

            <ul class="nav-right navbar-nav">
            <li class="nav-item">
              <a class="nav-link nav-contest" href="#"> CONTEST</a>
            </li>

            <li class="nav-item">
              <a class="nav-link nav-join" href="#">Join</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-login" href="#">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon" href="#"><i class="fas fa-shopping-cart"></i></a>
            </li>
            </ul>
      </nav>   
    </div>
  </header>
</html>