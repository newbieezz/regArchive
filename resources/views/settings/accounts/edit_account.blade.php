@extends('layouts.layout')
@section('content')
    <!-- CSS for Forms-->
    <link rel="stylesheet" href="{{ url('settings/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ url('settings/assets/vendor/css/core.css') }}" class="template-customizer-core-css') }}" />
    <link rel="stylesheet" href="{{ url('settings/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css') }}" />
    <link rel="stylesheet" href="{{ url('settings/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ url('settings/assets/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ url('settings/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ url('settings/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Update Account / <a href="{{url('settings/user/')}}">Back</a></h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success: </strong> {{ Session::get('success_message')}}
                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <strong>Error: </strong> {{ Session::get('error_message')}}
                      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
              @if($errors->any())
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <strong>Error: </strong> <?php echo implode('', $errors->all('<div>:message</div>')); ?>
                      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
            </div>

            <div class="card-body">
              <p id="register-success') }}"></p>
              <form action="{{url('edit')}}" method="post" id="addAccForm"> @csrf
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">First Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Fisrt Name" 
                    @if(!empty($user['first_name'])) value="{{ $user['first_name'] }}" 
                    @else value="{{ old('first_name') }}" @endif/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Last Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Fisrt Name" 
                    @if(!empty($user['last_name'])) value="{{ $user['last_name'] }}" 
                    @else value="{{ old('last_name') }}" @endif/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Email</label>
                  <div class="input-group input-group-merge">
                    <input type="text" id="email" name="email" class="form-control"
                    @if(!empty($user['email'])) value="{{ $user['email'] }}" 
                    @else value="{{ old('email') }}" @endif/>
                  </div>
                  <div class="form-text">You can use letters, numbers & periods</div>  
                  <p id="add-email"></p>
                </div>
                <div class="mb-3 row">
                    <label class="form-label" for="basic-default-password">Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" id="password" name="password"
                        @if(!empty($user['password'])) value="{{ $user['password'] }}" 
                        @else value="{{ old('password') }}" @endif/>/> </div>
                    <div class="form-text">Must be atleast 8 characters with numbers & symbols.</div>  
                  </div>
                  <p id="add-password"></p>
                <button type="submit" class="btn btn-primary">Save changes</button>
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