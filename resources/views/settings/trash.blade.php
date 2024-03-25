@extends('layouts.layout')
@section('content')
  <body>
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Small table -->

<div class="card">
  <h5 class="card-header">Recently Deleted Files/Documents</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-light">
      <thead>
        <tr>
          <th>Document ID</th>
          <th>File Name</th>
          <th>Date Deleted</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td>1180802  </td>
          <td>PSA  </td>
          <td>00 00 00 00   </td>
          <td><div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Restore</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                  </div>
              </div> 
            </td>
        </tr>  
      </tbody>
    </table>
  </div>
</div></div>
            <div class="content-backdrop fade"></div>

      <div class="layout-overlay layout-menu-toggle"></div>
    <!-- / Layout wrapper -->

@endsection
</html>
