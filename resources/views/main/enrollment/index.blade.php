
@extends('layouts.layout')
@section('content')
  <body>
<div class="container-xxl flex-grow-1 container-p-y">
  @include('components.filters')
  <div class="card">
    <div class="card-body">
      <div class="row mb-2">
        <div class="col-6">
          <h5 class="card-title">Student Enrollment Records</h5>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <button type="button" class="btn btn-outline-secondary btn-sm mx-2" ><i class="fas fa-download mx-2"></i> Export List</button>
          <a href="{{url('enrollment/create')}}" style="color: white">
            <button type="button" class="btn btn-outline-secondary btn-sm mx-2" ><i class="fas fa-plus mx-2"></i> Add New</button>
          </a>
          <button type="button" class="btn btn-outline-secondary btn-sm"><i class="fas fa-upload mx-2"></i> Bulk Upload</button>
        </div>
      </div>

  <!-- Scan Lacking Documents Modal -->
  <div class="modal fade" id="scanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">Scan Document</h5>
          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="nameLarge" class="form-label">Document Type</label> <br>
              <div class="btn-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                  aria-expanded="false">
                  Choose Document
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                  <li><a class="dropdown-item" href="javascript:void(0)">Form 137</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0)">Grades</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0)">Diploma</a></li>
                </ul>
              </div>
            </div>
            <div class="col mb-0">
              <label for="nameLarge" class="form-label">Scan</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Sumbit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Enrollment TABLE -->
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Student ID</th>
          <th>Student Name</th>
          <th>Shcool Year</th>
          <th>Semester</th>
          <th>Department</th>
          <th>Program</th>
          <th>Major</th>
          <th>Document</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($enrollments as $enrollment)
        <tr>
          <td>{{ $enrollment->id }}</td>
          <td>{{ $enrollment->student->student_id }}</td>
          <td>{{ $enrollment->student->first_name }} {{ $enrollment->student->middle_name }} {{ $enrollment->student->last_name }}</td>
          <td>{{ $enrollment->schoolYear->year }}  </td>
          <td>{{ Config::get('student.semester')[$enrollment->semester] }} </td>
          <td>{{ $enrollment->department->name }}  </td>
          <td>{{ $enrollment->course->code }}  </td>
          <td> {{ $enrollment->major ? $enrollment->major->name : 'N/A' }}  </td>
          <td> 
            <div class="dropdown">Incomplete
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                  <a class="dropdown-item" data-bs-toggle="modal"data-bs-target="#scanModal" ><i class="fas fa-file"></i> No Diploma</a>
                  <a class="dropdown-item" ><i class="fas fa-file"></i> No Form 137</a>
              </div>
            </div>
          </td>
          <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/enrollment/update/'.$enrollment->id)}}"><i class="bx bx-edit-alt me-1"></i> Update Enrollment</a>
                    <a class="dropdown-item" href="{{url('student/'.$enrollment->student->id)}}" ><i class="bx bx-trash me-1"></i> View Student</a>
                </div>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div> 
@include('components.pagination',  ['data' => $enrollments])
</div> 
</div>
@endsection
</html>
