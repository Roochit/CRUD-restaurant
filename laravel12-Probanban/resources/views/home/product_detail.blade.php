@extends('frontend')

@section('css_before')
@endsection

@section('navbar')
@endsection

{{-- ปิด Carousel --}}
@section('carousel')
@endsection

@section('showProduct')

<div class="col-12 col-sm-3 col-md-3 mb-2">
    <div class="card" style="width: 100%;">
        <img src="{{ asset('storage/' . $product_img) }}" class="card-img-top" alt="devbanban.com">
    </div>
</div>

<div class="col-12 col-sm-8 col-md-8 mb-2">
    <h5 class="card-title">{{ $product_name }}</h5>
    <h6 class="card-subtitle mb-2 text-warning">
    {{ number_format($product_reviwe) }} / 10 ⭐ดาว
</h6>

    <p>
        Restaurants Detail
        <br>
        {{ $product_detail }}
    </p>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}