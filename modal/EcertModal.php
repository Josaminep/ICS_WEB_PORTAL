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
        #ESstatusForm {
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr 2fr;
            margin-top: 10px;
        }

        #ESstatusForm label {
            font-weight: bold;
            color: #555;
            display: flex;
            align-items: center;
        }

        #ESstatusForm select, 
        #ESstatusForm input, 
        #ESstatusForm button {
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            width: 100%;
        }

        /* Styling for select inputs */
        #ESstatusForm select {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        #ESstatusForm button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            border: none;
            transition: background-color 0.3s;
        }

        #ESstatusForm button:hover {
            background-color: #0056b3;
        }

        /* Styling for file input */
        #EsfileInput {
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
            #ESstatusForm {
                grid-template-columns: 1fr;
            }

            #ESstatusForm label {
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

    <div class="modal fade modal-lg" id="EcertModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">Upload and Send E-Certificate</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form id="ESstatusForm">
                        <!-- Section Selection -->
                        <label for="ecertSectionSelect">Select Section:</label>
                        <select id="ecertSectionSelect" name="section" required>
                            <option value="">Choose a section</option>
                            <!-- Populate with section options from server -->
                        </select>

                        <!-- Student Selection (populated based on selected section) -->
                        <label for="estudentSelect">Select Student:</label>
                        <select id="estudentSelect" name="student" required disabled>
                            <option value="">Choose a student</option>
                            <!-- Dynamically populated based on section selection -->
                        </select>

                        <!-- File Upload -->
                        <label for="EsfileInput">Upload E-Certificate:</label>
                        <input type="file" id="EsfileInput" name="ecert_file" required accept=".pdf, .jpg, .jpeg, .png">

                        <button type="submit">Upload and Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '../modal/querys/t_modal.php',  // Make sure this path is correct
                type: 'GET',
                data: { action: 'getSections' },  // Request action for fetching sections
                success: function(data) {
                    console.log("Sections data received:", data);

                    if (data.success) {
                        console.log("Sections received:", data.data);

                        // Ensure the #ecertSectionSelect dropdown exists and is being populated
                        $('#ecertSectionSelect').empty();  // Clear any previous options
                        $('#ecertSectionSelect').append(new Option("Choose a section", ""));  // Add default option

                        // Populate section dropdown with available sections
                        data.data.forEach(function(section) {
                            console.log("Adding section to dropdown:", section);
                            $('#ecertSectionSelect').append(new Option(section, section));
                        });

                        console.log('Sections populated successfully.');
                    } else {
                        console.error('Error:', data.message);
                        console.log('Error message:', data.message);
                    }
                },
                error: function(err) {
                    console.error('Error fetching sections:', err);
                    console.log('Error details:', err);
                }
            });

            // Handle form submission
            $('#ESstatusForm').submit(function(event) {
                event.preventDefault();

                // Basic form validation
                const formData = new FormData(this);
                
                // Check if file is selected
                const EsfileInput = $('#EsfileInput')[0];
                console.log(EsfileInput)
                if (!EsfileInput.files.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Please upload an e-certificate.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                formData.append('action', 'uploadCert');
                // Send form data to backend (AJAX call)
                $.ajax({
                    url: '../modal/querys/uploadEcert.php',  // PHP script for handling form submission
                    type: 'POST',
                    data: formData,
                    processData: false,  // Don't process the data (needed for FormData)
                    contentType: false,  // Don't set content type
                    success: function(response) {
                        console.log(response); // log the response from the server

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'E-certificate uploaded and sent successfully!',
                                confirmButtonText: 'OK'
                            });
                            // Optionally reset the form after successful submission
                            $('#ESstatusForm')[0].reset();
                            $('#estudentSelect').prop('disabled', true); // Disable student select after submission
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(err) {
                        console.error('AJAX Error:', err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Handle section change event to load students
            $('#ecertSectionSelect').change(function() {
                const selectedSection = $(this).val();  // Get the selected section
                console.log("Selected section:", selectedSection);

                // Empty and disable student dropdown until a section is selected
                $('#estudentSelect').empty().append(new Option("Choose a student", ""));
                $('#estudentSelect').prop('disabled', true);  // Disable until we have student data

                // If a section is selected, fetch students
                if (selectedSection) {
                    console.log("Fetching students for section:", selectedSection);
                    $.ajax({
                        url: '../modal/querys/t_modal.php',  // Make sure this path is correct
                        type: 'GET',
                        data: { 
                            action: 'getStudents',  // Request action to fetch students
                            section: selectedSection  // Pass the selected section
                        },
                        success: function(data) {
                            console.log("Students data received:", data);

                            if (data.success) {
                                data.data.forEach(function(student) {
                                    console.log("Adding student:", student);
                                    $('#estudentSelect').append(new Option(student.name, student.id));
                                });
                                $('#estudentSelect').prop('disabled', false);  // Enable student dropdown after populating
                                console.log('Students populated successfully.');
                            } else {
                                console.error('Error:', data.message);
                                console.log('Error message:', data.message);
                            }
                        },
                        error: function(err) {
                            console.error('Error fetching students:', err);
                            console.log('Error details:', err);
                        }
                    });
                } else {
                    console.log("No section selected, clearing student dropdown.");
                }
            });
        });

    </script>
</body>

</html>
