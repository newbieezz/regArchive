@extends('layouts.layout')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4">Document Uploads / <a href="{{url('enrollment/')}}">Back</a></h4>

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
              <form action="{{url('documents/upload/'.$studentId)}}" method="post" enctype="multipart/form-data" id="documentForm"> @csrf
                <div class="row">
                    @foreach(getDocumentCategories($studentId) as $category)
                    <div class="card mb-4 p-4" >
                        <div class="row">
                            <h4>{{$category->type}}</h4>
                            @if(count($studentData->documents->where('type', $category->id)) > 0)
                            @php
                            $theDocument = $studentData->documents->where('type', $category->id)->first();
                            @endphp
                            <div class="col-md-9">
                                <p class="text-warning">
                                    Note: There are documents already uploaded. Reuploading documents will removed old documents.<br/>
                                          You can restore deleted documents on the trash section.
                                </p>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ url('documents/download/'.$studentId.'_'.$category->id.'_view')}}"  type="button"class="btn btn-info" target="_blank" >View</a>
                                @if (!$category->restricted || ($category->restricted && Auth::guard('web')->user()->role==1))
                                <a href="{{ url('documents/download/'.$studentId.'_'.$category->id.'_download')}}"  type="button"class="btn btn-danger" target="_blank" >Download</a>
                                @endif
                           </div>
                            @endif
                            <div class="col-sm-6 col-md-8">
                                <input class="form-control" type="file" id="fileInput{{$category->id}}" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps" name="file[{{$category->id}}][]" multiple>
                                @error('file')
                                    <p class="text-danger m-0">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-md-1 text-center d-flex align-items-center justify-content-center">
                                <span>OR</span>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <button type="button"class="btn btn-outline-primary" data-toggle="modal" data-target="#scanModal" data-type="{{$category->id}}">Scan Document</button>
                           </div>
                           <div class="col-sm-6 col-md-3 mt-2">
                            <label class="form-label" for="expiration">Expiration</label>
                            <input type="date" name="expiration" id="expiration" class="form-control" value="{{ old('expiration', $theDocument->expiration ?? '') }}">
                            <div class="form-text m-0">You can leave this null for PERMANENT documents</div>      
                        </div>
                            <div class="col-sm-12 file-preview d-flex flex-wrap align-content-start gap-2 mt-4" id="previewContainer{{$category->id}}" data-asset-path="{{ asset('storage/') }}">
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
    <!-- Modal -->
    <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Scan Documents</h5>
                    <button type="button" class="btn btn-sm btn-outline-secondary ml-2" id="scanBtn"><i class="fas fa-print me-2"></i> Scan</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p class="text-warning m-0">
                            Note: Can scan multiple documents and will be merge into pdf on confirm
                        </p>
                    </div>
                    <div class="col-sm-12 file-preview d-flex flex-wrap align-content-start gap-2 mt-4" id="scanPreview"  data-asset-path="{{ asset('storage/') }}">
                        <!-- Preview Images will appear here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" disabled id="scanLoadBtn">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        &nbsp;Scanning...
                    </button>
                    <button type="button" class="btn btn-primary" id="scanConfirmBtn" data-dismiss="modal">Confirm</button>
                </div>
                </div>
            </div>
        </div>
    </div>
  <!-- Content wrapper -->
@endsection

