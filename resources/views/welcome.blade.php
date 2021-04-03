@php($login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login'))
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
<link rel="icon" href="img/SeasScape.png">
<title>Seascape</title>

<nav class="navbar navbar-expand-lg " style="background-color:#131F2E">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse row" id="navbarTogglerDemo01">
     <div class="col-sm-8">
     <img src="img/SeasScape.png" width="80" height="80" class="d-inline-block align-middle " alt="seascape">
    <h1  style="vertical-align: middle ;display: inline; color:rgb(152, 176, 206)">Seascape</h1>
    </div>
            @if (Auth::guard('user')->user() || Auth::guard('client')->user())


          @if(Auth::guard('user')->user())
              @if(Auth::guard('user')->user()->role == 'receptionist')
                  <a class="col-sm-2 btn btn-outline-secondary" style="color:rgb(152, 176, 206);margin-right: 10px;"  href="{{route('users.nonApprovedClients')}}">Manage clients </a>
              @else
                  <a class="col-sm-2 btn btn-outline-secondary" style="color:rgb(152, 176, 206);margin-right: 10px;"  href="{{route('users.index')}}">Manage users </a>
              @endif
          @else
              <a class="col-sm-2 btn btn-outline-secondary" style="color:rgb(152, 176, 206);margin-right: 10px;"  href="{{route('clients.index')}}">Make reservations</a>
          @endif
              @include('adminlte::partials.navbar.menu-item-logout-link')
            @else
                <a style="color:rgb(152, 176, 206);margin-right: 10px;" class="col-sm-1 btn btn-outline-secondary" href={{ route('users.login') }} >Staff Login</a>
                <a class="col-sm-1 btn btn-outline-secondary" style="color:rgb(152, 176, 206)"  href={{ $login_url }}>Client Login</a>

            @endif
  </div>
</nav>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="img/3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br>
<br>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <i class="bi bi-cash-stack" style='font-size:48px;color:#4284DF;vertical-align: bottom'></i>
                    <h3 style="display:inline;vertical-align: bottom"> Members Rate</h3>
                </div>
                <div class="col-lg-4 col-md-4">
                    <i class="bi bi-wifi"style='font-size:48px;color:#4284DF;vertical-align: bottom'></i>
                    <h3 style="display:inline;vertical-align: bottom"> Free Wi-Fi</h3>
                </div>
                <div class="col-lg-4 col-md-4">
                    <img src="img/bed.png" width="50px" height="50px">
                    <h3 style="display:inline;vertical-align: bottom">Room Type Guarantee</h3>
                </div>
            </div>
        </div>
    </div>


<br>
<br>
<div >
<img src="https://cdn.galaxy.tf/thumb/sizeW1920/uploads/3s/cms_image/001/583/186/1583186614_5e5d82b6c8f00-thumb.png" width="100%" height="400px">
<div style="  position: absolute;
  top: 190%;
  left: 50%;
  transform: translate(-50%, -50%);">
<h2 style="text-align:center;color:white;  font-weight: bold;font-size: 30px;">Beach & Pool</h2>
<p style="text-align:center;color:white; font-weight: bold;">In Seascape, a pool is a most sought after perk, ours is framed by panoramic views of Miami Beach and the Atlantic Ocean. Stroll one block to the 21st Street beach and our beach service has you covered with two free chairs daily. We also provide complimentary golf cart shuttle service to and from the beach.</p>
</div>
<div>
<br>
<br>

<div class="container">
<div class="card-deck">
  <div class="card">
    <img src="img/Large-bed.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Amazing beds</h5>
      <p class="card-text"> The beds are often extremely large and comfortable and the sheets are heavy, and you feel so cosy you may struggle to get out of them. You are also likely to get a large number of pillows.</p>

    </div>
  </div>
  <div class="card">
    <img src="img/Bath.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Lots of amenities</h5>
      <p class="card-text">Rooms will almost definitely come with lots of amenities and everything you’d probably need. The amenities may include robes, slippers, coffee machines, large TV with lots of channels, spacious desks, minibars, lots of lots of towels, high-quality toiletries and more.</p>

    </div>
  </div>
  <div class="card">
    <img src="img/Spa.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Pool facilities</h5>
      <p class="card-text">Not every luxury hotel will have a pool but many of them do. Some of them have rooftop pools, heated outdoor pools and also indoor pools. You may also get separate pools for children and hot tubs/whirlpools.</p>

    </div>
  </div>
</div>
</div>
<br>
<br>
<br>

<div style="background-color:#131F2E;height:100px;padding:20px "  >

     <img src="img/SeasScape.png" width="70" height="70"  alt="">
    <h1  style="vertical-align: middle ;display: inline; color:rgb(152, 176, 206)">Seascape</h1>
    <p style="color:rgb(152, 176, 206);float:right;padding:10px">All Rights Reserved.</p>

</div>




<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
