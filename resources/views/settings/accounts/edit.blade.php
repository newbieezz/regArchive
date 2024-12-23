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
                    <label class="form-label" for="role">Role</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="role" name="role" id="role">
                        @foreach($roles as $rl)
                        <option value="{{ $rl->code }}" {{ old('code', $user->role == $rl->code) ? 'selected' : '' }}>{{ $rl->value }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-email">Select Department</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="department" name="department_id" id="department_id">
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" 
                            {{ (old('department_id', optional($user->department_id)->id) == $dept->id) ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                    @error('department_id')
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
</div>
  <!-- Content wrapper -->
@endsection