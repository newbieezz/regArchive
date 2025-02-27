@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Student Details / <a href="{{url('enrollment')}}">Back</a></h4>

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
                <div class="row"> 
                    <h4>Student Information</h4>
                </div>
                <div class="row">
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">School Year</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="school_year_id" name="school_year_id" disabled>
                        @foreach(getSchoolYear() as $sy)
                        <option value="{{ $sy->id }}" {{ (old('school_year_id', $enrollment->school_year_id) == $sy->id) ? 'selected' : '' }} @readonly(true)>{{ $sy->year }}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('school_year_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <!-- <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Semester</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="semester" name="semester" disabled>
                        @foreach(config('student.semester') as $key => $sem)
                        <option value="{{ $key}}" {{ (old('semester', $enrollment->semester) == $key) ? 'selected' : '' }} @readonly(true)>{{ $sem}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('semester')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div> -->
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Department</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="semester" name="department_id" id="department_id" disabled>
                        @foreach(getDepartments() as $dept)
                        <option value="{{ $dept->id }}" {{ (old('department_id', $enrollment->department_id) == $dept->id) ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('department_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Progam/Course</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="course_id" name="course_id" id="course_id" disabled>
                      </select>
                    </div>
                    @error('course_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Major</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="major_id" name="major_id" id="major_id" disabled>
                      </select>
                    </div>
                    @error('major_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <!-- <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Year Level</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="year_level" name="year_level" disabled>
                        @foreach(config('student.year_level') as $key => $level)
                        <option value="{{ $key}}"{{ (old('year_level', $enrollment->year_level) == $key) ? 'selected' : '' }}>{{ $level}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('year_level')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Student Status</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="student_status" name="student_status" disabled>
                        @foreach(config('student.student_status') as $key => $status)
                        <option value="{{ $key}}" {{ (old('student_status', $enrollment->student_status) == $key) ? 'selected' : '' }}>{{ $status}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('student_status')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Block Section</label>
                    <input type="text" class="form-control" id="section" name="section"  readonly placeholder="Enter Block Section" value="{{ old('section', $enrollment->section) }}"/>
                    @error('section')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Program/Sched</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="program" id="programRadio1" value="Day" checked {{ old('program') == 'Day' ? 'checked' : '' }}>
                            <label class="form-check-label" for="programRadio1">Day</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="program" id="programRadio2" value="Evening" {{ old('program') == 'Evening' ? 'checked' : '' }}>
                            <label class="form-check-label" for="programRadio2">Evening </label>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">ID Number</label>
                    <input type="text" class="form-control" id="student_id" name="student_id" readonly  placeholder="Leave blank if none yet" value="{{ old('student_id', $enrollment->student->student_id) }}"/>
                    @error('student_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" readonly placeholder="Enter Last Name" value="{{ old('last_name', $enrollment->student->last_name) }}"/>
                    @error('last_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" readonly placeholder="Enter First Name" value="{{ old('first_name', $enrollment->student->first_name) }}"/>
                    @error('first_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" readonly placeholder="Enter Middle Name" value="{{ old('first_name', $enrollment->student->middle_name) }}"/>
                    @error('first_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 mb-2">
                    <label class="form-label" for="basic-default-fullname">Home Address</label>
                    <input type="text" class="form-control" id="home_address" name="home_address" readonly placeholder="Enter Home Address" value="{{ old('home_address', $enrollment->student->home_address) }}"/>
                    @error('home_address')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-2">
                    <label class="form-label" for="basic-default-fullname">City Address</label>
                    <input type="text" class="form-control" id="city_address" name="city_address" readonly placeholder="Enter City Address" value="{{ old('city_address', $enrollment->student->city_address) }}"/>
                    @error('city_address')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3 mb-2">
                    <label class="form-label" for="basic-default-fullname">Contact No.</label>
                    <input type="text" class="form-control" id="contact_no" name="contact_no" readonly placeholder="Enter Contact Number" value="{{ old('contact_no', $enrollment->student->contact_no) }}"/>
                    @error('contact_no')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-3 mb-2">
                    <label class="form-label" for="basic-default-fullname">Email Address</label>
                    <input type="text" class="form-control" id="email" name="email" readonly placeholder="Enter Email Address" value="{{ old('email', $enrollment->student->email) }}"/>
                    @error('email')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-2 mb-2">
                    <label class="form-label" for="basic-default-fullname">Gender</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderRadio1" value="Male" {{ (old('gender') ?? $enrollment->student->gender) == 'Male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderRadio2" value="Female" {{ (old('gender') ?? $enrollment->student->gender) == 'Female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-3 mb-2">
                    <label class="form-label" for="basic-default-fullname">Birthday</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" readonly placeholder="Enter Birthday" value="{{ old('birthdate',$enrollment->student->birthdate) }}"/>
                    @error('birthdate')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-6 mb-2">
                    <label class="form-label" for="basic-default-fullname">Birth Address</label>
                    <input type="text" class="form-control" id="city_address" name="birth_address" readonly value="{{ old('birth_address',$enrollment->student->birth_address) }}"/>
                    @error('birth_address')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-3 mb-2">
                    <label class="form-label" for="basic-default-fullname">Citizenship</label>
                    <input type="text" class="form-control" id="citizenship" name="citizenship" readonly placeholder="Enter Citizenship" value="{{ old('citizenship',$enrollment->student->citizenship) }}"/>
                    @error('citizenship')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6 mb-2">
                    <label class="form-label" for="basic-default-fullname">Father's Name</label>
                    <input type="text" class="form-control" id="fathers_name" name="fathers_name" readonly placeholder="Enter Father's Name" value="{{ old('fathers_name',$enrollment->student->fathers_name) }}"/>
                    @error('fathers_name')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Occupation</label>
                    <input type="text" class="form-control" id="fathers_occupation" name="fathers_occupation" readonly placeholder="Enter Occupation" value="{{ old('fathers_occupation',$enrollment->student->fathers_occupation) }}"/>
                    @error('fathers_occupation')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label class="form-label" for="basic-default-fullname">Mother's Name</label>
                        <input type="text" class="form-control" id="mothers_name" name="mothers_name" readonly placeholder="Enter Mother's Name" value="{{ old('mothers_name',$enrollment->student->mothers_name) }}"/>
                        @error('mothers_name')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label class="form-label" for="basic-default-fullname">Occupation</label>
                        <input type="text" class="form-control" id="mothers_occupation" name="mothers_occupation" readonly placeholder="Enter Occupation" value="{{ old('mothers_occupation',$enrollment->student->mothers_occupation) }}"/>
                        @error('mothers_occupation')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label class="form-label" for="basic-default-fullname">Guardian's Name</label>
                        <input type="text" class="form-control" id="guardians_name" name="guardians_name" readonly placeholder="Enter Guardian's Name" value="{{ old('guardians_name',$enrollment->student->guardians_name) }}"/>
                        @error('guardians_name')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-2">
                        <label class="form-label" for="basic-default-fullname">Contact Number</label>
                        <input type="text" class="form-control" id="guardian_contact" name="guardian_contact" readonly placeholder="Enter Contact Number" value="{{ old('guardian_contact',$enrollment->student->guardian_contact) }}"/>
                        @error('guardian_contact')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4"> 
                    <h4>Educational Background</h4>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label class="form-label" for="basic-default-fullname">Primary School</label>
                        <input type="text" class="form-control" id="primary" name="primary" readonly placeholder="School Attended" value="{{ old('primary',$enrollment->student->primary) }}"/>
                        @error('primary')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="basic-default-fullname">Academic Year</label>
                        <input type="text" class="form-control" id="primary_sy" name="primary_sy" readonly placeholder="Enter Academic Year" value="{{ old('primary_sy',$enrollment->student->primary_sy) }}"/>
                        @error('primary_sy')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="basic-default-fullname">Honors Received</label>
                        <input type="text" class="form-control" id="primary_awards" name="primary_awards" readonly value="{{ old('primary_awards',$enrollment->student->primary_awards) }}"/>
                        @error('primary_awards')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label class="form-label" for="basic-default-fullname">Secondary School/JHS</label>
                        <input type="text" class="form-control" id="secondary" name="secondary" readonly placeholder="School Attended" value="{{ old('secondary',$enrollment->student->secondary) }}"/>
                        @error('secondary')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="basic-default-fullname">Academic Year</label>
                        <input type="text" class="form-control" id="secondary_sy" name="secondary_sy" readonly placeholder="Enter Academic Year" value="{{ old('secondary_sy',$enrollment->student->secondary_sy) }}"/>
                        @error('secondary_sy')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="basic-default-fullname">Honors Received</label>
                        <input type="text" class="form-control" id="secondary_awards" name="secondary_awards" readonly value="{{ old('secondary_awards',$enrollment->student->secondary_awards) }}"/>
                        @error('secondary_awards')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label class="form-label" for="basic-default-fullname">Senior High School</label>
                        <input type="text" class="form-control" id="senior_high" name="senior_high" readonly placeholder="School Attended" value="{{ old('senior_high',$enrollment->student->senior_high) }}"/>
                        @error('senior_high')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="basic-default-fullname">Academic Year</label>
                        <input type="text" class="form-control" id="senior_high_sy" name="senior_high_sy" readonly placeholder="Enter Academic Year" value="{{ old('senior_high_sy',$enrollment->student->seniior_high_sy) }}"/>
                        @error('senior_high_sy')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="basic-default-fullname">Honors Received</label>
                        <input type="text" class="form-control" id="senior_high_awards" name="senior_high_awards" readonly value="{{ old('senior_high_awards',$enrollment->student->senior_high_awards) }}"/>
                        @error('senior_high_awards')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row mt-4"> 
                    <h4>Documents </h4>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label class="form-label" for="basic-default-fullname">Document Uploaded</label> <br>
                        @php $documentStatus = $enrollment->student->document_status; @endphp
                            {{-- {{ $documentStatus['status'] }} --}}
                                  @foreach ($documentStatus['completed']['documents'] as $doc)
                                    <a class="dropdown-item"><i class="fas fa-file"></i> {{$doc}}</a>
                                  @endforeach
                                  <div class="">
                                    <a class="" href="{{url('documents/upload/'.$enrollment->student->id)}}" > <br>
                                      <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-print me-2"></i> View Documents</button>
                                    </a>
                                  </div>
                        @error('primary')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-3 mb-2">
                        <label class="form-label" for="basic-default-fullname">Lacking/Needs to be Scanned</label>
                        @foreach ($documentStatus['lacking']['documents'] as $doc)
                          <a class="dropdown-item"><i class="fas fa-file"></i> No {{$doc}}</a>
                        @endforeach
                        <div class="">
                          <a class="" href="{{url('documents/upload/'.$enrollment->student->id)}}" > </br>
                            <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-print me-2"></i> Scan Documents</button>
                          </a>
                        </div>
                        @error('primary_sy')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

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
              <div class="row"> 
                <h4>Student Enrollment History</h4>
                
                <div class="table-responsive text-nowrap border">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>School Year</th>
                        <th>Department</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Graduate Studies</th>
                        <th>Required Document</th>
                        <th>Added By (ID | EMAIL)</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                      @if ($enrollmentLogs && $enrollmentLogs->isNotEmpty())
                        @foreach ($enrollmentLogs as $log)
                        <tr>
                          <td>{{ $log->schoolYear->year ?? 'N/A' }}</td>
                          <td>{{ $log->department->name ?? 'N/A' }}</td>
                          <td>{{ $log->course->code ?? 'N/A' }}</td>
                          <td>{{ config('student.student_status')[$log->student_status] ?? 'Unknown Status' }}</td>
                          <td>{{ $log->graduate_studies }}</td>
                          <td>{{ $log->required_document }}</td>
                          <td>{{ $log->addedBy->employee_id ?? 'N/A'}} {{$log->addedBy->email }}</td> <!-- Display added_by (employee_id) -->
                          <td>{{ $log->created_at }}</td>
                      </tr>
                        @endforeach
                  @else
                      <tr>
                          <td colspan="8" class="text-center">No enrollment logs available.</td>
                      </tr>
                  @endif
                    </tbody>
                </table>
                </div>
            </div>
            </div>
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
@section('scripts')
<script>
    $( document ).ready(function() {
      var departmentDropdown =  document.getElementById('department_id');
      var courseDropdown = document.getElementById('course_id');
      var majorDropdown = document.getElementById('major_id');

      function getCourses(){
        var departmentId = departmentDropdown.value;
        var selectedCourseId = courseDropdown.value; // Get the previously selected course ID

        // Clear existing options
        courseDropdown.innerHTML = '';

        // Make AJAX request to fetch courses based on selected department
        fetch('/api/courses/' + departmentId)
            .then(response => response.json())
            .then(data => {
                // Populate course dropdown with fetched courses
                data.forEach(course => {
                    var option = document.createElement('option');
                    option.value = course.id;
                    option.text = course.code;
                    courseDropdown.appendChild(option);

                    // Set the previously selected course as selected
                    if (selectedCourseId && course.id == selectedCourseId) {
                        option.selected = true;
                    }
                });

                // Enable the course dropdown
                courseDropdown.disabled = false;
            })
            .catch(error => console.error('Error fetching courses:', error));

        return selectedCourseId
      }

      function getMajors(){
        var courseId = courseDropdown.value;
          var selectedMajorId = majorDropdown.value; // Get the previously selected course ID

          // Clear existing options
          majorDropdown.innerHTML = '';

          // Make AJAX request to fetch courses based on selected department
          fetch('/api/majors/' + courseId)
              .then(response => response.json())
              .then(data => {
                  // Populate course dropdown with fetched courses
                  data.forEach(major => {
                      var option = document.createElement('option');
                      option.value = major.id;
                      option.text = major.name;
                      majorDropdown.appendChild(option);

                      // Set the previously selected course as selected
                      if (selectedMajorId && major.id == selectedMajorId) {
                          option.selected = true;
                      }
                  });

                  // Enable the course dropdown
                  majorDropdown.disabled = false;
              })
              .catch(error => console.error('Error fetching majors:', error));
      }

      function getDefaultDropdownData(){
        getCourses();
        setTimeout(() => {
          getMajors();
        }, 500);
      }
      //get course events
      window.addEventListener("load", getDefaultDropdownData);
      departmentDropdown.addEventListener('change', getCourses);
      //get major events
      courseDropdown.addEventListener('change', getMajors);

      document.getElementById('search-student-btn').addEventListener('click', function(){
        var studentId = document.getElementById('student_id').value;
        if(studentId){
          // Get the form element
          var form = document.getElementById('enrollemnt-form'); 

          // Get all input elements inside the form
          var inputs = form.querySelectorAll('input');

          // Make AJAX request to fetch studet by id
          fetch('/api/student/' + studentId)
            .then(response => response.json())
            .then(data => {
                console.log('data', data)
                inputs.forEach(function(input) {
                  if(input.name in data){
                    if(input.type=="radio"){
                      if (input.value === data[input.name]) {
                          input.checked = true;
                      }
                    }else{
                      input.value = data[input.name]
                    }
                    
                  }
                });
            })
            .catch(error => console.error('Error fetching student:', error));
        }
      })
      
    });
</script>
@endsection