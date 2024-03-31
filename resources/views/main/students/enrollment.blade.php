
@extends('layouts.layout')
@section('content')
  <body>
            <div class="container-xxl flex-grow-1 container-p-y">

<!-- Small table -->

<div class="card">
  <h5 class="card-header">Enrolment Records</h5>
  <h5 class="card-header">Enrollment Records</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-sm">
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
