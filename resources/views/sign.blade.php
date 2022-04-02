@extends('layout')
@section('title')
    Sign Up
@endsection
@section('main_section')


    <div class="container register">
        <div class="row">

            <div class="col-md-9 register-right">
                @if($errors->any())
                    <div class = 'alert alert-danger'>
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{$err}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Apply as a User</h3>
                        <form action="{{route('sign')}}" method="post">

                        <div class="row register-form">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="First Name *"   />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password"  placeholder="Password *"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control"  name="login" placeholder="Login" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password *"  />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email *"  />
                                </div>

                                <input type="submit" class="btnRegister"  value="Register"/>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
