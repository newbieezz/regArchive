@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Update Major / <a href="{{url('settings/major/')}}">Back</a></h4>

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
              <!-- Update Enrollment Modal -->
            <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Update Enrollee/Student Information</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Last Name</label>
                        <input type="text" id="nameLarge" class="form-control" placeholder="Enter Last Name" />
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">First Name</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Enter First Name" />
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Middle Name</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Enter Middle Name" />
                        </div>
                    </div> <br>
                    <div class="row g-2">
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">ID Number</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Put N/A if none yet" />
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Home Address</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Enter Address" />
                        </div>
                    </div> <br>
                    <div class="row g-3">
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Secondary/JHS School</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Put N/A if none yet" />
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Year Graduated</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Enter Address" />
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Senior High School</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Enter Address" />
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Year Graduated</label>
                        <input type="name" id="nameLarge" class="form-control" placeholder="Enter Address" />
                        </div>
                    </div> <br>
                    <div class="row g-4">
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Program / Course</label> <br>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Choose Program
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li><a class="dropdown-item" href="javascript:void(0)">BSIT</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">BSIS</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">BIT</a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Major</label> <br>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Choose Major
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li><a class="dropdown-item" href="javascript:void(0)">Programming</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Graphic Design</a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Year Level</label> <br>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Choose Year Level
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li><a class="dropdown-item" href="javascript:void(0)">1</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">2</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">3</a></li>
                            </ul>
                        </div>
                        </div>
                    </div> <br>
                    <div class="row g-5">
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">School Year</label> <br>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Choose School Year
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li><a class="dropdown-item" href="javascript:void(0)">2023-2024</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">2023</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">2022-2023</a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Semmester</label> <br>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Choose Semmester
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li><a class="dropdown-item" href="javascript:void(0)">1st</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">2nd</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Trimester</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Summer</a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Student Status</label> <br>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Choose Students Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li><a class="dropdown-item" href="javascript:void(0)">New Enrollee</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Returnee</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Shiftee</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Cross Enrollee</a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="col mb-0">
                        <label for="nameLarge" class="form-label">Enrollment Status</label> <br>
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Choose Enrollment Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                            <li><a class="dropdown-item" href="javascript:void(0)">Regular</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0)">Irregular</a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
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