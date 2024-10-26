@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
@include('components.transaction_filter',  ['url' => url('documents/trash')])
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title">Recently Deleted Files/Documents</h5>
          </div>
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                  <th>Type</th>
                  <th>Files</th>
                  <th>Student Id</th>
                  <th>Date Deleted</th>
                  <th>Deleted By</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($trashRecords as $trash)
              <tr>
              <td>{{ $trash->category->type }}</td>
              <td>
                  @foreach ($trash->files as $document)
                    <a href="{{ asset('storage/'. $document->file_path) }}" target="{{ asset('storage/'. $document->file_path) }}">{{$document->file_name}}</a><br/>
                  @endforeach
              </td>
              <td><a href="{{url('student/records?student_query='.$trash->student_id)}}" >{{ $trash->student_id }}</a></td>
              <td>{{ $trash->deleted_at }}</td>
              <td>
                {{ $trash->deletedByUser->first_name ?? 'EXPIRED' }} &nbsp; 
                {{ $trash->deletedByUser->last_name ?? '' }}
            </td>
              <td>
                  <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ url('documents/trash/restore?ids='.$trash->files->pluck('id')) }}"><i class="bx bx-edit-alt me-1"></i> Restore</a>
                          <a class="dropdown-item" href="{{ url('documents/trash/delete?ids='.$trash->files->pluck('id')) }}"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                      </div>
                  </div>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      @include('components.pagination',  ['data' => $trashRecords])
    </div> 
</div>
@endsection