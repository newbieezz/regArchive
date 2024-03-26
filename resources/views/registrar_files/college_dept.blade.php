@extends('layouts.layout')
@section('content')
  <body>
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">College Department</h5>
                          <p class="mb-4"> Document Type</p>
                          <p class="mb-4"> Scan -> Save to Database</p>
                          <p class="mb-4"> Scanned Documents appear in picture</p>
                          <p class="mb-4"> Scanned Documents appear in text</p>
                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">Save</a> </br></br></br></br>
                          <a href="javascript:;" class="btn btn-sm btn-outline-primary">Add Document</a>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <div class="content-backdrop fade"></div>

      <div class="layout-overlay layout-menu-toggle"></div>
    <!-- / Layout wrapper -->

@endsection
</html>
