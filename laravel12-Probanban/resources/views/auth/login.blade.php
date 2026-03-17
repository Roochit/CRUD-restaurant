@extends('frontendAuth')
@section('css_before')
@section('navbar')
@endsection

@section('showProduct')


<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-6">

            <h3> Sign in </h3>


            <form action="/login" method="post">
                @csrf



                <div class="form-group row mb-2">
                    
                    <div class="col-sm-7">
                        <input type="email" class="form-control" name="admin_username" required placeholder="email/username"
                            minlength="3" value="{{ old('admin_username') }}">
                        @if(isset($errors))
                        @if($errors->has('admin_username'))
                        <div class="text-danger"> {{ $errors->first('admin_username') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    
                    <div class="col-sm-7">
                        <input type="password" class="form-control" name="admin_password" required placeholder="Password"
                            minlength="3">
                        @if(isset($errors))
                        @if($errors->has('admin_password'))
                        <div class="text-danger"> {{ $errors->first('admin_password') }}</div>
                        @endif
                        @endif
                    </div>
                </div>

               
 

                <div class="form-group row mb-2">
                    
                    <div class="col-sm-5">

                        <button type="submit" class="btn btn-primary"> Login </button>
                        <a href="/" class="btn btn-danger">cancel</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}