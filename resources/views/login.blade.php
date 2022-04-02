@extends('layout')
@section('title')
    Login
@endsection
@section('main_section')
    <div class="container login-container">
        <div class="row">
            @if($errors->any())
                <div class = 'alert alert-danger'>
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-md-6 login-form-1">
                <h3>Login for</h3>
                <form action="/login/check" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="login" class="form-control" placeholder="Your Login" value="" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Your Password " value="" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" />
                    </div>
                    <div class="form-group">
                        <a href="{{url('/')}}/signup" class="ForgetPwd">Sign UP</a>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
