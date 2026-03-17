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
<a class="nav-link text-white" href="https://devbanban.com/?p=4425">
DevBanBan
</a>
</li>

<li class="nav-item">
<a class="nav-link text-white" href="https://www.facebook.com/sornwebsites">
Facebook
</a>
</li>


@guest
<li class="nav-item">
<a class="nav-link text-white" href="{{ route('login') }}">
Login
</a>
</li>
@endguest


@auth

<li class="nav-item">
<a class="nav-link text-white" href="/dashboard" target="_blank">
BackOffice
</a>
</li>

<li class="nav-item">
<form action="{{ route('logout') }}" method="POST" class="d-inline">
@csrf
<button class="btn btn-danger btn-sm ms-2">
Logout
</button>
</form>
</li>

@endauth


</ul>


<form action="/search" method="get" class="d-flex">

<input
class="form-control me-2"
type="text"
name="keyword"
placeholder="Search"
required
value="{{ $keyword ?? ''}}"
>

<button class="btn btn-warning">
Search
</button>

</form>


</div>
</div>
</nav>

</div>
</div>

<!-- END NAVBAR -->



@yield('navbar')



<div class="container mt-4 mb-2">
<div class="row">

@yield('showProduct')

</div>
</div>




<!-- FOOTER -->

<footer class="bg-dark text-white mt-5 pt-5 pb-4">

<div class="container text-center text-md-left">

<div class="row text-center text-md-left">


<div class="col-12 col-sm-4 col-lg-4 mt-3">

<h5 class="text-uppercase mb-4 text-warning">
สถาบันเทคโนโลยีไทย-ญี่ปุ่น
</h5>

<p>
สถานศึกษาของเราอยู่พัฒนาการนะครับ <br>
ไม่ใช่ที่ดินแดง นั่นสนามกีฬาครับ~
</p>

<hr>

<p>
ที่อยู่ : 1771/1 ถ.พัฒนาการ แขวงสวนหลวง เขตสวนหลวง กรุงเทพมหานคร 10250
</p>

</div>



<div class="col-12 col-sm-4 col-lg-4 mt-3">

<h5 class="text-uppercase mb-4 text-warning">
ติดต่อเรา
</h5>

<p>tniinfo@tni.ac.th</p>
<p>Tel. 0-2763-2601-5</p>
<p>Fax. 0-2763-2700</p>

</div>



<div class="col-12 col-sm-4 col-lg-4 mb-3">

<h5 class="text-uppercase mb-4 text-warning">
ติดตามเรา
</h5>

<p>
<a href="#" class="text-white text-decoration-none">
นโยบายความเป็นส่วนตัว
</a>
</p>

<p>
<a href="#" class="text-white text-decoration-none">
แผนที่
</a>
</p>


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


<div class="row align-items-center">

<div class="col-12">

<p class="text-center">

© 2025 นักศึกษาสาขาเทคโนโลยีสารสนเทศ  
สถาบันเทคโนโลยีไทย-ญี่ปุ่น

<br>

<a href="https://devbanban.com/" class="text-warning">
devbanban.com
</a>

</p>

</div>

</div>

</div>

</footer>


@yield('footer')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

@yield('js_before')

</body>
</html>