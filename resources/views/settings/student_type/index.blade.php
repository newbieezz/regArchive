@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
{{-- Add Student Type Reference --}}
<div class="card search-warpper mb-2">
    <div class="card-body">
    <form action="{{url('settings/studentType/store')}}" method="post"> @csrf
      <div class="row mb-3">
        <label>Add Student Required/Type Reference </label>
        <div class="col-sm-12 col-md-3 mb-2 mb-md-0 px-1">
          <input type="text" class="form-control" id="letter_tag" name="letter_tag" placeholder="Enter letter tag" value="{{ old('letter_tag') }}">
        </div>
        <div class="col-sm-12 col-md-3 mb-2 mb-md-0 px-1">
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter name indication" value="{{ old('name') }}">
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
            <h5 class="card-title">All Student Type Rquired Reference
            </h5>
          </div> <br>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table" id="section">
            <thead>
                <tr>
                    {{-- <th>ID</th> --}}
                    <th>Letter Tag</th>
                    <th>Name/Indication</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($studentTypes as $studentType)
                <tr>
                    {{-- <td><span class="fw-medium">{{ $studentType['id'] }}</span> </td> --}}
                    <td>{{ $studentType['letter_tag'] }}</td>
                    <td>{{ $studentType['name'] }}</td>
                    <td>{{ $studentType['created_at'] }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('settings/studentType/update/'.$studentType['id'])}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                            <a class="dropdown-item" href="{{url('settings/studentType/delete/'.$studentType['id'])}}"><i class="fas fa-ban"></i> Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination',  ['data' => $studentTypes])
    </div> 
</div>
@endsection

@push('scripts')
<script>
function closeSuccessMessage() {
    document.getElementById('successMessage').style.display = 'none';
}
</script>
@endpush