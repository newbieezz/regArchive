@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Student Details / <a href="{{url('student/records')}}">Back</a></h4>

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
              <h5>Student Details</h5>
                <div>
                    Full Name: {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                </div>
                <div>
                    Student ID: {{ $student->student_id }}
                </div>
                <div>
                  Department:  {{ $student->enrollments->last()->department->name }}
                </div>
                <div>
                    Course: {{ $student->enrollments->last()->course->name }} ( {{ $student->enrollments->last()->course->code }} )
                </div>
                <div>
                    Year Level: {{ $student->enrollments->last()->year_level }} <br>
                    School Year: {{ $student->enrollments->last()->schoolYear->year }} <br>
                    Section: {{ $student->enrollments->last()->section }} ( {{ $student->enrollments->last()->program }} )<br>
                </div>  <br>
                <div>
                  <h5>Personal Details</h5>
                    Contact Number:  {{ $student->contact_no}}  <br>
                    Email:  {{ $student->email}}  <br>
                    Gender:  {{ $student->gender}}  <br>
                    Religion:  {{ $student->religion}}  <br>
                    Citizenship:  {{ $student->citizenship}}  <br>
                    Civil Status:  {{ $student->civil_status}}  <br>
                    BirthDate:  {{ $student->birthdate}}  <br>
                    Home Address:  {{ $student->home_address}} , {{ $student->city_address}} <br>
                    Birth Address:  {{ $student->birth_address}} <br>
                    Mother's Name:  {{ $student->mothers_name}} , &nbsp; Occupation: {{$student->mothers_occupation}}<br>
                    Father's Name:  {{ $student->fathers_name}} , &nbsp; Occupation: {{$student->fathers_occupation}}<br>
                    Guardian's Name:  {{ $student->guardians_name}} , &nbsp; Contact Number: {{$student->guardian_contact}}<br>
                </div> <br>
                <div>
                  <h5>Educational Background</h5>
                    Primary School:  {{ $student->primary}} , &nbsp; Academic Year: {{$student->primary_sy}} , &nbsp; Honors Received: {{$student->primary_awards}}<br>
                    Secondary School/Jhs:  {{ $student->secondary}} , &nbsp; Academic Year: {{$student->secondary_sy}} , &nbsp; Honors Received: {{$student->secondary_awards}}<br>
                    Senior High School:  {{ $student->senior_high}} , &nbsp; Academic Year: {{$student->senior_high_sy}} , &nbsp; Honors Received: {{$student->senior_high_awards}}<br>
                </div> <br>
                <div>
                  <h5>Documents</h5>
                    Document Name:   , &nbsp; Date Uploaded:  <br>
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