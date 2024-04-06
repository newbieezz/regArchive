@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">List of Accounts</h5>
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
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($users as $user)
                <tr>
                    <td><span class="fw-medium">{{ $user['first_name'] }} {{ $user['last_name'] }}</span> </td>
                    <td><span class="fw-medium">{{ $user['role'] === 1 ? 'Admin' : 'Staff' }}</span> </td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['created_at'] }}</td>
                    <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('settings/user/update/'.$user['id'])}}"><i class="bx bx-edit-alt me-1"></i> Update</a>
                            <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                    </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination')
    </div> 
</div>
@endsection