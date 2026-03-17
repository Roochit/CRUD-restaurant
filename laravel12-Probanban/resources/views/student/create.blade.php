@extends('layouts.backend')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<h3> :: Form Add Member :: </h3>

<form action="/student" method="post" enctype="multipart/form-data">
    @csrf

    {{-- Student Name --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2">Member Name</label>
        <div class="col-sm-7">
            <input type="text"
                   class="form-control"
                   name="std_name"
                   required
                   minlength="3"
                   value="{{ old('std_name') }}">
            @error('std_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Student Phone --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2">Member Phone</label>
        <div class="col-sm-7">
            <input type="text"
                   class="form-control"
                   name="std_phone"
                   required
                   minlength="10"
                   value="{{ old('std_phone') }}">
            @error('std_phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Student Code --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2">Member ID</label>
        <div class="col-sm-7">
            <input type="text"
                   class="form-control"
                   name="std_code"
                   required
                   value="{{ old('std_code') }}">
            @error('std_code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Image --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2">Picture</label>
        <div class="col-sm-6">
            <input type="file"
                   name="std_img"
                   required
                   accept="image/*">
            @error('std_img')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Submit --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Insert Member</button>
            <a href="/student" class="btn btn-danger">Cancel</a>
        </div>
    </div>

</form>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection
