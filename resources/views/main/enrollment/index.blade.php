
@extends('layouts.layout')
@section('content')
  <body>
<div class="container-xxl flex-grow-1 container-p-y">
  @if(Session::has('success_message'))
    <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success: </strong> {{ Session::get('success_message')}}
        <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
    </div>
  @endif
  @include('components.filters',  ['url' => url('enrollment')])
  <div class="card">
    <div class="card-body">
      <div class="row mb-2">
        <div class="col-6">
          <h5 class="card-title">
            <a class="text-black" href="{{ url('enrollment?' . request()->getQueryString()) }}">All Records</a> / 
            <a href="{{ url('enrollment/incomplete?' . request()->getQueryString()) }}">Incomplete</a> / 
            <a href="{{ url('enrollment/complete?' . request()->getQueryString()) }}">Complete</a>
          </h5>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <a href="{{url('enrollment/export')}}" style="color: white">
            <button type="button" class="btn btn-outline-secondary btn-sm mx-2" ><i class="fas fa-download mx-2"></i> Export List</button>
          </a>
          <a href="{{url('enrollment/create')}}" style="color: white">
            <button type="button" class="btn btn-outline-secondary btn-large mx-2" ><i class="fas fa-plus mx-2"></i> Add New</button>
          </a>
          <a href="{{url('enrollment/import')}}" style="color: white">
            <button type="button" class="btn btn-outline-secondary btn-large mx-2"><i class="fas fa-upload mx-2"></i> Bulk Upload</button>
          </a>
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
          <th>Section</th>
          <th>Course</th>
          <th>Major</th>
          <th>Documents</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
      @foreach ($enrollments as $enrollment)
        <tr>
          <td>{{ $enrollment->id }}</td>
          <td><a href="{{url('student/records?student_query='.$enrollment->student->student_id)}}" >{{ $enrollment->student->student_id }}</a></td>
          <td>{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</td>
          <td>{{ $enrollment->schoolYear->year }}  </td>
          <td>{{ Config::get('student.semester')[$enrollment->semester] }} </td>
          <td>{{ $enrollment->department->code }}  </td>
          <td>{{ $enrollment->section ? $enrollment->section->name . ' (' .  $enrollment->section->sched . ')' : ''}}</td>
          <td>{{ $enrollment->course->code }}  </td>
          <td> {{ $enrollment->major ? $enrollment->major->name : 'N/A' }}  </td>
          <td> 
            @php $documentStatus = $enrollment->student->document_status; @endphp

            @if($documentStatus['is_complete'])
                {{ $documentStatus['status'] }}
            @else

            <div class="dropdown pe-2 d-flex">
              {{ $documentStatus['status'] }}
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <span class="badge rounded-pill bg-danger file-badge">
                {{ $documentStatus['lacking']['count'] }}
              </span>
              <div class="dropdown-menu">
                  @foreach ($documentStatus['lacking']['documents'] as $doc)
                    <a class="dropdown-item"><i class="fas fa-file"></i> No {{$doc}}</a>
                  @endforeach
                  <div class="text-center">
                    <a class="dropdown-item" href="{{url('documents/upload/'.$enrollment->student->id)}}" >
                      <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-print me-2"></i> Scan Documents</button>
                    </a>
                  </div>
              </div>
            </div>
            @endif
          </td>
          <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{url('/enrollment/update/'.$enrollment->id)}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                    <a class="dropdown-item" href="{{url('student/show/'.$enrollment->student->id)}}" ><i class="fas fa-file"></i> View Student</a>
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
