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
                    <!-- Form inside modal -->
                    <form id="statusForm">
                        <!-- Section Selection -->
                        <label for="sectionSelect">Select Section:</label>
                        <select id="sectionSelect" name="section" required>
                            <option value="">Choose a section</option>
                            <!-- Populate with section options from server -->
                        </select>

                        <!-- Student Selection (populated based on selected section) -->
                        <label for="studentSelect">Select Student:</label>
                        <select id="studentSelect" name="student" required disabled>
                            <option value="">Choose a student</option>
                            <!-- Dynamically populated based on section selection -->
                        </select>

                        <!-- Status Selection -->
                        <label for="statusSelect">Status:</label>
                        <select id="statusSelect" name="status" required>
                            <option value="">Choose status</option>
                            <option value="enrolled">Enrolled</option>
                            <option value="passed">Passed</option>
                            <option value="retained">Retained</option>
                            <option value="dropout">Dropout</option>
                        </select>

                        <!-- New Section Selection (only for 'enrolled' and 'passed') -->
                        <div id="newSectionDiv" style="display: none;">
                            <label for="newSectionSelect">Select New Section:</label>
                            <select id="newSectionSelect" name="new_section">
                                <option value="">Choose a new section</option>
                                <!-- Populate with section options as needed -->
                            </select>
                        </div>

                        <!-- Display section and year level (only for 'retained') -->
                        <div id="retainedInfo" style="display: none;">
                            <p><strong>Section:</strong> <span id="currentSection"></span></p>
                            <p><strong>Year Level:</strong> <span id="currentYearLevel"></span></p>
                        </div>

                        <button type="submit">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for demonstration (in real scenario, fetch from server)
        const sections = {
            "Section A": ["Student 1", "Student 2"],
            "Section B": ["Student 3", "Student 4"],
        };

        // Populate sections in sectionSelect dropdown
        $(document).ready(function() {
            $.each(sections, function(section, students) {
                $('#sectionSelect').append(new Option(section, section));
            });

            // Update student list based on section selection
            $('#sectionSelect').change(function() {
                const selectedSection = $(this).val();
                $('#studentSelect').empty().append(new Option("Choose a student", ""));
                
                if (selectedSection) {
                    $('#studentSelect').prop('disabled', false);
                    sections[selectedSection].forEach(student => {
                        $('#studentSelect').append(new Option(student, student));
                    });
                } else {
                    $('#studentSelect').prop('disabled', true);
                }
            });

            // Show or hide fields based on status selection
            $('#statusSelect').change(function() {
                const selectedStatus = $(this).val();

                if (selectedStatus === 'enrolled' || selectedStatus === 'passed') {
                    $('#newSectionDiv').show();
                    $('#retainedInfo').hide();
                } else if (selectedStatus === 'retained') {
                    $('#newSectionDiv').hide();
                    $('#retainedInfo').show();

                    // Set section and year level for retained status
                    $('#currentSection').text($('#sectionSelect').val());
                    $('#currentYearLevel').text('Year 3'); // Replace with dynamic value if available
                } else {
                    $('#newSectionDiv').hide();
                    $('#retainedInfo').hide();
                }
            });
        });
    </script>
</body>

</html>