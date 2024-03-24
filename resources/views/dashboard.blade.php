@extends('layouts.layout')
@section('content')

    <body>
        <div class="content-backdrop fade"></div>
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Scan and Save Documents</h5>
                                    <p class="mb-4"> Bulk Upload through Excel .csv file</p>
                                    <a href="javascript:;" class="btn btn-sm btn-outline-primary">Scan</a> &nbsp; <a
                                        href="javascript:;" class="btn btn-sm btn-outline-primary">Bulk Upload</a> </br>

                                </div>
                            </div>
                            <div class="col-sm-5 text-center text-sm-left">
                                <div class="card-body pb-0 px-0 px-md-4">
                                    <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                        alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                        data-app-light-img="illustrations/man-with-laptop-light.png" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md">
                                <h5 class="card-header m-0 me-2 pb-3">Overall Enrollment</h5>
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Select Enrollment Period
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                                <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2019</a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                                <div id="growthChart"></div>
                                <div class="text-center fw-medium pt-3 mb-2">6789 Enrollees</div>

                                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-primary p-2"><i
                                                    class="bx bx-user text-primary"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>2022</small>
                                            <h6 class="mb-0">2305</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-info p-2"><i
                                                    class="bx bx-user text-info"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>2021</small>
                                            <h6 class="mb-0">4484</h6>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                      <div class="row row-bordered g-0">
                          <div class="col-md">
                              <h5 class="card-header m-0 me-2 pb-3">Enrollment By College</h5>
                          </div>

                              <div class="card body">
                                  <div class="card-header align-items-center justify-content-between pb-0">
                                      <ul class="p-0 m-0">
                                        <li class="d-flex mb-4 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">College of Education</h6> </div>
                                            <div class="user-progress"> 1234 </div>
                                          </div>
                                        </li>
                                        <li class="d-flex mb-4 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">College of Technology</h6> </div>
                                            <div class="user-progress"> 1234 </div>
                                          </div>
                                        </li>
                                        <li class="d-flex mb-4 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">College of Engineering</h6> </div>
                                            <div class="user-progress"> 1234 </div>
                                          </div>
                                        </li>
                                        <li class="d-flex mb-4 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">College of Nursing</h6> </div>
                                            <div class="user-progress"> 1234 </div>
                                          </div>
                                        </li>
                                        <li class="d-flex mb-4 pb-1">
                                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2"> <h6 class="mb-0">College of Arts & Sciences</h6> </div>
                                            <div class="user-progress"> 1234 </div>
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
                
                <!--/ Total Revenue -->
                {{-- <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt4"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="d-block mb-1">Payments</span>
                                    <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                                    <small class="text-danger fw-medium"><i class="bx bx-down-arrow-alt"></i>
                                        -14.82%</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt1"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="fw-medium d-block mb-1">Transactions</span>
                                    <h3 class="card-title mb-2">$14,857</h3>
                                    <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i>
                                        +28.14%</small>
                                </div>
                            </div>
                        </div>
                        <!-- </div>
                 <div class="row"> -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                        <div
                                            class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                            <div class="card-title">
                                                <h5 class="text-nowrap mb-2">Profile Report</h5>
                                                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                            </div>
                                            <div class="mt-sm-auto">
                                                <small class="text-success text-nowrap fw-medium"><i
                                                        class="bx bx-chevron-up"></i> 68.2%</small>
                                                <h3 class="mb-0">$84,686k</h3>
                                            </div>
                                        </div>
                                        <div id="profileReportChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
      
        <!-- / Content -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- / Layout wrapper -->
    @endsection

    </html>
