@extends('layout')
@section('title')
    Sign Up
@endsection
@section('main_section')
@if(session()->has('user_id'))

    <div class="container register">
        <div class="row">

            <div class="col-md-9 register-right">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Apply as a User</h3>
                        <form action="{{route('user')}}" method="post" enctype="multipart/form-data" >

                        <div class="row register-form">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="title" placeholder="Title"   />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message"  placeholder="Your request"  ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" name="file[]" placeholder=""  />
                            </div>
                            <div class="col-md-6">



                                <input type="submit" class="btnRegister"  value="Register"/>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        @if($errors->any())
            <div class = 'alert alert-danger'>
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->get('timer'))
            <div class = 'alert alert-danger'>
            NO MORE REQUESTS
            </div>
        @endif

    </div>


@else
    <div>
        please <a href="{{url('/')}}/login"> login</a>
    </div>
@endif
@endsection
