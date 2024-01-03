@extends('layouts.app')


@section('content')
<main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Login</h3>
                </div>
                <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>{{ __('cpfNo') }}</label>
                    <div class="mb-3">
                        <!-- <input id="cpfNo" type="text" class="form-control @error('cpfNo') is-invalid @enderror" name="cpfNo" value="{{ old('cpfNo') }}" required  autofocus> -->
                        <input id="cpfNo" type="text" class="form-control @error('cpfNo') is-invalid @enderror" name="cpfNo" value="11008872" required  autofocus>
                        @error('cpfNo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <label>{{ __('Password') }}</label>
                    <div class="mb-3">
                    <!-- <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"> -->
                      <input id="password" value="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">{{ __('Remember Me') }}</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">{{ __('Login') }}</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">

                @if (Route::has('password.request'))
                    <!-- <p class="mb-4 text-sm mx-auto">
                        Don't have an account?
                        <a href="javascript:;" class="text-info text-gradient font-weight-bold">{{ __('Sign up') }}</a>
                        /
                        <a class="text-info text-gradient font-weight-bold" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    </p> -->
                @endif
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
