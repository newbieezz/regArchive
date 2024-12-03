
@extends('layouts.layout')
@section('content')
  <body>
<div class="container-xxl flex-grow-1 container-p-y">
  @include('components.transaction_filter',  ['url' => url('documents/transactions')])
  <div class="card">
    <div class="card-body">
      <div class="row mb-2">
        <div class="col-8"><h5 class="card-title">Transaction Records</h5></div>
          <div class="col-4">
            <a href="{{url('documents/bulkDownload')}}" style="color: white" class="float-end">
              <button type="button" class="btn btn-outline-secondary btn-large mx-2"><i class="fas fa-download mx-2"></i> Bulk Download</button>
            </a>  
          </div>
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            {{-- <th>ID</th> --}}
            <th>Document Type</th>
            <th>File Name</th>
            <th>Student ID</th>
            <th>EXPIRATION</th>
            <th>Uploaded At</th>
            <th>Uploaded By</th>
            <th>Deleted By</th>
            <th>Deleted At</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach ($transactions as $document)
          <tr>
            {{-- <td>{{ $document->id }}</td> --}}
            <td>{{ $document->category->type }}</td>

            <td><a href="{{ isset($document->url_path) && $document->url_path ? $document->url_path : asset('storage/' . $document->file_path) }}" 
              target="_blank">
               {{ $document->file_name }}
           </a></td>

            <td><a href="{{url('student/records?student_query='.$document->student_id)}}" >{{ $document->student_id }}</a></td>
            <td>{{ $document->expiration ? $document->expiration  : 'PERMANENT' }}</td>
            <td>{{ $document->created_at }}</td>
            <td>{{ $document->addedByUser ? $document->addedByUser->first_name . ' ' . $document->addedByUser->last_name : '-' }}</td>
            <td>{{ $document->deletedByUser ? $document->deletedByUser->first_name . ' ' . $document->deletedByUser->last_name : '-' }}</td>
            <td>{{ $document->deleted_at ? $document->deleted_at : '-' }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('components.pagination',  ['data' => $transactions])
</div>
</div>
@endsection
