
@extends('layouts.layout')
@section('content')
  <body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const successMessage = urlParams.get('success_message');
        if (successMessage) {
            alert(decodeURIComponent(successMessage)); // Display the success message
            // Remove the query parameter from the URL without reloading the page
            const url = new URL(window.location);
            url.searchParams.delete('success_message');
            window.history.replaceState(null, '', url);
        }
    });
</script>
<div class="container-xxl flex-grow-1 container-p-y">
  @include('components.filters',  ['url' => url('documents/records')])
  <div class="card">
    <div class="card-body">
      <div class="row mb-2">
        <div class="col-6">
          <h5 class="card-title">
            <a class="text-black" href="{{ url('documents/records?' . request()->getQueryString()) }}">Document Records</a> / 
            <a href="{{ url('documents/records/incomplete?' . request()->getQueryString()) }}">Incomplete</a> / 
            <a href="{{ url('documents/records/complete?' . request()->getQueryString()) }}">Complete</a>
        </div>
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Dept. & Course</th>
            @foreach(getDocumentCategories() as $category)
            <th>{{$category->type}}</th>
            @endforeach
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach ($documentRecords as $record)
          <tr>
            <td><a href="{{url('student/records?student_query='.$record->student_id)}}" >{{ $record->student_id }}</a></td>
            <td>{{ $record->first_name }} {{ $record->last_name }}</td>
            <td>
              <span>{{ $record->enrollments->last()->department->code }}</span> <br/>
              <span>{{ $record->enrollments->last()->course->code }}&nbsp;
                {{ $record->enrollments->last()->section ? $record->enrollments->last()->section->name . ' (' .  $record->enrollments->last()->section->sched . ')' : ''}}</span>
            </td>
            @foreach(getDocumentCategories() as $category)
              <td>
                @if(count($record->documents->where('type', $category->id)) > 0)
                  @foreach ($record->documents->where('type', $category->id) as $document)
                  <a href="{{ $document->url_path ?? asset('storage/' . $document->file_path) }}" target="_blank">
                    {{ $document->file_name }}
                </a><br/>
                  @endforeach
                @else
                N/A
                @endif
              </td>
            @endforeach
            <td>
              <a href="{{url('documents/upload/'.$record->id)}}" >
                <button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-print me-2"></i> Manage</button>
              </a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('components.pagination',  ['data' => $documentRecords])
</div>
</div>
@endsection
