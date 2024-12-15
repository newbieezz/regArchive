@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Update Document Category / <a href="{{url('settings/requirement/')}}">Back</a></h4>

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
              <label class="fw-medium" >Students Required Reference</label>
            <ul>
              @foreach ($studentTypes as $studentType)
                <li> {{ $studentType['letter_tag'] }} :	{{ $studentType['name'] }} </li>
              @endforeach
            </ul>
              <form action="{{url('settings/requirement/update/'.$category->id)}}" method="post"> @csrf
                <div class="row">
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="required_student">Student Required</label>
                    <input type="text" class="form-control" id="required_student" name="required_student" placeholder="Student Required for this document."  value="{{ old('type', $category->required_student) }}">
                    @error('required_student')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Document Type/Name</label>
                    <input type="text" class="form-control" id="type" name="type" placeholder="Type"  value="{{ old('type', $category->type) }}">
                    @error('type')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Is Restricted</label>
                      <div class="input-group input-group-merge">
                        <select class="form-select" aria-label="restricted" name="restricted" id="restricted">
                          <option value={{0}} {{ old('restricted', $category->restricted) == 0 ? 'selected' : '' }}>{{ 'FALSE' }}</option>
                          <option value={{1}} {{ old('restricted', $category->restricted) == 1 ? 'selected' : '' }}>{{ 'TRUE' }}</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Document Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{ old('description', $category->description) }}">
                    @error('description')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Expire after this years</label>
                    <input type="number" class="form-control" id="expire_at" name="expire_at" placeholder="0"  value="{{ old('expire_at',  $category->expire_at) }}"/>
                    @error('expire_at')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="mx-2" href="{{url('settings/requirement/')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
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