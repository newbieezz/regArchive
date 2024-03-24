@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Add Account</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0"></h5>
              {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
              <form>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Full Name</label>
                  <input type="text" class="form-control" id="basic-default-fullname" placeholder="Full Name" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Email</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="text"
                      id="basic-default-email"
                      class="form-control"
                      placeholder="email"
                      aria-label="email"
                      aria-describedby="basic-default-email2" />
                    <span class="input-group-text" id="basic-default-email2">@example.com</span>
                  </div>
                  <div class="form-text">You can use letters, numbers & periods</div>
                </div>
                <div class="mb-3 row">
                    <label class="form-label" for="basic-default-password">Password</label>
                    <div class="input-group input-group-merge">
                      <input class="form-control" type="password" value="password" id="html5-password-input" />
                    </div>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
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