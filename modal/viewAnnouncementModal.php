<script src="../js/getId.js"></script>

<!-- Modal -->
<div class="modal fade modal-xl" id="viewAnnouncementModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="height:850px !important;">
            <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important;">
                <h1 class="modal-title" id="staticBackdropLabel">ANNOUNCEMENT</h1>
                <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="announcement-container overflow-y-scroll" id="announcementContainer" style="height: 680px;">
                    <?php
                    include "../connectDb.php";

                    // Initialize query with base SQL
                    $query = "SELECT * FROM announcements ORDER BY created_at DESC";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="row shadow mx-2 mb-5 rounded-3">
                                <div class="alter position-relative">
                                    <!-- Edit Button -->
                                    <button class="btn btn-primary position-absolute top-0 end-0 border-0 mt-2"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseExample"
                                        aria-controls="collapseExample"
                                        data-announcement-id="<?php echo $row['announcement_id']; ?>"
                                        data-announcement-title="<?php echo htmlspecialchars($row['title'], ENT_QUOTES); ?>"
                                        data-announcement-text="<?php echo htmlspecialchars($row['announcement_text'], ENT_QUOTES); ?>"
                                        onclick="editAnnouncement(this)"
                                        style="background-color: transparent; color: black; margin: 0 40px 0 0;">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button class="btn position-absolute top-0 end-0 m-2 border-0"
                                        style="background-color: transparent; color: black;"
                                        data-announcement-id="<?php echo $row['announcement_id']; ?>"
                                        onclick="deleteAnnouncement(this)">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </div>


                                <div class="col-md-12">
                                    <div class="row align-items-center">
                                        <div class="col-6" style="width: 100px;">
                                            <img src="../img/avatar.jpg" alt="profilePic" style="width: 100px;">
                                        </div>
                                        <div class="col-6">
                                            <strong class="text-uppercase"><?php echo htmlspecialchars($row['full_name']); ?></strong><br>
                                            <span><?php echo htmlspecialchars($row['rank_name']); ?></span><br>
                                            <span class="fst-italic"><?php echo htmlspecialchars($row['created_at']); ?></span>
                                        </div>
                                    </div>
                                    <div class="row px-5 pt-2">
                                        <p class="fw-bold lh-base" style="color: black;"><?php echo htmlspecialchars($row['title']); ?></p>
                                        <p class="lh-base" style="color: black; white-space: pre-wrap;" ><?php echo htmlspecialchars($row['announcement_text']); ?></p>
                                    </div>
                                    <div class="row px-5 pb-4 justify-content-center">
                                        <?php
                                        $file_path = htmlspecialchars($row['announcement_file']);
                                        // Check if the file path is not null and not the empty directory path
                                        if (!is_null($file_path) && $file_path !== '../announcement/') {
                                            if (file_exists($file_path)) {
                                        ?>
                                                <img class="img-fluid img-thumbnail" src="<?php echo htmlspecialchars($row['announcement_file']); ?>" alt="announcementFile" style="width: 400px !important;">
                                            <?php
                                            } else {
                                            ?>
                                                <p>File not found: <?php echo $file_path; ?></p>'
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No announcements available.</p>";
                    }
                    ?>
                </div>

                <!-- Edit Announcement -->
                <div class="fade" id="collapseExample">
                    <div class="card card-body position-absolute top-50 start-50 translate-middle" style="width: 900px; height: 385px;">
                        <h2 class="text-center">EDIT ANNOUNCEMENT</h2>
                        <form action="../function/editAnnouncement.php" method="POST" enctype="multipart/form-data" onsubmit="cleanTextBeforeSubmit()">
                            <input type="hidden" id="editAnnouncementId" name="announcement_id" value="">
                            <div class="mb-3">
                                <input type="text" class="form-control fw-bold" id="editAnnouncementTitle" name="announcement_title" value="">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" id="editAnnouncementText" rows="4" name="announcement_text" style="height: 200px; white-space: pre-wrap;"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseExample">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>