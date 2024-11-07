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
                                        <p class="lh-base" style="color: black; white-space: pre-wrap;"><?php echo htmlspecialchars($row['announcement_text']); ?></p>
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

            </div>
        </div>
    </div>
</div>