@extends('layouts.layoutLogin')

@section('content')

<div class="login-container">

    <div class="login-box animated fadeInDown">
        <!-- <div class="login-logo"></div> -->
        <div class="login-body">

            <img src="{{asset('admin/icon_app.png')}}" alt="Trulli" width="200" height="200" style="display: block; margin-bottom :20px; margin-left: auto; margin-right: auto;" >
            <form action="{{ route('login') }}" class="form-horizontal" method="POST">
              @csrf
              <div class="form-group">
                  <label for="email" style="color:#53929F; margin-left: 15px;">{{ __('Email Address') }}</label>
                  <div class="col-md-12">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="Masukan Email"autofocus>

                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group">
                <label for="password"  style="color:#53929F; margin-left: 15px;" >{{ __('Password') }}</label>
                  <div class="col-md-12" >
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"  name="password" required autocomplete="current-password"  placeholder="Masukan Password">

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group">
                <div class="col-md-12 ">
                    <div class="form-check" style="padding-left:0;">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember" style="color:#53929F; margin-left: 15px; font-size: 11px;">
                            Remember Me
                        </label>
                    </div>
                </div>
              </div>

              <div class="form-group">

                  <div class="col-md-12">
                      <button type="submit" class="btn btn-info btn-block" style="color:#fffff;">
                        {{ __('Masuk') }}
                      </button>
                  </div>
                  <div class="col-md-12">
                      @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="btn btn-link btn-block" style="color:#53929F">{{ __('Forgot Your Password?') }}</a>
                      @endif
                  </div>
              </div>

            </form>
        </div>
        <div class="login-footer" style="color:#000000;">
            <div class="pull-center">
                &copy; 2021 {{ config('app.name', 'Laravel') }}
            </div>
            <!-- <div class="pull-right">
                <a href="#">About</a> |
                <a href="#">Privacy</a> |
                <a href="#">Contact Us</a>
            </div> -->
        </div>
    </div>

</div>

@stop

{{--
@extends('layouts.adtheme-auth')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center position-absolute top-50 start-50 translate-middle shadow-lg">
        <!--begin::Wrapper-->
        <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-400px p-10 bg-opacity-50">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-300 w-md-300px">
                <!--begin::Wrapper-->
                <div class="d-flex flex-center flex-column flex-column-fluid">

                    <!--begin::Form-->
                    <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" action="#">

                        <!--begin::Input group--->
                        <div class="fv-row mb-8 fv-plugins-icon-container">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" autocomplete="off"
                                class="form-control bg-transparent">
                            <!--end::Email-->
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        <div class="fv-row mb-8 fv-plugins-icon-container">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" autocomplete="off"
                                class="form-control bg-transparent">
                            <!--end::Email-->
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>


                        <!--begin::Submit button-->
                        <div class="d-grid mb-3 mt-8">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary shadow">Sign In</button>
                        </div>
                        <!--end::Submit button-->

                        <!--begin::Sign up-->
                        <div class="text-white text-center fw-semibold fs-6">
                            <a href="#" class="link-white">Forgot Password ?</a>
                        </div>
                        <!--end::Sign up-->
                    </form>
                    <!--end::Form-->

                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
@endsection --}}
