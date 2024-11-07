<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Status - ICS Teacher Portal</title>
    <link rel="stylesheet" href="../css/inputGradesModal.css">
    <script src="../js/ecertModal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.11/sweetalert2.min.js"></script>
    <style>
        /* Basic modal styling */
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

        /* Form styling */
        #statusForm {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr 2fr;
            margin-top: 10px;
        }

        #statusForm label {
            font-weight: bold;
            color: #555;
            display: flex;
            align-items: center;
        }

        #statusForm select, 
        #statusForm input, 
        #statusForm button {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            width: 100%;
        }

        /* Styling for select inputs */
        #statusForm select {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        #statusForm button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s;
        }

        #statusForm button:hover {
            background-color: #0056b3;
        }

        /* Styling for file input */
        #fileInput {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        /* Section and student div styling */
        #newSectionDiv, #retainedInfo {
            grid-column: span 2;
            margin-top: 15px;
            padding: 10px;
            background-color: #fafafa;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Additional info styling */
        #retainedInfo p {
            margin: 5px 0;
            font-size: 0.95rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #statusForm {
                grid-template-columns: 1fr;
            }

            #statusForm label {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- SweetAlert messages -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $_SESSION['success_message']; ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?php echo $_SESSION['error_message']; ?>',
                    confirmButtonText: 'OK'
                });
            });
        </script>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="modal fade modal-lg" id="archivesModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">Student Archives</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form id="statusForm">
                        <!-- Section Selection -->
                        <label>Section: </label>
                        <br>
                        <label>Grade Level:</label>
                        <br>
                        <label>Student List</label>
                        <th>
                            <td>Name</td>
                        <th>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
