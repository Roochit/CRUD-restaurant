@extends('home')

@section('js_before')
    @include('sweetalert::alert')
@endsection

@section('content')

<h3> :: Form Update Member :: </h3>

<form action="/student/{{ $student->id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')

    {{-- Student Name --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2"> Member Name </label>
        <div class="col-sm-7">
            <input type="text"
                   class="form-control"
                   name="std_name"
                   required
                   minlength="3"
                   value="{{ old('std_name', $student->std_name) }}">
            @error('std_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Student Phone --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2"> Member Phone </label>
        <div class="col-sm-7">
            <input type="text"
                   class="form-control"
                   name="std_phone"
                   required
                   minlength="10"
                   value="{{ old('std_phone', $student->std_phone) }}">
            @error('std_phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Student ID --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2"> Member ID </label>
        <div class="col-sm-7">
            <input type="text"
                   class="form-control"
                   name="std_code"
                   required
                   value="{{ old('std_code', $student->std_code) }}">
            @error('std_code')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Student Image --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2"> Pic </label>
        <div class="col-sm-7">
            <p>Old Image</p>
            @if($student->std_img)
                <img src="{{ asset('storage/' . $student->std_img) }}" width="200"><br><br>
            @else
                <span class="text-muted">No Image</span><br><br>
            @endif

            <p>Choose New Image</p>
            <input type="file" name="std_img" accept="image/*">
            @error('std_img')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Buttons --}}
    <div class="form-group row mb-2">
        <label class="col-sm-2"></label>
        <div class="col-sm-5">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/student" class="btn btn-danger">Cancel</a>
        </div>
    </div>

</form>

@endsection
