@extends('layouts.layout')
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    @include('components.graduating_filters')
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">Graduating Applicants / 
              <a href="">Incomplete / </a>
              <a href="">Complete</a></h5>
            </h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
            <button type="button" class="btn btn-outline-secondary btn-sm btn-sm mx-2" ><i class="fas fa-download mx-2"></i> Export List</button>
            <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            <button type="button" class="btn btn-outline-secondary btn-sm"><i class="fas fa-upload mx-2"></i> Bulk Upload</button>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Course</th>
                <th>Requirements</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <tr>
                <td>1180802  </td>
                <td>Lugo  </td>
                <td>Mj </td>
                <td> BSIT </td>
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
              </tr>
              <tr>
                <td>1142122  </td>
                <td>Veloso  </td>
                <td>Cherry Ann  </td>
                <td> BSIT </td>
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
              </tr>
              <tr>
                <td>1187541 </td>
                <td>Gonzalez  </td>
                <td>Kim  </td>
                <td> BSIT </td>
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
              </tr>
            
            </tbody>
          </table>
        </div>
      </div>
      <!-- Pagination here -->
    </div> 
  </div> 
@endsection
