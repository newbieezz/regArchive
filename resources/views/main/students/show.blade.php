@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md">
                                <h5 class="card-header m-0 me-2 pb-3">Student Details  / <a href="{{url('student/records')}}">Back</a></h5>
                            </div>
                            <div class="card body">
                              <div class="card-header m-0 me-2 pb-3">  
                              <label class="form-label"> ID Number : &nbsp;</label> <b> {{ $student->student_id }} </b> <br>
                              <label class="form-label"> Full Name : &nbsp;</label> <b> {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}  </b> <br>
                              <label class="form-label"> Department : &nbsp;</label> <b> {{ $student->enrollments->last()->department->name }}  </b> <br>
                              <label class="form-label"> Course : &nbsp;</label> <b> {{ $student->enrollments->last()->course->name }} ( {{ $student->enrollments->last()->course->code }} )  </b> <br>
                              <label class="form-label"> Year Level : &nbsp;</label> <b> {{  $student->enrollments->last()->year_level }}  </b> <br>
                              <label class="form-label"> School Year : &nbsp;</label> <b> {{  $student->enrollments->last()->schoolYear->year }}  </b> <br>
                              <label class="form-label"> Section : &nbsp;</label> <b> {{ $student->enrollments->last()->section ? $student->enrollments->last()->section->name : '' }} ( {{ $student->enrollments->last()->section ? $student->enrollments->last()->section->sched : '' }} ) </b> <br>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md">
                                <h5 class="card-header m-0 me-2 pb-3">Educational Background</h5>
                            </div>
                            <div class="card body">
                              <div class="card-header m-0 me-2 pb-3">  
                              <label class="form-label"> Primary School : &nbsp;</label> <b> {{ $student->primary}} </b> <br>
                              <label class="form-label"> Academic Year : &nbsp;</label> <b> {{ $student->primary_sy}} </b> &nbsp;&nbsp;
                              <label class="form-label"> Honor Received : &nbsp;</label> <b> {{ $student->primary_awards }} </b> <br>
                              <label class="form-label"> Secondary School : &nbsp;</label> <b> {{ $student->secondary}} </b> <br>
                              <label class="form-label"> Academic Year : &nbsp;</label> <b> {{ $student->secondary_sy}} </b> &nbsp;&nbsp;
                              <label class="form-label"> Honor Received : &nbsp;</label> <b> {{ $student->secondary_awards }} </b> <br>
                              <label class="form-label"> Senior High School : &nbsp;</label> <b> {{ $student->senior_high}} </b> <br>
                              <label class="form-label"> Academic Year : &nbsp;</label> <b> {{ $student->senior_high_sy}} </b> &nbsp;&nbsp;
                              <label class="form-label"> Honor Received : &nbsp;</label> <b> {{ $student->senior_high_awards }} </b> <br>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md">
                                <h5 class="card-header m-0 me-2 pb-3">Personal Details </h5>
                            </div>
                            <div class="card body">
                              <div class="card-header m-0 me-2 pb-3"> 
                              <label class="form-label"> Contact Number : &nbsp;</label> <b> {{ $student->contact_no }} </b> <br>
                              <label class="form-label"> Birthdate : &nbsp;</label> <b> {{ $student->birthdate }} </b> <br>
                              <label class="form-label"> Email: &nbsp;</label> <b> {{ $student->email }} </b> <br>
                              <label class="form-label"> Gender : &nbsp;</label> <b> {{ $student->gender}}  </b> <br>
                              <label class="form-label"> Religion : &nbsp;</label> <b> {{ $student->religion }}  </b> <br>
                              <label class="form-label"> Citizenship : &nbsp;</label> <b> {{  $student->citizenship }}  </b> <br>
                              <label class="form-label"> Civil Status : &nbsp;</label> <b> {{  $student->civil_status }}  </b> <br>
                              <label class="form-label"> Home Address: &nbsp;</label> <b> {{$student->home_address}} , {{ $student->city_address}}</b> <br>
                              <label class="form-label"> Birth Address : &nbsp;</label> <b> {{ $student->birth_address }} </b> <br>
                              <label class="form-label"> Mother's Name : &nbsp;</label> <b> {{ $student->mothers_name}} </b> &nbsp;
                              <label class="form-label"> Occupation : &nbsp;</label> <b> {{ $student->mothers_occupation }} </b> <br>
                              <label class="form-label"> Father's Name : &nbsp;</label> <b> {{ $student->fathers_name }} </b>  &nbsp;
                              <label class="form-label"> Occupation : &nbsp;</label> <b> {{ $student->fathers_occupation }} </b> <br>
                              <label class="form-label"> Guardians Name : &nbsp;</label> <b> {{ $student->guardians_name }} </b> &nbsp;
                              <label class="form-label"> Contact Number : &nbsp;</label> <b> {{ $student->guardian_contact }} </b> <br>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                      <div class="row row-bordered g-0">
                          <div class="col-md">
                              <h5 class="card-header m-0 me-2 pb-3">Document Details</h5>
                          </div>

                              <div class="card body">
                                  <div class="card-header align-items-center justify-content-between pb-0">
                                  <label class="form-label "> Submitted / Scanned &nbsp;</label>
                                      <ul class="p-0 m-0">
                                        <li class="d-flex mb-3 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">Form 137</h6> </div>
                                            <div class="user-progress"> February 3, 2024 </div>
                                          </div>
                                        </li>
                                        <li class="d-flex mb-3 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">PSA Birth</h6> </div>
                                            <div class="user-progress"> February 3, 2024 </div>
                                          </div>
                                        </li>
                                      </ul>
                                  </div>
                              <div class="card-header align-items-center justify-content-between pb-0">
                              <label class="form-label"> Lacking &nbsp;</label>
                                      <ul class="p-0 m-0">
                                        <li class="d-flex mb-4 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">Diploma</h6> </div>
                                            <div class="user-progress"> . . . . . </div>
                                          </div>
                                        </li>
                                      </ul>
                                  </div>
                              </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
</div> 
      
        <!-- / Content -->
  <div class="layout-overlay layout-menu-toggle"></div>
@endsection