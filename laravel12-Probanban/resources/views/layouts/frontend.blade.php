<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laravel 12 Basic CRUD by devbanban.com 2025</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

@yield('css_before')
</head>

<body>

<!-- NAVBAR -->
<div class="row">
<div class="col-12">

<nav class="navbar navbar-expand-lg bg-dark">
<div class="container">

<a class="navbar-brand text-warning" href="/">Restaurants review</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav me-auto mb-2 mb-lg-0">

<li class="nav-item">
<a class="nav-link active text-white" href="/">Home</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="https://devbanban.com/?p=4425">devbanban</a>
</li>

@guest
<li class="nav-item">
<a class="nav-link text-white" href="{{ route('login') }}">Login</a>
</li>
@endguest

@auth
<li class="nav-item">
<a class="nav-link text-white" href="/dashboard">BackOffice</a>
</li>

<li class="nav-item">
<form action="{{ route('logout') }}" method="POST" class="d-inline">
@csrf
<button type="submit" class="btn btn-danger btn-sm ms-2">
Logout
</button>
</form>
</li>
@endauth

</ul>

<form action="/search" method="get" class="d-flex">
<input class="form-control me-2"
type="text"
name="keyword"
placeholder="Search"
required
value="{{ $keyword ?? ''}}">

<button class="btn btn-warning">Search</button>
</form>

</div>
</div>
</nav>

</div>
</div>
<!-- END NAVBAR -->


<!-- HEADER -->
<div class="container mt-2 mb-2">
<div class="row">
<div class="col-12">

<div class="alert alert-warning text-dark text-center fw-bold">
::Restaurants::
</div>

</div>
</div>
</div>


@yield('navbar')


{{-- CAROUSEL --}}
@yield('carousel')

@section('carousel')

<div id="carouselExampleIndicators" class="carousel slide">

<div class="carousel-indicators">

<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>

<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>

<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>

</div>


<div class="carousel-inner">

<div class="carousel-item active">
<img src="{{ asset('img/rester1.jpg') }}" class="d-block w-100" height="400">
</div>

<div class="carousel-item">
<img src="{{ asset('img/kfc.jpg') }}" class="d-block w-100" height="400">
</div>

<div class="carousel-item">
<img src="{{ asset('img/rester3.png') }}" class="d-block w-100" height="400">
</div>

</div>


<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
<span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
<span class="carousel-control-next-icon"></span>
</button>

</div>

@show
{{-- END CAROUSEL --}}


<div class="container mt-5">
<div class="row">
@yield('showProduct')
</div>
</div>


<!-- FOOTER -->
<footer class="bg-dark text-white pt-5 pb-4">

<div class="container text-center text-md-left">

<div class="row">

<div class="col-md-4 mt-3">
<h5 class="text-warning">สถาบันเทคโนโลยีไทย-ญี่ปุ่น</h5>

<p>
สถานศึกษาของเราอยู่พัฒนาการนะครับ <br>
ไม่ใช่ที่ดินแดง นั่นสนามกีฬาครับ~
</p>

<p>
ที่อยู่ : 1771/1 ถ.พัฒนาการ แขวงสวนหลวง เขตสวนหลวง กรุงเทพฯ
</p>

</div>


<div class="col-md-4 mt-3">

<h5 class="text-warning">ติดต่อเรา</h5>

<p>tniinfo@tni.ac.th</p>

<p>Tel. 0-2763-2601-5</p>

<p>Fax. 0-2763-2700</p>

</div>


<div class="col-md-4 mt-3">

<h5 class="text-warning">ติดตามเรา</h5>

<div class="mt-3">

<a href="https://www.facebook.com/sornwebsites" target="_blank">
<img src="{{ asset('img/icon/facebooklogo.png') }}" width="40">
</a>

<a href="https://devbanban.com/?page_id=2675" target="_blank">
<img src="{{ asset('img/icon/linelogo60.png') }}" width="40">
</a>

<a href="https://www.instagram.com/devbanban/?hl=en" target="_blank">
<img src="{{ asset('img/icon/instagramlogo.png') }}" width="40">
</a>

</div>

</div>

</div>


<hr class="mb-4">

<div class="text-center">

© 2025 นักศึกษาสาขา IT - TNI

<br>

<a href="https://devbanban.com/" class="text-warning">
devbanban.com
</a>

</div>

</div>

</footer>
<!-- END FOOTER -->


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

@yield('js_before')

</body>
</html>