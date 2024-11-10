<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eCertificate - ICS Parent Portal</title>
    <link rel="stylesheet" href="../css/classScheduleModal.css">
    <!-- Add Bootstrap and Bootstrap Icons if not already included -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="viewEcertModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title" id="staticBackdropLabel">E-CERTIFICATE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cert-card">
                        <!-- Thumbnail Image -->
                        <img src="certificate-thumbnail.jpg" alt="Certificate Thumbnail" class="img-fluid" style="cursor: pointer;" onclick="showPDF()">
                        
                        <div class="cert-card-text">
                            <strong>1st Quarter - Honor Certificate</strong>
                        </div>
                        <div class="cert-card-icon">
                            <a href="path-to-certificate.pdf" download>
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>

                    <!-- PDF Preview -->
                    <iframe id="pdfPreview" src="path-to-certificate.pdf" style="display: none; width: 100%; height: 500px; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Bootstrap JS for modal functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to toggle PDF preview -->
    <script>
        function showPDF() {
            document.getElementById('pdfPreview').style.display = 'block';
        }
    </script>
</body>

</html>