@section('scripts')
<script>
    let scannedFiles = []
    const userId = {!! getLoggedInUser()->id !!};
    // Listen for changes in file input fields
    let oldDocuments = {!! json_encode($studentData->documents) !!};
    @foreach(getDocumentCategories() as $index => $category)
        let oldFiles{{$category->id}} = oldDocuments.filter(docs => docs.type === {!! $category->id !!});
        let fileInput{{$category->id}} = document.getElementById('fileInput{{$category->id}}');
        let previewContainer{{$category->id}} = document.getElementById('previewContainer{{$category->id}}');
        
        if (oldFiles{{$category->id}}.length > 0) {
            displayOldFilePreviews(oldFiles{{$category->id}}, previewContainer{{$category->id}});
        }
        document.getElementById('fileInput{{$category->id}}').addEventListener('change', function() {
            handleFileSelect(this, document.getElementById('previewContainer{{$category->id}}'));
            scannedFiles['{{$category->id}}'] = null
        });
    @endforeach

    function displayOldFilePreviews(oldFiles, previewContainer, clearOld = false) {
        oldFiles.forEach(function(file) {
            let previewDiv = document.createElement('div');
            previewDiv.className = 'file-preview-item';
            let assetPath = previewContainer.dataset.assetPath + '/' + file.file_path;
            fetch(assetPath)
                .then(response => response.blob())
                .then(blob => {
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
                        const spanElement = document.createElement('span');
                        spanElement.textContent = file.file_name;
                        previewDiv.appendChild(spanElement);
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
                    const spanElement = document.createElement('span');
                    spanElement.textContent = input.files[i].name;
                    previewDiv.appendChild(spanElement);
                    // Append the preview div to the preview container
                    previewContainer.appendChild(previewDiv);
                };
            }
        }
    }

    const loadBtn = $('#scanLoadBtn');
    const confirmBtn = $('#scanConfirmBtn');
    let categoryId = null;
    let studentId = {!! $studentData->id !!}
    
    $('#scanModal').on('hidden.bs.modal	', function (event) {
        setTimeout(() => {
            // After all images are added, save the PDF
            document.getElementById('scanPreview').innerHTML=''
        }, 1000);
    })

    $('#scanModal').on('show.bs.modal', function (event) {
        const buttonElement = $(event.relatedTarget); // Button that triggered the modal
        categoryId =  buttonElement.data('type');
        loadBtn.hide();
    });

    document.getElementById('scanBtn').addEventListener('click', (e) => {
        // Make AJAX request to fetch studet by id
        e.target.disabled = true;
        loadBtn.show();
        confirmBtn.hide();
        fetch(`/api/scan/${studentId}/${categoryId}`, {
                method: 'POST', 
                body: JSON.stringify({
                    userId: userId
                }),
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Convert response to JSON
            })
            .then(data => {
                // Assuming the path is stored in data.path
                let rawPath = data.path;
                // Replace backslashes with forward slashes
                let formattedPath = rawPath.replace(/\\/g, '/');
                            
                let priviewContainer = document.getElementById('scanPreview');
                let newFile = {file_path: formattedPath, file_name: `file_${studentId}_${categoryId}_${Math.random()}.jpg`};
                displayOldFilePreviews([newFile], priviewContainer);
                setTimeout(() => {
                    loadBtn.hide();
                    confirmBtn.show();
                    e.target.disabled = false;
                }, 500);
                
            })
            .catch(error => {
                alert("Scan Error: Please check if printer is connected properly")
                loadBtn.hide();
                confirmBtn.show();
                e.target.disabled = false;
                console.error('Error Scanning:', error)
            });

        
    })

    document.getElementById('scanConfirmBtn').addEventListener('click', (e) => {
        generatePDF(categoryId)
    })

    async function generatePDF(category) {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        const images = document.querySelectorAll('#scanPreview img');
        if(images.length > 0) {
            for (let i = 0; i < images.length; i++) {
                const img = new Image();
                img.src = images[i].src;

                const canvas = document.createElement('canvas');
                
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);

                const canvasDataURL = canvas.toDataURL('image/png');

                if (i > 0) {
                    pdf.addPage();
                }
                const imgWidth = pdf.internal.pageSize.getWidth();
                const imgHeight = pdf.internal.pageSize.getHeight();

                pdf.addImage(canvasDataURL, 'PNG', 0, 0, imgWidth, imgHeight);
            }

            let previewContainer = document.getElementById(`previewContainer${category}`);
            previewContainer.innerHTML = ''; 
            let previewDiv = document.createElement('div');
            previewDiv.className = 'file-preview-item'; // Add a class to the div
            // Set up PDF.js to render the PDF
            previewDiv.appendChild(images[0]);
            const spanElement = document.createElement('span');
            spanElement.textContent = `scan_${Math.random()}.pdf`;
            previewDiv.appendChild(spanElement);
            previewContainer.appendChild(previewDiv);
            
            // Convert the PDF to a Blob
            const pdfBlob = pdf.output('blob');
            if(!scannedFiles[category]){
                scannedFiles[category]=[]
            }
            scannedFiles[category] = pdfBlob

        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('documentForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            
            let formData = new FormData(this); // Get form data
            // Append the Blob to the FormData object
            for (let i = 0; i < scannedFiles.length; i++) {
                const file = scannedFiles[i]
                if(file){
                    formData.append(`file[${i}][1]`, file, `scanned_${Math.random()}.pdf`);
                }
            }
            
            // Send form data via AJAX
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Convert response to JSON
            })
            .then(data => {
                console.log('code', data, data.code)
                if(data.code === 200){
                    window.location.href = `/documents/records?success_message=${encodeURIComponent(data.message)}`;
                }
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                // Handle error, e.g., show error message
            });
        });
    });
</script>
@endsection

