
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Status - ICS Teacher Portal</title>
    <link rel="stylesheet" href="../css/inputGradesModal.css">
    <script src="../js/turnoverModal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.11/sweetalert2.min.js"></script>
    <style>
        /* Basic modal styling */
        .modal-content {
            padding: 20px;
            border-radius: 8px;
            background-color: #f5f7fa;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            font-family: Arial, sans-serif;
        }

        .modal-header {
            text-align: center;
            color: #444;
            border-bottom: 2px solid #ddd;
        }

        .modal-title {
            font-size: 1.5rem;
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
        #statusForm button {
            padding: 8px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            width: 100%;
        }

        #statusForm select:disabled {
            background-color: #e9ecef;
        }

        /* Button styling */
        #statusForm button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        #statusForm button:hover {
            background-color: #0056b3;
        }

        /* Additional info styling */
        #newSectionDiv, #retainedInfo {
            grid-column: span 2;
            margin-top: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
        }

        #retainedInfo p {
            margin: 5px 0;
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

    <div class="modal fade modal-lg" id="turnOverModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="staticBackdropLabel">Turn Over</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="statusForm">
                    <label for="tsectionSelect">Select Section:</label>
                    <select id="tsectionSelect" name="tsection" required>
                        <!-- Sections will be populated here dynamically -->
                    </select>

                    <!-- Select Student Dropdown (Initially disabled) -->
                    <label for="studentSelect">Select Student:</label>
                    <select id="studentSelect" name="student" required disabled>
                        <option value="">Choose a student</option>
                    </select>

                    <!-- Status Dropdown -->
                    <label for="statusSelect">Status:</label>
                    <select id="statusSelect" name="status" required>
                        <option value="">Choose status</option>
                        <option value="passed">Passed</option>
                        <option value="retained">Retained</option>
                        <option value="dropout">Dropout</option>
                    </select>

                    <!-- New Section Selection (Only for 'enrolled' and 'passed') -->
                    <div id="newSectionDiv" style="display: none;">
                        <label for="newSectionSelect">Select New Section:</label>
                        <select id="newSectionSelect" name="new_section">
                            <option value="">Choose a new section</option>
                            <!-- Populate sections from PHP -->
                        </select>
                    </div>

                    <!-- Retained Info -->
                    <div id="retainedInfo" style="display: none; color: #000">
                        <p style="color: #000"><strong>Section:</strong> <span id="currentSection"></span></p>
                        <p style="color: #000"><strong>Year Level:</strong> <span id="currentYearLevel"></span></p>
                    </div>

                    <button type="submit">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        console.log("Document is ready");

        $.ajax({
            url: '../modal/querys/t_modal.php',  // Make sure this path is correct
            type: 'GET',
            data: { action: 'getSections' },  // Request action for fetching sections
            success: function(data) {
                console.log("Sections data received:", data);

                if (data.success) {
                    console.log("Sections received:", data.data);

                    // Ensure the #tsectionSelect dropdown exists and is being populated
                    $('#tsectionSelect').empty();  // Clear any previous options
                    $('#tsectionSelect').append(new Option("Choose a section", ""));  // Add default option

                    // Populate section dropdown with available sections
                    data.data.forEach(function(section) {
                        console.log("Adding section to dropdown:", section);
                        $('#tsectionSelect').append(new Option(section, section));
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
        $('#statusForm').submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        const studentId = $('#studentSelect').val();
        const status = $('#statusSelect').val();
        const section = $('#tsectionSelect').val();
        const newSection = $('#newSectionSelect').val(); // Only required for 'enrolled' or 'passed'

        // Check if required fields are selected
        if (!studentId || !status || !section) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Please fill in all required fields.',
            });
            return;
        }

        // Prepare data for submission
        const postData = {
            action: 'updateStatus',
            student: studentId,
            status: status,
            tsection: section,
            new_section: (status === 'enrolled' || status === 'passed') ? newSection : ''
        };
        console.log(postData)
        // Send the request to update the status
        $.ajax({
            url: '../modal/querys/t_modal.php',
            type: 'POST',
            data: postData,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                    });
                    // Optionally, clear the form or reset fields
                    $('#statusForm')[0].reset();
                    $('#studentSelect').prop('disabled', true); // Disable student dropdown again
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: response.message,
                    });
                }
            },
            error: function(err) {
                console.error('Error updating student status:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while updating the student status.',
                });
            }
        });
    });

    $.ajax({
        url: '../modal/querys/t_modal.php',  // Make sure the path is correct
        type: 'GET',
        data: { action: 'getAllSections' },  // Fetch all sections
        success: function(data) {
            if (data.success) {
                // Populate the newSectionSelect dropdown with sections
                $('#newSectionSelect').empty();  // Clear existing options
                $('#newSectionSelect').append(new Option("Choose a new section", ""));  // Default option

                // Add each section to the dropdown
                data.data.forEach(function(section) {
                    $('#newSectionSelect').append(new Option(section, section));
                });
                console.log('New sections populated successfully.');
            } else {
                console.error('Error:', data.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: data.message,
                });
            }
        },
        error: function(err) {
            console.error('Error fetching all sections:', err);
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An error occurred while fetching sections.',
            });
        }
    });

    $('#statusSelect').change(function() {
        const selectedStatus = $(this).val();
        if (selectedStatus === 'enrolled' || selectedStatus === 'passed') {
            $('#newSectionDiv').show();
            $('#retainedInfo').hide();
        } else if (selectedStatus === 'retained') {
            $('#newSectionDiv').show();
            $('#retainedInfo').show();
            // Fetch and populate the current section and year level
            $.ajax({
                url: '../modal/querys/t_modal.php',
                type: 'GET',
                data: {
                    action: 'getRetainedInfo',
                    student: $('#studentSelect').val()
                },
                success: function(data) {
                    if (data.success) {
                        $('#currentSection').text(data.data.section);
                        $('#currentYearLevel').text(data.data.year_level);

                        // Fetch sections with the same grade level
                        $.ajax({
                            url: '../modal/querys/t_modal.php',
                            type: 'GET',
                            data: {
                                action: 'getSectionsWithSameGradeLevel',
                                grade_level: data.data.year_level
                            },
                            success: function(sectionData) {
                                if (sectionData.success) {
                                    // Clear and populate the newSectionSelect dropdown
                                    $('#newSectionSelect').empty();
                                    $('#newSectionSelect').append(new Option("Choose a new section", ""));
                                    sectionData.data.forEach(function(section) {
                                        $('#newSectionSelect').append(new Option(section, section));
                                    });
                                } else {
                                    console.error('Error fetching sections:', sectionData.message);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: sectionData.message,
                                    });
                                }
                            },
                            error: function(err) {
                                console.error('Error fetching sections:', err);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'An error occurred while fetching sections.',
                                });
                            }
                        });
                    } else {
                        console.error('Error:', data.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.message,
                        });
                    }
                },
                error: function(err) {
                    console.error('Error fetching retained info:', err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while fetching retained information.',
                    });
                }
            });
        } else {
            $('#newSectionDiv').hide();
            $('#retainedInfo').hide();
        }
    });
        // Handle section change event to load students
        $('#tsectionSelect').change(function() {
            const selectedSection = $(this).val();  // Get the selected section
            console.log("Selected section:", selectedSection);

            // Empty and disable student dropdown until a section is selected
            $('#studentSelect').empty().append(new Option("Choose a student", ""));
            $('#studentSelect').prop('disabled', true);  // Disable until we have student data

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
                                $('#studentSelect').append(new Option(student.name, student.id));
                            });
                            $('#studentSelect').prop('disabled', false);  // Enable student dropdown after populating
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