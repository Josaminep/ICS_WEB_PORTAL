<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent E-Certificate List - ICS Teacher Portal</title>
    <link rel="stylesheet" href="../css/inputGradesModal.css">
    <script src="../js/ecertModal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.11/sweetalert2.min.js"></script>
    <style>
        .modal-content {
            padding: 20px;
            border-radius: 8px;
            background-color: #f5f7fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }
        .modal-header {
            text-align: center;
            color: #444;
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
        }
        .modal-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }
        .ecert-list {
            display: grid;
            gap: 20px;
            margin-top: 10px;
        }
        .ecert-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .ecert-item a {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .ecert-item a:hover {
            background-color: #0056b3;
        }
        .ecert-item .error-msg {
            color: #e74c3c;
            font-size: 1rem;
            text-align: center;
        }
        .ecert-item .info {
            font-size: 1rem;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="modal fade modal-lg" id="displayEcert" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">Sent E-Certificate List</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="ecertList" class="ecert-list">
                        <!-- E-certificate list will be dynamically loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $.ajax({
            url: '../modal/querys/getEcerts.php',  // PHP script to fetch all sent e-certificates
            type: 'GET',
            success: function(response) {
                console.log("E-cert data received:", response);

                const ecertList = $('#ecertList');
                ecertList.empty(); // Clear previous items

                // Check if the response is successful and contains data
                if (response.success && response.data.length > 0) {
                    response.data.forEach(function(ecert) {
                        const item = $('<div>', { class: 'ecert-item' });

                        // Log the file path to debug
                        console.log("File Path:", ecert.file_path);

                        // Check if file path exists
                        if (ecert.file_path) {
                            // Prepend the base path for the uploaded files
                            const filePath = '../../uploads/' + ecert.file_path;

                            // Only handle PDF files
                            if (filePath.match(/\.pdf$/i)) {
                                item.append($('<a>', {
                                    href: filePath,  // Use the full path to the file
                                    target: '_blank',
                                    text: 'View PDF E-Certificate'
                                }));
                            } else {
                                item.append($('<a>', {
                                    href: filePath,  // Use the full path to the file
                                    target: '_blank',
                                    text: 'View E-Certificate (Image or PDF)'
                                }));
                            }
                        } else {
                            item.append($('<span>', { class: 'error-msg', text: 'File path not available' }));
                        }

                        // Display student ID
                        const info = $('<div>', { class: 'info' }).text(`Student ID: ${ecert.student_id}`);
                        item.append(info);

                        ecertList.append(item);
                    });
                } else {
                    ecertList.append('<p>No sent e-certificates found.</p>');
                }
            },
            error: function(err) {
                console.error('Error fetching e-certificates:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while fetching the e-certificates.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    </script>
</body>
</html>
