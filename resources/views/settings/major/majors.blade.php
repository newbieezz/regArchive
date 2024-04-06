@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">College of Technology List of Majors</h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2" data-bs-toggle="modal"data-bs-target="#newModal">
                <i class="fas fa-plus mx-2"></i> Add New</button>
          </div>
        </div>
        <!-- Add New Major Modal -->
        <iv class="modal fade" id="newModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Add New Major</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label for="nameLarge" class="form-label">Name</label>
                    <input type="text" id="nameLarge" class="form-control" placeholder="Enter Major Name" />
                  </div>
                </div>
                <div class="row g-2">
                  <div class="col mb-0">
                    <label for="nameLarge" class="form-label">Course Name</label>
                    <input type="name" id="nameLarge" class="form-control" placeholder="Enter Course Code" />
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
        </iv>
        <!-- Update Major Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Update Major</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col mb-3">
                    <label for="nameLarge" class="form-label">Name</label>
                    <input type="text" id="nameLarge" class="form-control" placeholder="Enter Major Name" />
                  </div>
                </div>
                <div class="row g-2">
                  <div class="col mb-0">
                    <label for="nameLarge" class="form-label">Course Name</label>
                    <input type="name" id="nameLarge" class="form-control" placeholder="Enter Course Code" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Close
                </button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                  <th>Course Name</th>
                  <th>Name</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <tr>
                <td>Bachelor of Science in Information and Communication Technology</td>
                <td>Computer Programming</td>
                <td>2024-02-17 08:10</td>
                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" data-bs-toggle="modal"data-bs-target="#updateModal"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-1"></i> Delete</a>
                    </div>
                </div>
                </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination')
    </div> 
</div>
@endsection