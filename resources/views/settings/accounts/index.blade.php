@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">List of Accounts / 
              <a href="">Transactions  </a> </h5>
          </div>
          <div class="col-6 d-flex justify-content-end">
            <a href="{{url('settings/user/create')}}" style="color: white">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            </a>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Scope Access</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($users as $user)
                <tr>
                    <td><span class="fw-medium">{{ $user['first_name'] }} {{ $user['last_name'] }}</span> </td>
                    <td><span class="fw-medium">{{ $user['role'] === 1 ? 'Admin' : 'Staff' }}</span> </td>
                    <td><span class="fw-medium">
                      @foreach ($departments as $dept)
                        @if ($user['department_id'] == $dept['id'])
                          {{$dept['name']}}
                        @elseif ($user['department_id'] == null) 
                          <span></span>
                        @endif
                      @endforeach
                    </span> 
                    </td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['scope'] }}</td>
                    <td><span class="badge {{ $user->status->id == 1 ? 'bg-label-success' : 'bg-label-danger' }} me-1">{{ $user->status->id == 1 ? 'Active' : 'Deactivated'}}</span></td>
                    <td>{{ $user['created_at'] }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                              <a class="dropdown-item" href='{{ $user->status->id == 1 ? url("settings/user/deactivate/$user->id") : url("settings/user/activate/$user->id") }}' >
                              <i class="{{ $user->status->id == 1 ? 'fas fa-ban' : 'fas fa-check'}} me-1"></i>
                              {{ $user->status->id == 1 ? 'Deactivate' : 'Activate' }}
                            </a>
                            <a class="dropdown-item" href="{{url('documents/transactions?user_id='.$user['id'])}}"><i class="fas fa-file"></i> Transactions</a>
                            <a class="dropdown-item" href="{{url('settings/user/update/'.$user['id'])}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination',  ['data' => $users])
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