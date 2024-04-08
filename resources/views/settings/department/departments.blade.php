@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">Departments</h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2" href="{{}}">
                <i class="fas fa-plus mx-2"></i> Add New</button>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <tr>
                <td>1</td>
                <td>COT</td>
                <td>College of Technology</td>
                <td>2024-02-17 08:10</td>
                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href=""><i class="bx bx-edit-alt me-1"></i> Update</a>
                        <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-1"></i> Delete</a>
                    </div>
                </div>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>CoE</td>
                <td>College of Engineering</td>
                <td>2024-02-17 08:10</td>
                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href=""><i class="bx bx-edit-alt me-1"></i> Update</a>
                        <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-1"></i> Delete</a>
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