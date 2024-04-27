@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Bulk Upload Enrollee/Student/ <a href="{{url('enrollment')}}">Back</a></h4>

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
              <form action="{{url('enrollment/upload')}}" method="post" id="enrollemnt-form"  enctype="multipart/form-data"> @csrf
                <div class="row"> 
                    <h4>Enrollment Information</h4>
                </div>
                <div class="row">
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">School Year</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="school_year_id" name="school_year_id">
                        @foreach(getSchoolYear() as $sy)
                        <option value="{{ $sy->id }}" {{ old('school_year_id') == $sy->id ? 'selected' : '' }}>{{ $sy->year }}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('school_year_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Semester</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="semester" name="semester">
                        @foreach(config('student.semester'); as $key => $sem)
                        <option value="{{ $key}}" {{ old('semester') == $key ? 'selected' : '' }}>{{ $sem}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('semester')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Department</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="semester" name="department_id" id="department_id">
                        @foreach(getDepartments() as $dept)
                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
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
                    <label class="form-label" for="basic-default-fullname">Course</label>
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
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Year Level</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="year_level" name="year_level">
                        @foreach(config('student.year_level'); as $key => $level)
                        <option value="{{ $key}}" {{ old('year_level') == $key ? 'selected' : '' }}>{{ $level}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('year_level')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Enrollment Status</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="enrollment_status" name="enrollment_status">
                        @foreach(config('student.enrollment_status'); as $key => $status)
                        <option value="{{ $key}}" {{ old('enrollment_status') == $key ? 'selected' : '' }}>{{ $status}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('enrollment_status')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Student Status</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="student_status" name="student_status">
                        @foreach(config('student.student_status'); as $key => $student_status)
                        <option value="{{ $key}}" {{ old('student_status') == $key ? 'selected' : '' }}>{{ $student_status}}</option>
                        @endforeach
                      </select>
                    </div>
                    @error('student_status')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="col-sm-4 mb-2">
                    <label class="form-label" for="basic-default-fullname">Block Section and schedule</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" aria-label="section_id" name="section_id">
                        @foreach(getSections() as $section)
                          <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }} ({{ $section->sched }})</option>
                        @endforeach
                      </select>
                    </div>
                    @error('section_id')
                        <p class="text-danger m-0">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <label for="formFile" class="form-label">Select Excel/CSV File</label>
                        <input class="form-control" type="file" id="formFile" accept=".xlsx, .xls, .csv" name="file" @if(old('file')) value="{{ old('file') }}" @endif>
                        @error('file')
                            <p class="text-danger m-0">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-end mt-3">
                  <a class="mx-2" href="{{url('settings/user/')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <button type="submit" class="btn btn-primary" id="uploadButton">Save</button>
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
                //fetch major
                getMajors()
            })
            .catch(error => console.error('Error fetching courses:', error));

        return selectedCourseId
      }

      function getMajors(){
        var courseId = courseDropdown.value;
          var selectedMajorId = majorDropdown.value; // Get the previously selected course ID
          console.log('selectedMajorId', selectedMajorId)

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
        console.log('load')
        getCourses();
        setTimeout(() => {
          getMajors();
        }, 500);
      }
      //get course events
      getDefaultDropdownData();
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