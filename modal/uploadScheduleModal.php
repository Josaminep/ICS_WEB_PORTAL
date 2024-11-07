<link rel="stylesheet" href="../css/modal.css">
<script src="../js/gradeLevelSchedule.js"></script>

<!-- Modal -->
<div class="modal fade" id="uploadSchedule" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="height: 450px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important;">
                <h1 class="modal-title" id="staticBackdropLabel">UPLOAD SCHEDULE</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-container">
                    <form id="uploadScheduleForm" action="../function/uploadSchedule.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="gradeLevelSchedule" class="form-label">Grade Level</label>
                            <select class="form-select" id="gradeLevelSchedule" name="grade_level" required>
                                <option selected disabled>Select</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sectionSchedule" class="form-label">Section</label>
                            <select class="form-select" id="sectionSchedule" name="section" required>
                                <option selected disabled>Select</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="section" class="form-label">Schedule</label>
                            <input class="form-control" type="file" id="uploadSchedule" name="upload-schedule" accept=".xls, .xlsx" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>