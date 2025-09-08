<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <title>Image Resizer</title>
    <style>
        .container {
            margin: 10%;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-image"></i> Resize Image</h4>
                    </div>
                    <div class="card-body">

                    <!-- Upload Box -->
                    <div class="border border-2 border-primary rounded-3 p-4 text-center mb-4 bg-light">
                        <input type="file" id="bannerInput" accept="image/*" hidden>
                        <button class="btn btn-primary" onclick="document.getElementById('bannerInput').click()">
                        <i class="bi bi-upload"></i> Browse Files
                        </button>
                        <p class="text-muted mt-2">Supported formats: <strong>JPEG, PNG</strong> | Max <strong>5MB</strong></p>
                    </div>

                    <!-- Image Preview with Cropper -->
                    <div id="previewContainer" class="text-center mb-4" style="display:none;">
                        <img id="previewImage" class="img-fluid rounded border" alt="Preview Image"/>
                        <button class="btn btn-danger btn-sm mt-3" onclick="removeImage()">
                        <i class="bi bi-trash"></i> Remove Image
                        </button>
                    </div>

                    <!-- Resize Fields -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                        <input type="number" id="resizeWidth" class="form-control" placeholder="Resize Width (px)">
                        </div>
                        <div class="col-md-6">
                        <input type="number" id="resizeHeight" class="form-control" placeholder="Resize Height (px)">
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="d-grid">
                        <button class="btn btn-success" onclick="uploadResizedImage()">
                        <i class="bi bi-save"></i> Save
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


<!-- Cropper.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let cropper;
    let selectedFile;

    // When file is chosen
    document.getElementById('bannerInput').addEventListener('change', function(event) {
        selectedFile = event.target.files[0];
        if (selectedFile) {
            let reader = new FileReader();
            reader.onload = function(e) {
                let img = document.getElementById('previewImage');
                img.src = e.target.result;
                document.getElementById('previewContainer').style.display = 'block';

                // Destroy old cropper instance if any
                if (cropper) {
                    cropper.destroy();
                }

                // Create new cropper instance
                cropper = new Cropper(img, {
                    aspectRatio: NaN, // free resizing
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                    crop(event) {
                        document.getElementById('resizeWidth').value = Math.round(event.detail.width);
                        document.getElementById('resizeHeight').value = Math.round(event.detail.height);
                    }
                });
            }
            reader.readAsDataURL(selectedFile);
        }
    });

    // Remove Image
    function removeImage() {
        document.getElementById('previewContainer').style.display = 'none';
        document.getElementById('bannerInput').value = "";
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    // Upload Cropped Image
    function uploadResizedImage() {
        if (!cropper) {
            alert("Please select an image first!");
            return;
        }

        cropper.getCroppedCanvas().toBlob(function(blob) {
            let formData = new FormData();
            formData.append('banner', blob, selectedFile.name);
            formData.append('_token', "{{ csrf_token() }}");

            fetch("{{ route('banner.upload') }}", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);

                // 🔽 Auto download after upload
                let a = document.createElement("a");
                a.href = data.download_url;
                a.download = data.file;
                document.body.appendChild(a);
                a.click();
                a.remove();
            })
            .catch(err => console.error(err));
        }, selectedFile.type);
    }
</script>
</body>
</html>
