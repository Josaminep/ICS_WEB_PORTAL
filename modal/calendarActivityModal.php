<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Activity - ICS PDO Portal</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <style>
        /* Optional: Set a height for the calendar */
        #calendar {
            max-width: 900px;
            margin: 40px auto;
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade modal-xl" id="calendarActivityModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="staticBackdropLabel">CALENDAR ACTIVITY</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div id="calendar"></div>
                        </div>
                        <div class="col-md-3">
                            <div class="card rounded-2 shadow">
                                <div class="card-header bg-gradient bg-primary text-light">
                                    <h5 class="card-title">Schedule Form</h5>
                                </div>
                                <div class="card-body">
                                    <form action="../function/saveSchedule.php" method="post" id="schedule-form">
                                        <input type="hidden" name="id" value="">
                                        <div class="form-group mb-2">
                                            <label for="title" class="control-label">Title</label>
                                            <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="description" class="control-label">Description</label>
                                            <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="start_datetime" class="control-label">Start</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="end_datetime" class="control-label">End</label>
                                            <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="text-center">
                                        <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                                        <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: [
                    <?php
                    // Database connection
                    $host     = 'localhost'; // Change as necessary
                    $username = 'root';      // Change as necessary
                    $password = '';          // Change as necessary
                    $dbname   = 'ics_db';    // Change as necessary

                    // Create connection
                    $conn = new mysqli($host, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch events from the database
                    $sql = "SELECT title, description, start_datetime AS start, end_datetime AS end FROM schedule_list";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Output data for each event
                        while ($row = $result->fetch_assoc()) {
                            echo json_encode([
                                'title' => $row['title'],
                                'start' => $row['start'],
                                'end'   => $row['end'],
                                'description' => $row['description']
                            ]) . ",";
                        }
                    } else {
                        echo "[]"; // No events found
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                ],
                eventRender: function(event, element) {
                    element.find('.fc-title').append("<br/>" + event.description); // Append the description to the title
                },
                editable: false // Set to true if you want to allow editing of events
            });
        });
    </script>

    <script src="../js/schedule.js"></script>
</body>

</html>
