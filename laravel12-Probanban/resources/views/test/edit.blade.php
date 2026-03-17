@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">

            <h3> :: form Update  :: </h3>


<form action="/test/{{ $id }}" method="post">
@csrf
@method('put')

<div class="form-group row mb-2">
    <label class="col-sm-2"> Name </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="name" placeholder=" Name" value="{{ $name }}">
        @if(isset($errors))
            @if($errors->has('name'))
                <div class="text-danger"> {{ $errors->first('name') }}</div>
            @endif 
        @endif
    </div>
</div>

<div class="form-group row mb-2">
    <label class="col-sm-2"> Name2 </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="name2" placeholder=" Name2" value="{{ $name2 }}">
        @if(isset($errors))
            @if($errors->has('name2'))
                <div class="text-danger"> {{ $errors->first('name2') }}</div>
            @endif 
        @endif
    </div>
</div>

<div class="form-group row mb-2">
    <label class="col-sm-2"> Name3 </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="name3" placeholder=" Name3" value="{{ $name3 }}">
        @if(isset($errors))
            @if($errors->has('name3'))
                <div class="text-danger"> {{ $errors->first('name3') }}</div>
            @endif 
        @endif
    </div>
</div>


<div class="form-group row mb-2">
    <label class="col-sm-2">  </label>
    <div class="col-sm-5">
       <button type="submit" class="btn btn-primary"> Update  </button>
       <a href="/test" class="btn btn-danger">cancel</a>
    </div>
</div>

</form>
</div> <!--  / <div class="col-sm-9 col-md-9"> -->


    @endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection