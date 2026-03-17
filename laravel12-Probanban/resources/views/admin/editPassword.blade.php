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

            <h3> :: form Reset :: </h3>


<form action="/admin/reset/{{ $id }}" method="post">
@csrf
@method('put')

<div class="form-group row mb-2">
    <label class="col-sm-2"> Username </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" disabled  value="{{ $admin_username }}">
    </div>
</div>

<div class="form-group row mb-2">
    <label class="col-sm-2"> Admin Name </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" disabled  value="{{ $admin_name }}">
    </div>
</div>


<div class="form-group row mb-2">
    <label class="col-sm-2"> New Password </label>
    <div class="col-sm-6">
        <input type="password" class="form-control" name="newPassword" required placeholder=" New password/รหัสผ่านใหม่" minlength="3">
        @if(isset($errors))
            @if($errors->has('newPassword'))
                <div class="text-danger"> {{ $errors->first('newPassword') }}</div>
            @endif 
        @endif
    </div>
</div>

<div class="form-group row mb-2">
    <label class="col-sm-2"> Confirm New Password </label>
    <div class="col-sm-6">
        <input type="password" class="form-control" name="confirmNewPassword" required placeholder=" Confirm new password/ยืนยันรหัสผ่านใหม่" minlength="3">
        @if(isset($errors))
            @if($errors->has('confirmNewPassword'))
                <div class="text-danger"> {{ $errors->first('confirmNewPassword') }}</div>
            @endif 
        @endif
    </div>
</div>


</div>


<div class="form-group row mb-2">
    <label class="col-sm-2">  </label>
    <div class="col-sm-5">
       <button type="submit" class="btn btn-primary"> Reset Password </button>
       <a href="/admin" class="btn btn-danger">cancel</a>
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