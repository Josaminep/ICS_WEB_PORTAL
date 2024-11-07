<link rel="stylesheet" href="../css/modal.css">
<script src="../js/gradeLevel.js"></script>
<script src="../js/getId.js"></script>
<script src="../js/enrollAlert.js"></script>
<script src="../js/pendingDt.js"></script>

<div class="modal fade modal-xl" id="enrollmentModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 700px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">ENROLLMENT</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs mx-3" id="enrollmentTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="enrollment-tab" data-bs-toggle="tab" data-bs-target="#enrollment" type="button" role="tab" aria-controls="enrollment" aria-selected="true">Enrollment</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">Pending</button>
                    </li>
                </ul>

                <div class="tab-content" id="enrollmentTabContent">
                    <!-- Enrollment Tab -->
                    <div class="tab-pane fade show active overflow-y-scroll" id="enrollment" role="tabpanel" aria-labelledby="enrollment-tab" style="height: 500px;">
                        <div class="form-container">
                            <!-- Your existing form starts here -->
                            <div class="form-container m-3">
                                <form id="enrollmentForm" action="../function/processEnrollment.php" method="POST" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="firstName" class="form-label">Student's First Name</label>
                                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                                        </div>
                                        <div class="col">
                                            <label for="middleName" class="form-label">Student's Middle Name</label>
                                            <input type="text" class="form-control" id="middleName" name="middle_name">
                                        </div>
                                        <div class="col">
                                            <label for="lastName" class="form-label">Student's Last Name</label>
                                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="sex" class="form-label">Sex</label>
                                        <select class="form-select" id="sex" name="sex" required>
                                            <option selected disabled>Select</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="dateOfBirth" class="form-label">Birth Date</label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="date_of_birth" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="parentFirstName" class="form-label">Parent's First Name</label>
                                            <input type="text" class="form-control" id="parentFirstName" name="parent_first_name" required>
                                        </div>
                                        <div class="col">
                                            <label for="parentMiddleName" class="form-label">Parent's Middle Name</label>
                                            <input type="text" class="form-control" id="parentMiddleName" name="parent_middle_name">
                                        </div>
                                        <div class="col">
                                            <label for="parentLastName" class="form-label">Parent's Last Name</label>
                                            <input type="text" class="form-control" id="parentLastName" name="parent_last_name" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="parentEmail" class="form-label">Parent's Email</label>
                                        <input type="email" class="form-control" id="parentEmail" name="parent_email" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="parentContact" class="form-label">Parent's Contact Number</label>
                                        <input type="tel" class="form-control" id="parentContact" name="parent_contact" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="civilStatus" class="form-label">Civil Status</label>
                                        <select class="form-select" id="civilStatus" name="civil_status" required>
                                            <option selected disabled>Select</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="widowed">Widowed</option>
                                            <option value="separated">Separated</option>
                                        </select>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="gradeLevel" class="form-label">Grade Level</label>
                                            <select class="form-select" id="gradeLevel" name="grade_level" required>
                                                <option selected disabled>Select</option>
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="section" class="form-label">Section</label>
                                            <select class="form-select" id="section" name="section" required>
                                                <option selected disabled>Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="studentPicture" class="form-label">Student's Picture</label>
                                        <input class="form-control" type="file" id="studentPicture" name="student_picture" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="psaBirthCertificate" class="form-label">PSA - Birth Certificate</label>
                                        <input class="form-control" type="file" id="psaBirthCertificate" name="psa_birth_certificate" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="progressReportCard" class="form-label">Progress Report Card</label>
                                        <input class="form-control" type="file" id="progressReportCard" name="progress_report_card" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="medicalAssessment" class="form-label">Medical Assessment</label>
                                        <input class="form-control" type="file" id="medicalAssessment" name="medical_assessment" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Enroll</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Tab -->
                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-responsive m-2">

                            <table id="pendingTable" class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Grade Level</th>
                                        <th>Section</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody" id="dataTable" style="max-height: 400px;">
                                    <?php
                                    include "../connectDb.php";

                                    // Initialize query with base SQL
                                    $query = "SELECT CONCAT(s.first_name, ' ', s.middle_name, ' ', s.last_name) AS full_name,
                                                        gl.grade_level AS grade_level,
                                                        sec.section_name AS section_name,
                                                        s.student_id AS student_id_lrn
                                                FROM student s
                                                LEFT JOIN section sec ON s.section_id = sec.section_id
                                                LEFT JOIN grade_level gl ON sec.grade_level_id = gl.grade_level_id
                                                WHERE s.lrn IS NULL";

                                    $result = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td> <?php htmlspecialchars($row['full_name']) ?> </td>
                                                <td> <?php htmlspecialchars($row['grade_level']) ?> </td>
                                                <td> <?php htmlspecialchars($row['section_name']) ?> </td>
                                                <td>
                                                    <button class="btn btn-primary add-lrn-btn"
                                                        data-bs-toggle="collapse"
                                                        href="#collapseExample"
                                                        role="button"
                                                        aria-expanded="false"
                                                        aria-controls="collapseExample"
                                                        onclick="setStudentId(<?php $row['student_id_lrn'] ?>)">
                                                        Add LRN
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-end" style="width: 120px;">No records found.</td>
                                            <td></td>
                                            <td></td>
                                        </tr> <?php
                                            }
                                                ?>

                                </tbody>
                            </table>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body position-absolute top-50 start-50 translate-middle" style="width: 400px;">
                                    <form action="../function/addStudentAccount.php" method="POST" enctype="multipart/form-data">
                                        <div class="col">
                                            <label for="studentLrn" class="form-label">LRN</label>
                                            <input type="number" class="form-control" id="studentLrn" name="student_lrn"
                                                pattern="^\d{12}$"
                                                required title="LRN must be exactly 12 digits"
                                                maxlength="12"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                        </div>
                                        <div class="col">
                                            <label for="studentPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" required minlength="8" title="Password must be at least 8 characters long">
                                        </div>
                                        <div class="col">
                                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                                        </div>
                                        <input type="hidden" id="student_id_lrn" name="student_id_lrn" value="">
                                        <div class="col mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>