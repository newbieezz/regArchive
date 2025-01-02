@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Add Account / <a href="{{url('settings/user/')}}">Back</a></h4>

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
              <form action="{{url('settings/user/store')}}" method="post"> @csrf
                <div class="row">
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="employee_id">Employee ID</label>
                    <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="Employee ID" value="{{ old('employee_id') }}"/>
                    @error('employee_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}"/>
                    @error('first_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"  value="{{ old('last_name') }}"/>
                    @error('last_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="role">Role</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="role" name="role" id="role">
                        @foreach($roles as $rl)
                        <option value="{{ $rl->code }}" {{ old('role') == $rl->code ? 'selected' : '' }}>{{ $rl->value }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="department_id">Select Department</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="department" name="department_id" id="department_id">
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-text">You can use letters, numbers & periods</div>  
                    @error('department_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group input-group-merge">
                      <input
                        type="text"
                        id="email" name="email"
                        class="form-control"
                        placeholder="email"
                        aria-label="email"
                        aria-describedby="basic-default-email2" 
                        value="{{ old('email') }}"/>
                      <span class="input-group-text" id="basic-default-email2">example@mail.com</span>
                    </div>
                    <div class="form-text m-0">You can use letters, numbers & periods</div>  
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" id="password" name="password" value="{{ old('password') }}" />
                      <button type="button" class="btn btn-info" id="generatePassword">Auto Generate</button>
                      <button type="button" class="btn btn-secondary toggle-password" data-target="password">
                        👁️
                      </button>
                    </div>
                    <div class="form-text">Must be at least 8 characters with numbers & symbols.</div>
                    @error('password')
                      <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" />
                      <button type="button" class="btn btn-warning" id="copyPassword">Copy Password</button>
                      <button type="button" class="btn btn-secondary toggle-password" data-target="password_confirmation">
                        👁️
                      </button>
                    </div>
                    <div class="form-text">Confirm the password.</div>
                    @error('password_confirmation')
                      <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="mx-2" href="{{url('settings/user/')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <button type="submit" class="btn btn-primary">Save</button>
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
      // Generate Random Password Matching the Regex
function generatePassword() {
  const letters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  const digits = "0123456789";
  const specialChars = "@$!%*?&";
  const allChars = letters + digits + specialChars;

  let password = "";
  // Ensure at least one letter, one digit, and one special character
  password += letters[Math.floor(Math.random() * letters.length)];
  password += digits[Math.floor(Math.random() * digits.length)];
  password += specialChars[Math.floor(Math.random() * specialChars.length)];

  // Fill the rest of the password with random characters
  for (let i = 3; i < 8; i++) {
    password += allChars[Math.floor(Math.random() * allChars.length)];
  }

  // Shuffle the password to avoid predictable patterns
  password = password.split('').sort(() => Math.random() - 0.5).join('');
  return password;
}

// Populate Generated Password
document.getElementById('generatePassword').addEventListener('click', () => {
  const password = generatePassword();
  document.getElementById('password').value = password;
  document.getElementById('password_confirmation').value = password;
});

// Copy Password to Clipboard
document.getElementById('copyPassword').addEventListener('click', () => {
  const password = document.getElementById('password').value;
  if (password) {
    navigator.clipboard.writeText(password).then(() => {
      alert('Password copied to clipboard!');
    }).catch(err => {
      console.error('Failed to copy password:', err);
    });
  } else {
    alert('No password to copy. Generate one first!');
  }
});

// Toggle Password Visibility
document.querySelectorAll('.toggle-password').forEach(button => {
  button.addEventListener('click', () => {
    const targetId = button.getAttribute('data-target');
    const input = document.getElementById(targetId);
    if (input.type === 'password') {
      input.type = 'text';
      button.innerText = '🔒';
    } else {
      input.type = 'password';
      button.innerText = '👁️';
    }
  });
});
    </script>
</div>
  <!-- Content wrapper -->
@endsection