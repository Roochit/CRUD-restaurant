@extends('frontend')
@section('css_before')
@section('navbar')
@endsection

@section('showProduct')

    @foreach($allProduct as $data)
    <div class="col-12 col-sm-4 col-md-4 col-lg-3 mb-2">
      <div class="card" style="width: 100%; height: 450px">
        <a href="/detail/{{ $data->id }}">

          <img src="{{ asset('storage/' . $data->product_img) }}"  style="height:250px; object-fit:cover;"  class="card-img-top" alt="devbanban.com">
        </a>
        <div class="card-body d-flex flex-column">
          
          <h5 class="card-title">
            <a href="/detail/{{ $data->id }}" 
              class="link-offset-2 link-underline link-underline-opacity-0 text-dark">
              {{ $data->product_name }}
            </a>
          </h5>

          <p class="card-text text-dark">
            {{ number_format($data->product_reviwe) }} /10 ⭐ดาว
          </p>

          <div class="mt-auto">
            <a href="/detail/{{ $data->id }}" class="btn btn-success w-100">
              ดูเพิ่มเติม..
            </a>
          </div>

        </div>
      </div>
    </div>
    @endforeach



  <div class="row mt-2 mb-2">
    <!-- Pagination links -->
    <div class="col-sm-5 col-md-5"></div>
    <div class="col-sm-3 col-md-3">
      <center>
        {{ $allProduct->links() }}
      </center>
    </div>
</div>




@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}