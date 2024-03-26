@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">Recently Deleted Files/Documents</h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
            <a href="{{url('settings/trash/create')}}" style="color: white">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            </a>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                  <th>Document ID</th>
                  <th>Type</th>
                  <th>File Name</th>
                  <th>Date Deleted</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <tr>
                <td>1</td>
                <td>Form 137</td>
                <td>FORM137_112344.pdf</td>
                <td>2024-02-17 08:10</td>
                <td>
                <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-view-alt me-1"></i> View</a>
                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Restore</a>
                        <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-1"></i> Delete</a>
                    </div>
                </div>
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td>NSO</td>
                <td>NSO_112344.pdf</td>
                <td>2024-02-17 08:10</td>
                <td>
                  <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-view-alt me-1"></i> View</a>
                          <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Restore</a>
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