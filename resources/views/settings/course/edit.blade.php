@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Update Course / <a href="{{url('settings/course/')}}">Back</a></h4>

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
              <form action="{{url('settings/course/update/'.$course->id)}}" method="post"> @csrf
                <div class="row">
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Code</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="First Name" 
                        @if(!empty($course['code'])) value="{{ $course['code'] }}" 
                        @else value="{{ old('code') }}" @endif>
                    @error('code')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Course Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                        @if(!empty($course['name'])) value="{{ $course['name'] }}" 
                        @else value="{{ old('name') }}" @endif>
                    @error('name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label for="nameLarge" class="form-label">Program / Course</label> <br>
                    <select name="department_id" id="department_id" class="form-control" style="color: black">
                        <option value="">Select</option>
                        @foreach($getDepartment as $department)
                        <option value="{{ $department['id'] }}"@if(!empty($course['department_id']) && $course['department_id']==$course['id'])
                        selected="" @endif> {{ $department['name'] }} </option>
                        @endforeach
                    </select>
                    @error('department')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="mx-2" href="{{url('settings/course/')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
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