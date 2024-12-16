@extends('layouts.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
@if(Session::has('success_message'))
  <div id="successMessage" class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success: </strong> {{ Session::get('success_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('successMessage').style.display = 'none';"></button>
  </div>
@endif
@if(Session::has('error_message'))
  <div id="errorsMessage" class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error: </strong> {{ Session::get('error_message')}}
      <button type="button" class="btn-close" aria-label="Close" onclick="document.getElementById('errorsMessage').style.display = 'none';"></button>
  </div>
@endif
<div class="card search-warpper mb-2">
  <div class="card-body">
  <form action="{{url('settings/backup/upload')}}" method="post"> @csrf
    <div class="row">
      <div class="col-sm-12 col-md-2 px-1">
        <button type="submit" class="btn btn-primary w-100">Backup Data</button>
      </div>
    </div>
  </form>
  </div>
</div>
<div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-6">
            <h5 class="card-title"> </h5>
          </div>
          {{-- <div class="col-6 d-flex justify-content-end">
            <a href="{{url('settings/user/create')}}" style="color: white">
              <button type="button" class="btn btn-outline-secondary btn-sm mx-2"><i class="fas fa-plus mx-2"></i> Add New</button>
            </a>
          </div> --}}
        </div>
        <div class="table-responsive text-nowrap border">
          <table class="table">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Size (Bytes)</th>
                  <th>Last Updated</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @if (!empty($backupFiles) && count($backupFiles) > 0)
    @foreach ($backupFiles as $file)
    <tr>
        <td>{{ $file['name'] }}</td>
        <td>{{ $file['size'] }}</td>
        <td>{{ $file['updated'] }}</td>
        <td>
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ $file['download_url'] }}"><i></i> Download</a>
                    <form action="{{ url('settings/backup/restore') }}" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="firebase_path" value="{{ $file['name'] }}">
                        <button type="submit" class="btn btn-warning btn-sm mx-3">Restore</button>
                    </form>
                </div>
            </div>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="4">No backups found.</td>
    </tr>
@endif
            </tbody>
          </table>
        </div>
      </div>
     {{--  @include('components.pagination',  ['data' => $roles]) --}}
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