
@extends('layouts.layout')
@section('content')
  <body>
<div class="container-xxl flex-grow-1 container-p-y">
  @include('components.filters')
  <div class="card">
    <div class="card-body">
      <div class="row mb-2">
        <div class="col-6">
          <h5 class="card-title">Student Enrollment Records</h5>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <button type="button" class="btn btn-outline-secondary btn-sm btn-sm mx-2" ><i class="fas fa-download mx-2"></i> Export List</button>
          <button type="button" class="btn btn-outline-secondary btn-sm mx-2" data-bs-toggle="modal"data-bs-target="#newModal">
            <i class="fas fa-plus mx-2"></i> Add New</button>
          <button type="button" class="btn btn-outline-secondary btn-sm"><i class="fas fa-upload mx-2"></i> Bulk Upload</button>
        </div>
      </div>

  <!-- Add New Enrollment Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">Add New Enrollee/Student Information</h5>
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
              <input type="name" id="nameLarge" class="form-control" placeholder="School attended" />
            </div>
            <div class="col mb-0">
              <label for="nameLarge" class="form-label">Year Graduated</label>
              <input type="name" id="nameLarge" class="form-control" placeholder="Year Graduated" />
            </div>
            <div class="col mb-0">
              <label for="nameLarge" class="form-label">Senior High School</label>
              <input type="name" id="nameLarge" class="form-control" placeholder="School attended" />
            </div>
            <div class="col mb-0">
              <label for="nameLarge" class="form-label">Year Graduated</label>
              <input type="name" id="nameLarge" class="form-control" placeholder="Year Graduated/Last Attended"/>
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
          <button type="button" class="btn btn-primary">Sumbit</button>
        </div>
      </div>
    </div>
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
  <!-- Scan Lacking Documents Modal -->
  <div class="modal fade" id="scanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel3">Scan Document</h5>
          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="nameLarge" class="form-label">Document Type</label> <br>
              <div class="btn-group">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"data-bs-toggle="dropdown" data-bs-auto-close="outside"
                  aria-expanded="false">
                  Choose Document
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                  <li><a class="dropdown-item" href="javascript:void(0)">Form 137</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0)">Grades</a></li>
                  <li><a class="dropdown-item" href="javascript:void(0)">Diploma</a></li>
                </ul>
              </div>
            </div>
            <div class="col mb-0">
              <label for="nameLarge" class="form-label">Scan</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Sumbit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Enrollment TABLE -->
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Program</th>
          <th>Student Status</th>
          <th>Document Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td>1180802  </td>
          <td>Lugo  </td>
          <td>Mj  </td>
          <td> BSIT </td>
          <td> New Enrollee </td>
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
          <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" data-bs-toggle="modal"data-bs-target="#updateModal"><i class="bx bx-edit-alt me-1"></i> Update</a>
                    <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
            </div>
          </td>
          
        </tr>
       
      </tbody>
    </table>
  </div>
</div> </div> 
</div>
@endsection
</html>
