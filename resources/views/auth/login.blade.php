@extends('layouts.app')

@section('content')
<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2"
        style="background-image: url('https://images.unsplash.com/photo-1574297500578-afae55026ff3?ixid=MnwxMjA3fDB8MHxzZWFyY2h8OHx8aGlqYWJ8ZW58MHx8MHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=60');">
    </div>
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3>Login to <strong>Ratu Outfit</strong></h3>
                    <p class="mb-4">Sebuah portal penjualan kerudung terbaik #contoh</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group first">
                            <label for="username">Username</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autofocus
                                placeholder="your-email@gmail.com">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group last mb-3">
                            <label for="password">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                placeholder="Your Password" id="password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="d-flex mb-5 align-items-center">
                            <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                {{-- <input type="checkbox" checked="checked"> --}}
                                <input class="form-check-input" type="checkbox" checked="checked" name="remember"
                                    id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <div class="control__indicator"></div>
                            </label>
                            @if (Route::has('password.request'))
                            <span class="ml-auto">
                                <a class="forgot-pass" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </span>
                            @endif
                        </div>

                        <input type="submit" value="Log In" class="btn btn-block btn-primary">

                        <div class="row my-3">
                            <div class="col-md-6">
                                <a href="{{ url('/auth/facebook') }}" class="btn py-3"
                                    style="background-color:#04009A;color:white;text-decoration: none;">
                                    <i class="fab fa-facebook-f"></i> <span class="mx-1"> Facebook</span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                {{-- <a href="{{ url('/auth/google') }}" class="btn btn-danger"><i
                                    class="fab fa-google text-white"></i> <span class="text-white mx-3"
                                    style="text-decoration: none;">Google</span> </a> --}}
                                <a href="{{ url('/auth/google') }}" class="btn btn-danger py-3"
                                    style="text-decoration:none;color:white;">
                                    <i class="fab fa-google"></i> <span class="mx-1"> Google</span></a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
