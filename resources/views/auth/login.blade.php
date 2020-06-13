@extends('layouts.LoginPage')

@section('title')
    <title>Login </title>
@endsection

@section('content')
    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                <form class="user" action="{{ url('/login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <p class="text-danger">{{$errors->first('email')}}</p>

                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user {{$errors->has('password') ? 'is-invalid' : ''}}" id="password" placeholder="Password">
                    </div>
                    <p class="text-danger">{{$errors->first('password')}}</p>

                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection

