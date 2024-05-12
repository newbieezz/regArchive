@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Document Uploads / <a href="{{url('documents/records/')}}">Back</a></h4>

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
            <!-- Upload Documents -->
            <div class="card-body">
                <h5>Upload Documents</h5>
              <p id="register-success"></p>
              <form action="{{url('documents/upload/'.$studentId)}}" method="post" enctype="multipart/form-data"> @csrf
                <div class="row">
                    @foreach(getDocumentCategories() as $category)
                    <div class="card mb-4 p-4" >
                        <div class="row">
                            <div class="col-sm-12 col-md-8">
                                <h4>{{$category->type}}</h4>
                                @if(count($studentData->documents->where('type', $category->id)) > 0)
                                    <p class="text-warning m-0">
                                        Note: There are documents already uploaded. Reuploading documents will removed old documents.<br/>
                                        You can restore deleted documents on the trash section.
                                    </p>
                                @endif
                                <input class="form-control" type="file" id="fileInput{{$loop->index}}" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" name="file[{{$category->id}}][]" multiple>
                                @error('file')
                                    <p class="text-danger m-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-12 file-preview d-flex flex-wrap align-content-start gap-2 mt-4" id="previewContainer{{$loop->index}}" data-asset-path="{{ asset('storage/') }}">
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

            <!-- Scan Documents-->
            <!-- <div class="card-body">
                <h5>Scan Documents</h5>
              <p id="register-success"></p>
              <form id="form1" action="https://asprise.com/scan/applet/upload.php?action=dump" method="POST" enctype="multipart/form-data" target="_blank" > @csrf
                <div class="row">
                    @foreach(getDocumentCategories() as $category)
                    <div class="card mb-4 p-4" >
                        <div class="row">
                            <div class="col-sm-12 col-md-8">
                                <h4>{{$category->type}}</h4>
                                @if(count($studentData->documents->where('type', $category->id)) > 0)
                                    <p class="text-warning m-0">
                                        Note: There are documents already uploaded. Reuploading documents will removed old documents.<br/>
                                        You can restore deleted documents on the trash section.
                                    </p>
                                @endif
                                <button type="button" class="btn btn-secondary"  onclick="scanToJpg();">Scan</button>
                                @error('file')
                                    <p class="text-danger m-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-12 file-preview d-flex flex-wrap align-content-start gap-2 mt-4" id="previewContainer{{$loop->index}}" data-asset-path="{{ asset('storage/') }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-12 d-flex justify-content-end">
                  <a class="mx-2" href="{{url('settings/department/')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                  <input type="button" value="Submit" onclick="submitFormWithScannedImages();">
                </div>
              </form>

            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
  <!-- Content wrapper -->
@endsection
<script src="{{asset('scannerjs/scanner.js')}}" type="text/javascript"></script>

@section('scripts')
<script>
    // Listen for changes in file input fields
    let oldDocuments = {!! json_encode($studentData->documents) !!};
    @foreach(getDocumentCategories() as $index => $category)
        let oldFiles{{$index}} = oldDocuments.filter(docs => docs.type === {!! $category->id !!});
        let fileInput{{$index}} = document.getElementById('fileInput{{$index}}');
        let previewContainer{{$index}} = document.getElementById('previewContainer{{$index}}');
        
        if (oldFiles{{$index}}.length > 0) {
            displayOldFilePreviews(oldFiles{{$index}}, previewContainer{{$index}});
        }
        document.getElementById('fileInput{{$index}}').addEventListener('change', function() {
            handleFileSelect(this, document.getElementById('previewContainer{{$index}}'));
        });
    @endforeach

    function displayOldFilePreviews(oldFiles, previewContainer) {
        oldFiles.forEach(function(file) {
            let previewDiv = document.createElement('div');
            previewDiv.className = 'file-preview-item';
            let assetPath = previewContainer.dataset.assetPath + '/' + file.file_path;
            console.log('assetPath', assetPath)
            fetch(assetPath)
                .then(response => response.blob())
                .then(blob => {
                    console.log('blob', blob)
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        let fileData = event.target.result;
                        if (blob.type.startsWith('image')) {
                            // If it's an image file, create an img element
                            let preview = document.createElement('img');
                            preview.src = fileData;
                            previewDiv.appendChild(preview);
                        } else if (blob.type === 'application/pdf') {
                            // If it's a PDF file, create a canvas element to render the pages
                            let canvas = document.createElement('canvas');
                            canvas.className = 'pdf-preview-canvas'; // Add class to canvas
                            // Set up PDF.js to render the PDF
                            pdfjsLib.getDocument({data: atob(fileData.split(',')[1])}).promise.then(function(pdf) {
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
                        } else {
                            // For other file types, display a link to download
                            let downloadLink = document.createElement('a');
                            downloadLink.href = file.file_path;
                            downloadLink.textContent = file.file_name;
                            previewDiv.appendChild(downloadLink);
                        }
                        // Append the preview div to the preview container
                        previewContainer.appendChild(previewDiv);
                    };

                    // Read the blob content as a data URL
                    reader.readAsDataURL(blob);
                })
                .catch(error => {
                    console.error('Error fetching file:', error);
                });
        });
    }
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

</script>
@endsection

<!-- Scanner Script -->
@section('scripts')
<script>

        /** Initiates a scan */
        function scanToJpg() {
            scanner.scan(displayImagesOnPage,
                    {
                        "output_settings": [
                            {
                                "type": "return-base64",
                                "format": "jpg"
                            }
                        ]
                    }
            );
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if(!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                console.info('User cancelled');
                return;
            }

            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                processScannedImage(scannedImage);
            }
        }

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            document.getElementById('images').appendChild(elementImg);
        }

        <!-- Previous lines are same as demo-01, below is new addition to demo-02 -->

        /** Upload scanned images by submitting the form */
        function submitFormWithScannedImages() {
            if (scanner.submitFormWithImages('form1', imagesScanned, function (xhr) {
                if (xhr.readyState == 4) { // 4: request finished and response is ready
                    document.getElementById('server_response').innerHTML = "<h2>Response from the server: </h2>" + xhr.responseText;
                    document.getElementById('images').innerHTML = ''; // clear images
                    imagesScanned = [];
                }
            })) {
                document.getElementById('server_response').innerHTML = "Submitting, please stand by ...";
            } else {
                document.getElementById('server_response').innerHTML = "Form submission cancelled. Please scan first.";
            }
        }

    </script>
@endsection

    <style>
        img.scanned {
            height: 200px; /** Sets the display size */
            margin-right: 12px;
        }

        div#images {
            margin-top: 20px;
        }
    </style>


