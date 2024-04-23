
@extends('layouts.layout')
@section('content')
  <body>
<div class="container-xxl flex-grow-1 container-p-y">
  @include('components.filters')
  <div class="card">
    <div class="card-body">
      <div class="row mb-2">
        <div class="col-6">
          <h5 class="card-title">Document Records</h5>
        </div>
        <div class="col-6 d-flex justify-content-end">
          <button type="button" class="btn btn-outline-secondary btn-sm btn-sm mx-2" ><i class="fas fa-download mx-2"></i> Export List</button>
          <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
          <button type="button" class="btn btn-outline-secondary btn-sm"><i class="fas fa-upload mx-2"></i> Bulk Upload</button>
        </div>
      </div>
  <div class="table-responsive text-nowrap">
    <h4>Undecided pa sa UI na ibutang ari na part if foler icons ba then ig click kay table with that particular document type </h4>
    <h4>Or the usual table then sa filter gihapon if ever nay pangitaon na file niya another SCAN and Upload File etc.</h4></h4>
    <table class="table">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>SHS School</th>
          <th>SHS Year Graduated</th>
          <th>Program</th>
          <th>Good Moral</th>
          <th>PSA</th>
          <th>Grades</th>
          <th>Student Status</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td>1180802  </td>
          <td>Lugo  </td>
          <td>Mj  </td>
          <td> SWU </td>
          <td> 2018 </td>
          <td> BSIT </td>
          
          <td><span class="badge bg-label-primary me-1">Recieved (View) </span></td>
          <td> N/A </td>
          <td> N/A </td>
          <td><span class="badge bg-label-primary me-1">Continuing </span></td>
          
        </tr>
        <tr>
          <td>1188520  </td>
          <td>Veloso  </td>
          <td>Cherry Ann  </td>
          <td> UC </td>
          <td> 2016 </td>
          <td> BSIT </td>
          <td> N/A </td>
          <td> N/A </td>
          <td><span class="badge bg-label-primary me-1">Recieved (View) </span></td>
          <td><span class="badge bg-label-primary me-1">Returnee </span></td>
          
          
        </tr>
        <tr>
          <td>NA  </td>
          <td>Gonzalez  </td>
          <td>Kim  </td>
          <td> UV  </td>
          <td> 2015 </td>
          <td> BSIT </td>
          <td><span class="badge bg-label-primary me-1">Recieved (View) </span></td>
          <td><span class="badge bg-label-primary me-1">Recieved (View) </span></td>
          <td><span class="badge bg-label-primary me-1">Recieved (View) </span></td>
          <td><span class="badge bg-label-primary me-1">Shiftee </span></td>
          
        </tr>
       
      </tbody>
    </table>
  </div>
</div>
            <div class="content-backdrop fade"></div>

      <div class="layout-overlay layout-menu-toggle"></div>
    <!-- / Layout wrapper -->

@endsection
</html>
