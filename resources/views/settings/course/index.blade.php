
@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
<div class="card search-wrapper mb-2">
  <div class="card-body">
      <form action="{{ url('settings/course') }}" method="GET">
          <div class="row mb-3">
              <div class="col-sm-10 col-md-6 mb-3 mb-md-0 px-1">
                  <select name="dept" class="form-select">
                      <option value="">Select Department</option>
                      @foreach($departments as $department)
                      <option value="{{ $department['id'] }}" {{ request()->has('dept') && (request('dept') == $department->id) ? 'selected' : '' }}> {{ $department['name'] }} </option>
                      @endforeach
                  </select>
              </div>
              <div class="col-sm-2 col-md-2 px-1">
                  <button type="submit" class="btn btn-primary w-100">Filter</button>
              </div>
          </div>
      </form>
  </div>
</div>
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">List of Courses</h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
            <a href="{{request()->has('dept') ? url('settings/course/create?dept=' . request('dept')) : url('settings/course/create')}}" style="color: white">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            </a>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>Department</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($courses as $course)
                <tr>
                    {{-- <td><span class="fw-medium">{{ $course['id'] }} </span> </td> --}}
                    <td>{{ $course->department->name }}</td>
                    <td>{{ $course['code'] }}</td>
                    <td>{{ $course['name'] }}</td>
                    <td>{{ $course['created_at'] }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('settings/course/update/'.$course['id'])}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                            <a class="dropdown-item" href="{{url('settings/major/'.$course['id'])}}"><i class="fas fa-file me-1"></i> View Majors</a>
                            <a class="dropdown-item" href="{{url('settings/course/delete/'.$course['id'])}}"><i class="fas fa-ban"></i> Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination',  ['data' => $courses])
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