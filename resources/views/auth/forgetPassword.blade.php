<!DOCTYPE html>
<html lang="en">
<head>
	<title>Registrar Archive</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->	
        {{-- <link rel="icon" type="image/png" href="{{ url('login/images/icons/favicon.ico') }}"/> --}}
        <link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo.png')}}" />
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="{{ url('login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="{{ url('login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ url('login/css/util.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('login/css/main.css') }}">
    <!--===============================================================================================-->
</head>
<body>
	
<div class="limiter">
		<div class="container-login100" style="background-image: url('login/images/admin.png');">
			<div class="wrap-login100 p-t-30 p-b-50">
                
				<span class="login100-form-title p-b-41">	
					Send Email Link
				</span>
  
                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
  
                      <form class="login100-form validate-form p-b-33 p-t-10" action="{{ route('forget.password.post') }}" method="POST">
                          @csrf
                          <div class="wrap-input100 validate-input">
                                  <input type="text" id="email_address" class="input100" placeholder="Enter Email Address" name="email" required >
						          <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                          </div> <br>
                          <div  class="container-login100-form-btn ">
                              <button type="submit" class="btn btn-primary">
                                  Send Password Reset Link
                              </button>
                          </div>
                          <div class="container-login100-form-btn "> <a href="{{url('/')}}">Back</a></div>
                      </form>
                        
                  </div>
              </div>
          </div>
          <div id="dropDownSelect1"></div>
	
    <!--===============================================================================================-->
        <script src="{{ url('login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
        <script src="{{ url('login/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
        <script src="{{ url('login/vendor/bootstrap/js/popper.js') }}"></script>
        <script src="{{ url('login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
        <script src="{{ url('login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
        <script src="{{ url('login/vendor/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ url('login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
        <script src="{{ url('login/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
        <script src="{{ url('login/js/main.js') }}"></script>
    
    </body>
    </html>
