@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Add Document Category / <a href="{{url('settings/requirement/')}}">Back</a></h4>

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
              <form action="{{url('settings/requirement/store')}}" method="post"> @csrf
                <div class="row">
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="required_student">Students Required</label>
                    <ul>
                      @foreach ($studentTypes as $studentType)
                        <li> {{ $studentType['letter_tag'] }} :	{{ $studentType['name'] }} </li>
                      @endforeach
                    </ul>
                    <input type="text" class="form-control" id="required_student" name="required_student" placeholder="Student Required for this Document" value="{{ old('required_student') }}"/>
                    <div class="form-text m-0">You can have combination: "BEF"</div>  
                    @error('required_student')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Document Type/Name</label>
                    <input type="text" class="form-control" id="type" name="type" placeholder="Type" value="{{ old('type') }}"/>
                    @error('type')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                    <div class="mt-4">
                      <label class="form-label" for="basic-default-fullname">Is Restricted</label>
                      <div class="input-group input-group-merge">
                        <select class="form-select" aria-label="restricted" name="restricted" id="restricted">
                          <option value={{0}} >{{ 'FALSE' }}</option>
                          <option value={{1}} >{{ 'TRUE' }}</option>
                        </select>
                      </div>
                    </div>
                  </div>
                 
                  <div class="col-sm-6 mb-4">
                    <label class="form-label" for="basic-default-fullname">Document Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description"  value="{{ old('description') }}"/>
                    @error('description')
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