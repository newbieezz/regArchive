@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Update Account  / <a href="{{url('settings/user/')}}">Back</a></h4>

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
              <form action="{{url('settings/user/update/'.$user->id)}}" method="post"> @csrf
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
                    <label class="form-label" for="department_id">Select Department</label>
                    <select class="form-select " id="department_select">
                      <option value="">Choose Department</option>
                      @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" data-name="{{ $dept->name }}">{{ $dept->name }}</option>
                      @endforeach
                    </select>
                    <div class="input-group input-group-merge mt-2">
                      <input 
                        class="form-control" 
                        type="text" 
                        id="department_input" 
                        placeholder="Select or type department" 
                        value="{{ old('department_id', is_array(json_decode($user->department_id)) ? implode(';', json_decode($user->department_id)) : $user->department_id) }}"
                        readonly
                      />
                      <button type="button" class="btn btn-primary" id="addDepartment">Add</button>
                    </div>
                    <div id="department_tags" class="mt-2"></div>
                   
                    <input type="hidden"  name="department_id" id="department_hidden"  value="{{ old('department_id',  $user->department_id) }}" />
                    <div class="form-text">You can select multiple departments. Values will be joined with `;`.</div>
                    @error('department_id')
                      <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="role">Role</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="role" name="role" id="role">
                          @foreach($roles as $rl)
                              <option value="{{ $rl->code }}" 
                                  {{ old('role', $user->role) == $rl->code ? 'selected' : '' }}>
                                  {{ $rl->value }}
                              </option>
                          @endforeach
                      </select>
                  </div>
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
                    <label class="form-label" for="basic-default-password">Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" id="password" name="password"  value="{{ old('password') }}"/>
                    </div>
                    <div class="form-text">Must be atleast 8 characters with numbers & symbols.</div>
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
                <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Select Scope Access</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="scope" id="scope1" value="1" {{ (old('scope') ?? $user->scope) == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">All Department</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="scope" id="scope2" value="2" {{ (old('scope') ?? $user->scope) == '2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Assigned Department</label>
                        </div>
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
     
      document.addEventListener('DOMContentLoaded', () => {
        const departmentSelect = document.getElementById('department_select');
        const departmentInput = document.getElementById('department_input');
        const departmentHidden = document.getElementById('department_hidden');
        const departmentTags = document.getElementById('department_tags');
        const addDepartmentBtn = document.getElementById('addDepartment');
      
        // Parse existing value if updating
        const initialDepartments = departmentInput.value ? departmentInput.value.split(';') : [];
        let selectedDepartments = new Map();
      
        // Populate initial tags from old data
        initialDepartments.forEach(deptId => {
          const option = Array.from(departmentSelect.options).find(opt => opt.value === deptId);
          if (option) {
            selectedDepartments.set(deptId, option.getAttribute('data-name'));
          }
        });
      
        // Render initial tags
        function renderTags() {
          departmentTags.innerHTML = '';
          selectedDepartments.forEach((name, id) => {
            const tag = document.createElement('span');
            tag.className = 'badge bg-primary me-1';
            tag.textContent = name;
            tag.innerHTML += ' <button type="button" class="btn-close btn-sm ms-1" aria-label="Remove"></button>';
            tag.querySelector('.btn-close').addEventListener('click', () => {
              selectedDepartments.delete(id);
              updateInput();
              renderTags();
            });
            departmentTags.appendChild(tag);
          });
          updateInput();
        }
      
        // Update hidden and display input
        function updateInput() {
          const joinedDepartments = Array.from(selectedDepartments.keys()).join(';');
          departmentHidden.value = joinedDepartments;
          departmentInput.value = joinedDepartments;
        }
      
        // Add department from dropdown
        addDepartmentBtn.addEventListener('click', () => {
          const selectedOption = departmentSelect.selectedOptions[0];
          const selectedValue = selectedOption.value;
          const selectedName = selectedOption.getAttribute('data-name');
      
          if (selectedValue && !selectedDepartments.has(selectedValue)) {
            selectedDepartments.set(selectedValue, selectedName);
            renderTags();
          }
        });
      
        // Initialize existing tags on page load
        renderTags();
      });
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