@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Update Account / <a href="{{url('dashboard')}}">Back</a></h4>

      @if(Session::has('message'))
      <div class="alert alert-danger alert-dismissible" role="alert">
          <strong>Notice: </strong> {{ Session::get('message')}}
          <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
          </button>
      </div>
      @endif
      
      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <strong>Error: </strong> {{ Session::get('error_message')}}
                      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
            </div>

            <div class="card-body">
              <p id="register-success"></p>
              <form action="{{url('update/'.$user->id)}}" method="post"> @csrf
                <div class="row">
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name', $user->first_name) }}"/>
                    @error('first_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"  value="{{ old('last_name', $user->last_name) }}"/>
                    @error('last_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-email">Email</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="text"
                        id="email" name="email"
                        class="form-control"
                        placeholder="email"
                        aria-label="email"
                        aria-describedby="basic-default-email2" 
                        value="{{ old('email',  $user->email) }}"/>
                      <span class="input-group-text" id="basic-default-email2">example@mail.com</span>
                    </div>
                    <div class="form-text m-0">You can use letters, numbers & periods</div>  
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Employee ID</label>
                    <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Employee ID" value="{{ old('employee_id', $user->employee_id) }}"/>
                    @error('employee_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-password">Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" id="password" name="password"  value="{{ old('password') }}"/>
                    </div>
                    <div class="form-text">Must be atleast 8 characters with numbers & symbols.</div>
                    <p id="passwordStrength" class="m-0"></p>
                    @error('password')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-confirm-password">Confirm Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"/>
                    </div>
                    <div class="form-text">Confirm the password.</div>
                    @error('password_confirmation')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="mx-2" href="{{url('/dashboard')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <button id="submitBtn" type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
    <script>
      function isStrongPassword(password) {
          const minLength = 8;
          const hasNumber = /\d/;
          const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;
          
          return password.length >= minLength && hasNumber.test(password) && hasSpecialChar.test(password);
      }
  
      function validatePasswordStrength() {
          const passwordInput = document.getElementById('password');
          const passwordStrengthSpan = document.getElementById('passwordStrength');
          const submitBtn = document.getElementById('submitBtn');

          if (!passwordInput.value) {
            submitBtn.disabled = false;
            passwordStrengthSpan.style.visibility = "hidden";
          }
          else if (isStrongPassword(passwordInput.value)) {
              passwordStrengthSpan.textContent = 'Password is strong.';
              passwordStrengthSpan.style.color = 'green';
              submitBtn.disabled = false;
              passwordStrengthSpan.style.visibility = "visible";
          } else {
              passwordStrengthSpan.textContent = 'Password must be at least 8 characters long, include a number and a special character.';
              passwordStrengthSpan.style.color = 'red';
              submitBtn.disabled = true;
              passwordStrengthSpan.style.visibility = "visible";
          }
      }
      document.getElementById('password').addEventListener('input', function() {
        validatePasswordStrength();
    });
      </script>
</div>
  <!-- Content wrapper -->
@endsection