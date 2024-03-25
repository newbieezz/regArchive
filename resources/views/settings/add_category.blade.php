@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Add Category / <a href="{{url('categories')}}">Back</a></h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success: </strong> {{ Session::get('success_message')}}
                  <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <strong>Error: </strong> {{ Session::get('error_message')}}
                      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
              @if($errors->any())
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <strong>Error: </strong> <?php echo implode('', $errors->all('<div>:message</div>')); ?>
                      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
            </div>

            <div class="card-body">
              <p id="register-success"></p>
              <form action="{{url('add')}}" method="post" id="addAccForm"> @csrf
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Category Name / Document Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" />
                  <p id="add-name"></p>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Category Description</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" />
                    <p id="add-name"></p>
                  </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
  <!-- Content wrapper -->
@endsection