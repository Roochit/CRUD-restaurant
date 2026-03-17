@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')
 


    <h3> :: Form Add Restaurants  :: </h3>

    <form action="/product/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Restaurants Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="product_name" required placeholder="Restaurants Name "
                    minlength="3" value="{{ old('product_name') }}">
                @if(isset($errors))
                @if($errors->has('product_name'))
                <div class="text-danger"> {{ $errors->first('product_name') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Restaurants detail </label>
            <div class="col-sm-7">
                <textarea name="product_detail" class="form-control" rows="4" required
                    placeholder="Restaurants detail ">{{ old('product_detail') }}</textarea>
                @if(isset($errors))
                @if($errors->has('product_detail'))
                <div class="text-danger"> {{ $errors->first('product_detail') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Review </label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="product_reviwe" required placeholder="Review"
                    min="0" value="{{ old('product_reviwe') }}">
                @if(isset($errors))
                @if($errors->has('product_reviwe'))
                <div class="text-danger"> {{ $errors->first('product_reviwe') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                <input type="file" name="product_img" required placeholder="product_img" accept="image/*">
                @if(isset($errors))
                @if($errors->has('product_img'))
                <div class="text-danger"> {{ $errors->first('product_img') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-5">

                <button type="submit" class="btn btn-primary"> Insert Restaurants </button>
                <a href="/product" class="btn btn-danger">cancel</a>
            </div>
        </div>

    </form>

</div>

    
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}