@extends('layouts.layout')
@section('content')
  <body>
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Small table -->

<div class="card">
  <h5 class="card-header">Categories/Requirements for Enrollment</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>Student ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Program</th>
          <th>Student Status</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td>1180802  </td>
          <td>Lugo  </td>
          <td>Mj  </td>
          <td> Lopez </td>
          <td> BSIT </td>
          <td><span class="badge bg-label-primary me-1">Continuing </span></td>
          
        </tr>
        <tr>
          <td>1142122  </td>
          <td>Veloso  </td>
          <td>Cherry Ann  </td>
          <td> Imortal </td>
          <td> BSIT </td>
          <td><span class="badge bg-label-primary me-1">Returnee </span></td>
         
          
        </tr>
        <tr>
          <td>1187541 </td>
          <td>Gonzalez  </td>
          <td>Kim  </td>
          <td> Kimberlat </td>
          <td> BSIT </td>
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
