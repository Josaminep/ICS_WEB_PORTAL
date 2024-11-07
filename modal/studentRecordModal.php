<link rel="stylesheet" href="../css/modal.css">
<script src="../js/studentRecordDt.js"></script>

<!-- Modal -->
<div class="modal fade modal-xl" id="studentRecordModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height: 700px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
                <h1 class="modal-title" id="staticBackdropLabel">STUDENT RECORD</h1>
                <button type="button" class="btn-close btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Table -->

                <div class="table-responsive m-2">

                    <table id="studentRecord" class="table table-bordered text-start">
                        <thead style="background-color: var(--gold);">
                            <tr>
                                <th>LRN</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Academic Year</th>
                                <th>Grade Level</th>
                                <th>Section</th>
                                <th>Parent Name</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody" id="dataTable" style="max-height: 400px;">
                            <?php
                            include "../connectDb.php";

                            $query = "SELECT CONCAT(s.first_name, ' ', s.middle_name, ' ', s.last_name) AS full_name,
                                                        s.lrn AS lrn,
                                                        s.sex AS sex,
                                                        s.academic_year AS academic_year,
                                                        gl.grade_level AS grade_level,
                                                        sec.section_name AS section_name,
                                                CONCAT(p.first_name, ' ', p.middle_name, ' ', p.last_name) AS parent_name
                                                
                                                FROM student s
                                                LEFT JOIN section sec ON s.section_id = sec.section_id
                                                LEFT JOIN grade_level gl ON s.grade_level_id = gl.grade_level_id
                                                LEFT JOIN parent p ON s.parent_id = p.parent_id
                                                WHERE s.lrn IS NOT NULL";

                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['lrn']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['full_name']) . "</td>";
                                    echo "<td class='text-capitalize'>" . htmlspecialchars($row['sex']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['academic_year']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['grade_level']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['section_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['parent_name']) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr>
                                        <td class='text-center'></td>
                                        <td></td>
                                        <td></td>
                                        <td class='text-center'>No records found.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>