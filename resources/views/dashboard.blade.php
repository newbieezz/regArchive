<link rel="icon" type="image/x-icon" href="{{asset('assets/img/logo.png')}}" />
@extends('layouts.layout')
@section('content')
    
  <body>
            <div class="content-backdrop fade"></div>
            <!-- Content -->
            
            <div class="container-xxl flex-grow-1 container-p-y">
              @if(Session::has('success_message'))
              <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success: </strong> {{ Session::get('success_message')}}
                <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
              </div>
              @endif
                <div class="row">
                    <!-- Student Reports -->
                    <div class="col-md-12 col-lg-6 col-xl-6 order-0 mb-4">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                          <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Student Reports</h5>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="d-flex justify-content-center align-items-center mb-3">
                            <div id="orderStatisticsChart"></div>
                          </div>
                          <ul class="p-0 m-0">
                            @foreach($reports['studentReport']['departments'] as $department)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                        <h6 class="mb-0">{{$department->name}}</h6>
                                        <small class="text-muted">{{$department->code}}</small>
                                        </div>
                                        <div class="user-progress">
                                        <small class="fw-medium">{{$department->students_count}}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                    <!--/ Student Reports -->
    
                    <!-- Enrollment Reports -->
                    <div class="col-md-12 col-lg-6 order-1 mb-4">
                      <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                          <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Enrollment Reports</h5>
                          </div>
                          <div class="text-center">
                            <div class="dropdown">
                                <button
                                    class="btn btn-sm btn-outline-primary dropdown-toggle"
                                    type="button"
                                    id="syDropdownId"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    All School Year
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                  <a class="dropdown-item sy_options" href="javascript:void(0);" data-id="" data-value="All School Year">All</a>
                                  @foreach(getSchoolYear() as $sy)
                                    <a class="dropdown-item sy_options" href="javascript:void(0);" data-id="{{$sy->id}}" data-value="{{ $sy->year }}">{{ $sy->year }}</a>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="card-body px-0">
                          <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                              <div class="d-flex p-4 pt-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-user"></i></span>
                                </div>
                                <div>
                                  <small class="text-muted d-block">Enrollees</small>
                                  <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1" id="total_enrollee">0</h6>
                                  </div>
                                </div>
                              </div>
                              <div id="incomeChart"></div>
                              <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                  @foreach(config('student.semester') as $key => $sem)
                                  <div class="d-flex">
                                      <div class="me-2">
                                          <span class="badge bg-label-primary p-2"><i
                                                  class="bx bx-user text-primary"></i></span>
                                      </div>
                                      <div class="d-flex flex-column">
                                          <small>{{$sem}}</small>
                                          <h6 class="mb-0 semester-input" id="sem_input_{{$key}}">0</h6>
                                      </div>
                                  </div>
                                  @endforeach
    
                                    </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--/ Enrollment Reports -->
                </div>
                <div class="row">
                    <!-- Document Reports -->
                    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2">
                      <div class="card" style="height:100%;">
                        <div class="row row-bordered">
                          <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-header m-0 me-2">Document Reports</h5>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-end">
                                <div class="text-left">
                                    <div class="dropdown">
                                        <button
                                        class="btn btn-sm btn-outline-primary dropdown-toggle"
                                        type="button"
                                        id="deptDropdownId"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        All Department
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                            <a class="dropdown-item department-input" href="javascript:void(0);" data-id="" data-value="All Department">All</a>
                                          @foreach(getDepartments() as $dept)
                                            <a class="dropdown-item department-input" href="javascript:void(0);" data-id="{{$dept->id}}" data-value="{{ $dept->name }}">{{ $dept->name }}</a>
                                          @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div id="totalRevenueChart" class="px-2"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--/ Document Reports -->
                    <!-- School Reports -->
                    <div class="col-md-12 col-lg-4 order-2">
                      <div class="card h-100"> 
                        <div class="card-header d-flex align-items-center justify-content-between">
                          <h5 class="card-title m-0 me-2">School Reports</h5>
                        </div>
                        <div class="card-body">
                          <h6 class="card-title m-0 me-2 mb-2 text-muted">High School</h6>
                          <ul class="p-0 m-0">
                            @foreach($reports['schoolReports']['highSchool'] as $school)
                            <li class="d-flex mb-4 pb-1">
                              <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                              </div>
                              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                  <h6 class="text-muted d-block mb-1">{{$school->school_name}}</h6>
                                </div>
                                <div class="user-progress d-flex align-items-center gap-1">
                                  <span class="text-muted">{{$school->students_count}}</span>
                                </div>
                              </div>
                            </li>
                            @endforeach
                            <h6 class="card-title m-0 me-2 mb-2 text-muted">Senior High School</h6>
                            <ul class="p-0 m-0">
                                @foreach($reports['schoolReports']['seniorHigh'] as $school)
                                <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                    <h6 class="text-muted d-block mb-1">{{$school->school_name}}</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                    <span class="text-muted">{{$school->students_count}}</span>
                                    </div>
                                </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                      </div>
                    </div>
                    <!--/ School Reports -->
                </div>
            </div>
    
            <!-- / Content -->
            <div class="layout-overlay layout-menu-toggle"></div>
            <!-- / Layout wrapper -->
@endsection
    
  </html>