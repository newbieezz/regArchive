@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Document Uploads / <a href="{{url('settings/documents/records/')}}">Back</a></h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <strong>Error: </strong> {{ Session::get('error_message')}}
                      <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
            </div>

            <div class="card-body">
              <p id="register-success"></p>
              <form action="{{url('documents/upload/'.$studentId)}}" method="post" enctype="multipart/form-data"> @csrf
                <div class="row">
                    @foreach(getDocumentCategories() as $category)
                    <div class="card mb-4 p-4" >
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <h4>{{$category->type}}</h4>
                                <input class="form-control" type="file" id="fileInput{{$loop->index}}" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" name="file[{{$category->id}}][]" multiple>
                                @error('file')
                                    <p class="text-danger m-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-12 file-preview d-flex flex-wrap align-content-start gap-2 mt-4" id="previewContainer{{$loop->index}}">
                                <!-- Preview Images will appear here -->
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="mx-2" href="{{url('settings/department/')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
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

@section('scripts')
<script>
    // Function to handle file input change
    function handleFileSelect(input, previewContainer) {
        previewContainer.innerHTML = ''; // Clear previous previews
        if (input.files) {
            // Loop through each selected file
            for (let i = 0; i < input.files.length; i++) {
                let reader = new FileReader();
                // Read the file as a data URL
                reader.readAsDataURL(input.files[i]);
                // When the file is loaded, display its preview
                reader.onload = function (e) {
                    // Create a div for each file preview
                    let previewDiv = document.createElement('div');
                    previewDiv.className = 'file-preview-item'; // Add a class to the div
                    if (input.files[i].type.startsWith('image')) {
                        // If it's an image file, create an img element
                        let preview = document.createElement('img');
                        preview.src = e.target.result;
                        previewDiv.appendChild(preview);
                    } else if (input.files[i].type === 'application/pdf') {
                        // If it's a PDF file, create a canvas element to render the pages
                        let canvas = document.createElement('canvas');
                        canvas.className = 'pdf-preview-canvas'; // Add class to canvas
                        // Set up PDF.js to render the PDF
                        pdfjsLib.getDocument(e.target.result).promise.then(function(pdf) {
                            pdf.getPage(1).then(function(page) {
                                let viewport = page.getViewport({ scale: 1 });
                                let context = canvas.getContext('2d');
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;
                                let renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                page.render(renderContext).promise.then(function() {
                                    previewDiv.appendChild(canvas);
                                });
                            });
                        });
                    }
                    // Append the preview div to the preview container
                    previewContainer.appendChild(previewDiv);
                };
            }
        }
    }

    // Listen for changes in file input fields
    @foreach(getDocumentCategories() as $index => $category)
        document.getElementById('fileInput{{$index}}').addEventListener('change', function() {
            handleFileSelect(this, document.getElementById('previewContainer{{$index}}'));
        });
    @endforeach
</script>
@endsection