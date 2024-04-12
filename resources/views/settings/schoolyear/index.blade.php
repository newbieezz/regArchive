@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
<div class="card search-warpper mb-2">
    <div class="card-body">
    <form action="{{url('settings/schoolyear/store')}}" method="post"> @csrf
      <div class="row mb-3">
        <label>Add School Year</label>
        <div class="col-sm-12 col-md-6 mb-3 mb-md-0 px-1">
          <input type="text" class="form-control" id="year" name="year" placeholder="Enter year" value="{{ old('type') }}">
        </div>
        <div class="col-sm-12 col-md-2 px-1">
          <button type="submit" class="btn btn-primary w-100">Add</button>
        </div>
      </div>
    </form>
    </div>
  </div>
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">School Years</h5>
          </div> <br>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table" id="schoolyear">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Year</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($schoolYear as $year)
                <tr>
                    <td><span class="fw-medium">{{ $year['id'] }}</span> </td>
                    <td>{{ $year['year'] }}</td>
                    <td>{{ $year['created_at'] }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('settings/schoolyear/update/'.$year['id'])}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                            <a class="dropdown-item" href="{{url('settings/schoolyear/delete/'.$year['id'])}}"><i class="fas fa-ban"></i> Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination',  ['data' => $schoolYear])
    </div> 
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true" >
  <form action="javascript:void(0)" id="updateForm" name="updateForm" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" id="id">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Update School Year</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameLarge" class="form-label">Year</label>
            <input type="text" id="year" class="form-control" name="year" placeholder="School Year" />
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
  </form>
</div>
@endsection

@push('scripts')
<script>
function closeSuccessMessage() {
    document.getElementById('successMessage').style.display = 'none';
}
</script>
@endpush