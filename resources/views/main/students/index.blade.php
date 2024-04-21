@extends('layouts.layout')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    @include('components.filters')
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">Student Records</h5>
          </div>
          {{-- <div class="col-6 d-flex justify-content-end">
            <button type="button" class="btn btn-outline-secondary btn-sm btn-sm mx-2" ><i class="fas fa-download mx-2"></i> Export List</button>
            <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            <button type="button" class="btn btn-outline-secondary btn-sm"><i class="fas fa-upload mx-2"></i> Bulk Upload</button>
          </div> --}}
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Department</th>
                <th>Course</th>
                <th>School Year</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($students as $student)
              <tr>
                <td>{{ $student->student_id }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->first_name }}</td>
                <td> {{ $student->middle_name }} </td>
                <td> {{ $student->enrollments->last()->department->code }}</td>
                <td> {{ $student->enrollments->last()->course->code }} </td>
                <td> {{ $student->enrollments->last()->schoolYear->year }}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"><i class="fas fa-file"></i> View Details</a>
                        {{-- <a class="dropdown-item" href="javascript:void(0);" ><i class="fas fa-edit"></i> Update </a> --}}
                        <a class="dropdown-item" href="javascript:void(0);" ><i class="fas fa-print"></i> Scan Documents</a>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- Pagination here -->
    </div> 
  </div> 
@endsection
