@extends('layouts.layout')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    @include('components.filters',  ['url' => url('student/records')])
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">
              <a class="text-black" href="{{ url('student/records?' . request()->getQueryString()) }}">Student Records</a>
            </h5>
          </div>
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
                <th>Documents</th>
                <!-- <th>Actions</th> -->
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
                  @php $documentStatus = $student->document_status; @endphp

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
                          <a class="dropdown-item" href="{{url('documents/upload/'.$student->id)}}" >
                            <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-print me-2"></i> Scan Documents</button>
                          </a>
                        </div>
                    </div>
                  </div>
                  @endif
                </td>
                <!-- <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{url('student/show/'.$student->id)}}"><i class="fas fa-file"></i> View Details</a>
                        {{-- <a class="dropdown-item" href="javascript:void(0);" ><i class="fas fa-edit"></i> Update </a> --}}
                    </div>
                  </div>
                </td> -->
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- Pagination here -->
      @include('components.pagination',  ['data' => $students])
    </div> 
  </div> 
@endsection
