<link rel="stylesheet" href="../css/classScheduleModal.css">

<!-- Modal -->
<div class="modal fade modal-xl" id="classScheduleModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content px-3" style="height: 650px !important;">
      <div class="modal-header justify-content-center" style="border-bottom: none; height: 100px !important; padding: 0 !important;">
        <h1 class="modal-title" id="staticBackdropLabel">CLASS SCHEDULE</h1>
        <button type="button" class="btn-close position-absolute top-0 end-0" style="top: 25px !important; right: 25px !important;" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Table -->
        <table class="table table-bordered text-center" style="height: 500px;">
          <thead style="background-color: var(--gold);">
            <tr>
              <th>Time</th>
              <th>Monday</th>
              <th>Tuesday</th>
              <th>Wednesday</th>
              <th>Thursday</th>
              <th>Friday</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "../connectDb.php"; // Ensure this file sets up $conn properly

            $section_id = $_SESSION['section_id'] ?? 1;

            $query = "SELECT 
                        cs.class_time, 
                        MAX(CASE WHEN cs.weekday = 'Monday' THEN cs.subject_name ELSE '' END) AS Monday,
                        MAX(CASE WHEN cs.weekday = 'Tuesday' THEN cs.subject_name ELSE '' END) AS Tuesday,
                        MAX(CASE WHEN cs.weekday = 'Wednesday' THEN cs.subject_name ELSE '' END) AS Wednesday,
                        MAX(CASE WHEN cs.weekday = 'Thursday' THEN cs.subject_name ELSE '' END) AS Thursday,
                        MAX(CASE WHEN cs.weekday = 'Friday' THEN cs.subject_name ELSE '' END) AS Friday
                      FROM class_schedule cs
                      JOIN section s ON cs.section_id = s.section_id
                      WHERE cs.section_id = ? 
                      GROUP BY cs.class_time
                      ORDER BY STR_TO_DATE(cs.class_time, '%h:%i %p')";

            // Prepare the SQL statement
            $stmt = $conn->prepare($query);
            if (!$stmt) {
              die('Prepare failed: ' . $conn->error);
            }

            // Bind the section_id to the query
            $stmt->bind_param('i', $_SESSION['section_id']);

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Check if there are any results
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo htmlspecialchars($row['class_time']); ?></td>
                  <td><?php echo htmlspecialchars($row['Monday']); ?></td>
                  <td><?php echo htmlspecialchars($row['Tuesday']); ?></td>
                  <td><?php echo htmlspecialchars($row['Wednesday']); ?></td>
                  <td><?php echo htmlspecialchars($row['Thursday']); ?></td>
                  <td><?php echo htmlspecialchars($row['Friday']); ?></td>
                </tr>
              <?php }
            } else { ?>
              <tr>
                <td colspan="6">No classes scheduled.</td>
              </tr>
            <?php }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>