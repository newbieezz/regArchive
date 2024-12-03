@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
<div class="card search-warpper mb-2">
  <div class="card-body">
  <form action="{{url('settings/role/store')}}" method="post"> @csrf
    <div class="row mb-3">
      <label>Add Role</label>
      <div class="col-sm-12 col-md-3 mb-2 mb-md-0 px-1">
        <input type="text" class="form-control" id="value" name="value" placeholder="Enter Role" value="{{ old('value') }}">
      </div>
      <div class="col-sm-12 col-md-3 mb-2 mb-md-0 px-1">
        <input type="text" class="form-control" id="code" name="code" placeholder="Enter Role Code" value="{{ old('code') }}">
      </div>
      <div class="col-sm-12 col-md-2 px-1">
        <button type="submit" class="btn btn-primary w-100">Add</button>
      </div>
    </div>
  </form>
  </div>
</div>
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">List of Roles </h5>
          </div>
          {{-- <div class="col-6 d-flex justify-content-end">
            <a href="{{url('settings/user/create')}}" style="color: white">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            </a>
          </div> --}}
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>CODE</th>
                    <th>Role</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach($roles as $role)
              <tr>
                {{-- <td><span class="fw-medium">{{ $role['id'] }}</span> </td> --}}
                <td><span class="fw-medium">{{ $role['code'] }}</span> </td>
                <td><span class="fw-medium">{{ $role['value'] }}</span> </td>
                <td><span class="fw-medium">{{ $role['created_at'] }}</span> </td>
                <td>
                  <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{url('settings/role/delete/'.$role['id'])}}"><i class="bx bx-trash-alt me-1"></i> Delete</a>
                      </div>
                  </div>
                </td>
              </tr>
          @endforeach
            </tbody>
          </table>
        </div>
      </div>
     {{--  @include('components.pagination',  ['data' => $roles]) --}}
    </div> 
</div>
@endsection

@push('scripts')
<script>
function closeSuccessMessage() {
    document.getElementById('successMessage').style.display = 'none';
}
</script>
@endpush