@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">List of Categories/Requirements for Enrollment</h5>
            <label class="fw-medium" >Students Required Reference</label>
            <ul>
              <li>A: ALL</li>
              <li>B: FIRST YEAR STUDENTS</li>
              <li>C: REGULAR SECOND YEAR & SUBSEQUENT YEARS STUDENT</li>
              <li>D: IRREGULAR / READMITTED / SHIFTEE STUDENTS</li>
              <li>E: CROSS ENROLLES</li>
              <li>F: INTERNATIONAL STUDENTS</li>
              <li>G: TRANSFEREES</li>
              <li>H: MARRIED</li>
            </ul>
          </div>
          <div class="col-6 d-flex justify-content-end">
            <a href="{{url('settings/requirement/create')}}" style="color: white">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            </a>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Req. Student</th>
                    <th>Name</th>
                    <th>Desc.</th>
                    <th>Is Restricted</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($categories as $category)
                <tr>
                    <td><span class="fw-medium">{{ $category['id'] }}</span> </td>
                    <td>{{ $category['required_student'] }}</td>
                    <td>{{ $category['type'] }}</td>
                    <td>{{ $category['description'] }}</td>
                    <td>{{ $category['restricted'] ? 'RESTRICTED' : '-' }}</td>
                    <td>{{ $category['created_at'] }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('settings/requirement/update/'.$category['id'])}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                            <a class="dropdown-item" href="{{url('settings/requirement/delete/'.$category['id'])}}"><i class="fas fa-ban"></i> Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination',  ['data' => $categories])
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