@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Add Department / <a href="{{url('settings/department/')}}">Back</a></h4>

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
              <form action="{{url('settings/department/store')}}" method="post"> @csrf
                <div class="row">
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Code</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="First Name" value="{{ old('code') }}"/>
                    @error('code')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Department Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"  value="{{ old('name') }}"/>
                    @error('name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="mx-2" href="{{url('settings/department/')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
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