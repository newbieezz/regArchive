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
    <form action="{{url('settings/section/store')}}" method="post"> @csrf
      <div class="row mb-3">
        <label>Add Class Section </label>
        <div class="col-sm-12 col-md-3 mb-2 mb-md-0 px-1">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter section Name" value="{{ old('name') }}">
        </div>
        <div class="col-sm-8 col-md-3 mb-2 mb-md-2 px-1">
          <div class="input-group input-group-merge">
            <select class="form-select" aria-label="sched" name="sched" id="sched">
              <option value="Day" > Day </option>
              <option value="Evening" > Evening </option>
            </select>
          </div>
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
            <h5 class="card-title">All Class Sections / 
                <a href="">Day / </a>
                <a href="">Evening</a></h5>
            </h5>
          </div> <br>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table" id="section">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Section Name</th>
                    <th>Schedule</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($sections as $section)
                <tr>
                    <td><span class="fw-medium">{{ $section['id'] }}</span> </td>
                    <td>{{ $section['name'] }}</td>
                    <td>{{ $section['sched'] }}</td>
                    <td>{{ $section['created_at'] }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('settings/section/update/'.$section['id'])}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                            <a class="dropdown-item" href="{{url('settings/section/delete/'.$section['id'])}}"><i class="fas fa-ban"></i> Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination',  ['data' => $sections])
    </div> 
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true" >
  <form action="javascript:void(0)" id="updateForm" name="updateForm" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" id="id">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Update School Section</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="nameLarge" class="form-label">Section</label>
            <input type="text" id="section" class="form-control" name="section" placeholder="School Section" />
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