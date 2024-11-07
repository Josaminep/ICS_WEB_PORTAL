<?php
session_start();

if (isset($_SESSION['logged_in']) != True) {
    header("Location: ../index");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICS - Guidance Dashboard</title>
    <?php include "../partials/head.php" ?>
    <?php include "../modal/announcementModal.php" ?>
    <?php include "../modal/viewAnnouncementModal.php" ?>
    <?php include "../modal/studentRecordModal.php" ?>
    <?php include "../modal/enrollmentModal.php" ?>
    <?php include "../modal/viewMissionVisionModal.php" ?>
    <?php include "../modal/uploadScheduleModal.php" ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-4">
        <?php
        // Check if there is a SweetAlert message in the session
        if (isset($_SESSION['swal_message'])) {
            $swalType = $_SESSION['swal_message']['type'];
            $swalTitle = $_SESSION['swal_message']['title'];

            // Output the JavaScript to trigger the SweetAlert
            echo "<script>
            Swal.fire({
                title: '$swalTitle',
                confirmButtonText: 'OK'
            });
        </script>";

            // Clear the session variable to prevent the message from showing again
            unset($_SESSION['swal_message']);
        }
        ?>

        <!-- Header Section  -->
        <div class="row">
            <div class="col-md-12">
                <header class="header-bg text-center position-relative">
                    <!-- Header Background -->
                    <div class="rounded-4 overlay position-absolute top-50 start-50 translate-middle" style="width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
                    <img src="../img/schoolBanner.jpg" class="z-n2 rounded-4 img-fluid overflow-hidden" alt="Background" style="width: 100vw; height: 100%;">

                    <div class="row">
                        <!-- Logo Section -->
                        <div class="col-md-12">
                            <div class="logo-section d-flex flex-row align-items-center position-absolute top-0 start-0">
                                <img src="../img/icsLogo.png" class="img-fluid" alt="Logo">
                                <p class="header-title">Ibaan Central School - Guidance Portal</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Information Section -->
                        <div class="col-md-6">
                            <div class="info-section d-flex flex-row position-absolute bottom-0 start-0">
                                <img src="../img/avatar.jpg" class="avatar m-4" alt="Profile" style="width: 11%; height: 11%;">
                                <div class="user-info d-flex flex-column justify-content-center">
                                    <?php
                                    include "../connectDb.php";
                                    // Prepare the query
                                    $query = "SELECT CONCAT(gui.last_name, ', ', gui.first_name, ' ', LEFT(gui.middle_name, 1), '.') AS full_name, 
                                                     gui.guidance_id AS guidance_id,
                                                     r.rank_name AS rank_name
                                              FROM guidance gui
                                              LEFT JOIN rank r ON gui.rank_id = r.rank_id
                                              WHERE gui.guidance_id = RIGHT(?, 4)";

                                    // Prepare the statement to prevent SQL injection
                                    $stmt = $conn->prepare($query);

                                    // Bind the session user_id to the query
                                    $stmt->bind_param('s', $_SESSION['user_id']);

                                    // Execute the query
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <p class="info-bold text-start text-uppercase"><?php echo htmlspecialchars($row['full_name']); ?></p>
                                            <p class="info-text text-start">ICS-GUI<?php echo htmlspecialchars($row['guidance_id']); ?></p>
                                            <p class="info-text text-start"><?php echo htmlspecialchars($row['rank_name']); ?></p>
                                        <?php
                                            $_SESSION['full_name'] = $row['full_name'];
                                            $_SESSION['rank_name'] = $row['rank_name'];
                                        }
                                    } else { ?>
                                        <p class="info-bold text-start">No guidance found.</p>
                                    <?php }

                                    // Close the statement
                                    $stmt->close();
                                    $conn->close();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- Sign Out -->
                                               <!-- Sign Out -->
                                               <div class="col-md-6">
        <div class="so-section position-absolute bottom-0 end-0">
            <form id="logoutForm" action="../function/logoutAccount.php" method="POST">
                <button type="button" onclick="confirmLogout()" class="btn so-btn btn-primary rounded-5">
                    <i class="bi bi-box-arrow-in-right"></i> Sign Out
                </button>
            </form>
        </div>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you really want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('logoutForm').submit();
                }
            });
        }
    </script>

                    </div>
                </header>
            </div>
        </div>

        <!-- Body Container  -->
        <di class="row mt-3">
            <div class="col-md-3">
                <!-- Menu Bar -->
                <div class="menu p-4 rounded-4" style="height: 520px;">
                    <div class="overflow-y-scroll d-flex flex-column row-gap-4 px-1" style="height: 470px;">
                        <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#announcementModal"><iconify-icon class="menu-icon ph-icon" icon="iconoir:megaphone"></iconify-icon><span style="margin: 0 0 0 10px;">Announcement</span></a>
                        <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#enrollmentModal"><iconify-icon class="menu-icon ph-icon" icon="iconoir:notes"></iconify-icon><span style="margin: 0 0 0 10px;">Enrollment</span></a>
                        <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2 not-active" id="statistics-btn"><iconify-icon class="menu-icon ph-icon" icon="ant-design:dashboard-outlined"></iconify-icon><span style="margin: 0 0 0 10px;">Dashboard</span></a>
                        <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#studentRecordModal"><iconify-icon class="menu-icon ph-icon" icon="material-symbols:list-alt-outline"></iconify-icon><span style="margin: 0 0 0 10px;">Student Record</span></a>
                        <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#uploadSchedule"><i class="bi bi-calendar-plus menu-icon"></i><span style="margin: 0 0 0 10px;">Upload Schedule</span></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" id="mission-vision">
                <div class="mv-scroll rounded-4 p-2" style="height: 520px">
                    <!-- Mission and Vision  -->
                    <div class="mission-vision rounded-4 p-4 overflow-auto" style="height: 440px;">
                        <p class="mission-title fw-bold text-center p-2">MISSION</p>
                        <div class="mission-container overflow-auto">
                            <p class="mission-text text-break lh-1 rounded-2 p-3">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                        </div>
                        <p class="vision-title  fw-bold text-center p-2">VISION</p>
                        <div class="vision-container">
                            <p class="vision-text text-break lh-1 rounded-2 p-3">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a type="button" class="expand text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewMissionVision">Expand</a>
                    </div>
                </div>
            </div>

            <!-- Announcement  -->
            <div class="col-md-5" id="announcement">
                <div class="announcement-scroll rounded-4 p-4" style="height: 520px">
                    <p class="announcement-title fs-4 fw-bold text-center p-2">ANNOUNCEMENT</p>
                    <div class="announcement overflow-y-scroll" style="height: 385px;">
                        <?php
                        include "../connectDb.php";

                        // Initialize query with base SQL
                        $query = "SELECT * FROM announcements ORDER BY created_at DESC LIMIT 2";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="row mx-1 mb-3 rounded-3 p-3" style="background-color: var(--white);">
                                    <div class="col-md-12 mt-2">
                                        <div class="row align-items-center">
                                            <div class="col-6" style="width: 100px;">
                                                <img src="../img/avatar.jpg" alt="profilePic" style="width: 70px;">
                                            </div>
                                            <div class="col-6">
                                                <strong class="text-uppercase"><?php echo htmlspecialchars($row['full_name']); ?></strong><br>
                                                <span><?php echo htmlspecialchars($row['rank_name']); ?></span><br>
                                                <span class="fst-italic"><?php echo htmlspecialchars($row['created_at']); ?></span>
                                            </div>
                                        </div>
                                        <div class="row px-5 pt-4">
                                            <p class="fw-bold lh-base" style="color: black;"><?php echo htmlspecialchars($row['title']); ?></p>
                                            <p class="lh-base text-truncate" style="color: black; white-space: pre-wrap; height: 20px;"><?php echo htmlspecialchars($row['announcement_text']); ?></p>
                                        </div>
                                        <div class="row px-5 pb-4 justify-content-center">
                                            <?php
                                            $file_path = htmlspecialchars($row['announcement_file']);
                                            // Check if the file path is not null and not the empty directory path
                                            if (!is_null($file_path) && $file_path !== '../announcement/') {
                                                if (file_exists($file_path)) {
                                            ?>
                                                    <img class="img-thumbnail" src="<?php echo htmlspecialchars($row['announcement_file']); ?>" alt="announcementFile">
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

                    <div class="text-center mt-4">
                        <a type="button" class="expand text-decoration-none" data-bs-toggle="modal" data-bs-target="#viewAnnouncementModal">View More</a>
                    </div>
                </div>
            </div>
            
            <div class="main-con col hidden">
                <div class="row-gap-4 p-4 menu mb-4" id="BarGraph">
                    <?php
                    include "../connectDb.php";

                    $sections = [];
                    $sectionQuery = "SELECT section_id, section_name FROM section";
                    $sectionResult = $conn->query($sectionQuery);
                    if ($sectionResult->num_rows > 0) {
                        while ($section = $sectionResult->fetch_assoc()) {
                            $sections[] = $section;
                        }
                    }

                    $grades = [];
                    $gradeQuery = "SELECT DISTINCT grade_level_id FROM student";
                    $gradeResult = $conn->query($gradeQuery);
                    if ($gradeResult->num_rows > 0) {
                        while ($grade = $gradeResult->fetch_assoc()) {
                            $grades[] = $grade['grade_level_id'];
                        }
                    }

                    $subjectNames = [];
                    $subjectQuery = "SELECT subject_id, subject_name FROM subject";
                    $subjectResult = $conn->query($subjectQuery);
                    if ($subjectResult->num_rows > 0) {
                        while ($subject = $subjectResult->fetch_assoc()) {
                            $subjectNames[$subject['subject_id']] = $subject['subject_name'];
                        }
                    }

                    $selectedSection = isset($_POST['section']) ? $_POST['section'] : '';
                    $selectedGrade = isset($_POST['grade']) ? $_POST['grade'] : '';

                    function fetchAverageGrades($conn, $selectedSection, $selectedGrade)
                    {
                        $gradesBySubject = [];
                        $filterConditions = [];
                        if (!empty($selectedSection)) {
                            $filterConditions[] = "student.section_id = $selectedSection";
                        }
                        if (!empty($selectedGrade)) {
                            $filterConditions[] = "student.grade_level_id = $selectedGrade";
                        }
                        $filterSQL = !empty($filterConditions) ? ' WHERE ' . implode(' AND ', $filterConditions) : '';
                        $studentQuery = "SELECT student_id FROM student" . $filterSQL;
                        $studentResult = $conn->query($studentQuery);

                        if ($studentResult->num_rows > 0) {
                            while ($student = $studentResult->fetch_assoc()) {
                                $studentId = $student['student_id'];
                                $gradesQuery = "SELECT subject_id, first_quarter, second_quarter, third_quarter, fourth_quarter FROM grade WHERE student_id = ?";
                                $gradeStmt = $conn->prepare($gradesQuery);
                                $gradeStmt->bind_param('i', $studentId);
                                $gradeStmt->execute();
                                $gradeResult = $gradeStmt->get_result();

                                while ($grade = $gradeResult->fetch_assoc()) {
                                    foreach (['first_quarter', 'second_quarter', 'third_quarter', 'fourth_quarter'] as $quarter) {
                                        $subjectId = $grade['subject_id'];
                                        $gradeValue = $grade[$quarter];

                                        if ($gradeValue !== null) {
                                            if (!isset($gradesBySubject[$subjectId])) {
                                                $gradesBySubject[$subjectId] = ['sum' => 0, 'count' => 0];
                                            }

                                            $gradesBySubject[$subjectId]['sum'] += $gradeValue;
                                            $gradesBySubject[$subjectId]['count'] += 1;
                                        }
                                    }
                                }
                            }
                        }

                        $averageGrades = [];
                        foreach ($gradesBySubject as $subjectId => $data) {
                            if ($data['count'] > 0) {
                                $average = $data['sum'] / $data['count'];
                                $averageGrades[$subjectId] = round($average, 2);
                            }
                        }

                        return $averageGrades;
                    }

                    $averageGrades = fetchAverageGrades($conn, $selectedSection, $selectedGrade);
                    $labels = json_encode(array_map(function ($id) use ($subjectNames) {
                        return $subjectNames[$id];
                    }, array_keys($averageGrades)));
                    $averages = json_encode(array_values($averageGrades));

                    function getRecommendations($averageGrades, $subjectNames)
                    {
                        $recommendations = [];
                        foreach ($averageGrades as $subjectId => $average) {
                            $subjectName = $subjectNames[$subjectId] ?? 'Unknown Subject';
                            if ($average >= 90) {
                                $recommendations[$subjectName] = "Excellent performance. Encourage teachers to continue with their current methods and possibly share best practices with peers.";
                            } elseif ($average >= 75) {
                                $recommendations[$subjectName] = "Good performance. Suggest areas for slight improvements, like focusing on practical exercises or increasing student engagement in discussions.";
                            } elseif ($average >= 60) {
                                $recommendations[$subjectName] = "Satisfactory, but with room for improvement. Recommend targeted support for struggling students and the use of supplementary materials.";
                            } else {
                                $recommendations[$subjectName] = "Needs Improvement. Recommend strategies such as restructuring lesson plans, using more interactive methods, or additional tutoring for students.";
                            }
                        }
                        return $recommendations;
                    }

                    $recommendations = getRecommendations($averageGrades, $subjectNames);
                    ?>

                    <form id="filterForm">
                        <select id="section" name="section">
                            <option value="">All Sections</option>
                            <?php foreach ($sections as $section): ?>
                                <option value="<?= $section['section_id']; ?>" <?= $selectedSection == $section['section_id'] ? 'selected' : ''; ?>>
                                    <?= $section['section_name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <select id="grade" name="grade">
                            <option value="">All Grades</option>
                            <?php foreach ($grades as $grade): ?>
                                <option value="<?= $grade; ?>" <?= $selectedGrade == $grade ? 'selected' : ''; ?>>Grade <?= $grade; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" id="applyFilter"><i class="bi bi-funnel"></i></button>
                    </form>

                    <h1 class="text-light">Average Grades by Subject</h1>
                    <canvas id="gradesChart" width="400" height="200"></canvas>

                    <script>
                        let chart;

                        function updateChart(labels, averages) {
                            if (chart) {
                                chart.destroy();
                            }

                            const data = {
                                labels: labels,
                                datasets: [{
                                    label: 'Average Grades',
                                    data: averages,
                                    backgroundColor: '#fbbf24',
                                    borderColor: '#fbbf24',
                                    borderWidth: 1
                                }]
                            };

                            const config = {
                                type: 'bar',
                                data: data,
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                color: '#FFFFFF'
                                            },
                                            title: {
                                                display: true,
                                                text: 'Average Grades',
                                                color: '#FFFFFF'
                                            }
                                        },
                                        x: {
                                            ticks: {
                                                color: '#FFFFFF'
                                            }
                                        },
                                    }
                                }
                            };

                            chart = new Chart(document.getElementById('gradesChart'), config);
                        }

                        updateChart(<?= $labels; ?>, <?= $averages; ?>);

                        document.getElementById('filterForm').addEventListener('submit', function(e) {
                            e.preventDefault();

                            const formData = new FormData(this);
                            fetch('', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.text())
                                .then(data => {
                                    const parser = new DOMParser(),
                                        doc = parser.parseFromString(data, 'text/html'),
                                        newLabels = JSON.parse(doc.getElementById('newLabels').textContent),
                                        newAverages = JSON.parse(doc.getElementById('newAverages').textContent);

                                    updateChart(newLabels, newAverages);

                                    const newRecommendations = JSON.parse(doc.getElementById('newRecommendations').textContent);
                                    displayRecommendations(newRecommendations);
                                })
                                .catch(error => console.error('Error:', error));
                        });

                        function displayRecommendations(recommendations) {
                            const recommendationsContainer = document.querySelector('.recommendation-text');
                            recommendationsContainer.innerHTML = '';
                            for (const subject in recommendations) {
                                const p = document.createElement('p');
                                p.textContent = `${subject}: ${recommendations[subject]}`;
                                recommendationsContainer.appendChild(p);
                            }
                        }
                    </script>

                    <div style="display: none;">
                        <span id="newLabels"><?= $labels; ?></span>
                        <span id="newAverages"><?= $averages; ?></span>
                        <span id="newRecommendations"><?= json_encode($recommendations); ?></span>
                    </div>
                </div>
                <div class="recommendation-text">
                    <h2 class="text-white">Recommendations Here</h2>
                </div>
                <div class="row-gap-4 p-4 menu" id="filterSection">
                    <?php
                    include "../connectDb.php";

                    $subjects = [];
                    $subjectQuery = "SELECT subject_id, subject_name FROM subject";
                    $subjectResult = $conn->query($subjectQuery);

                    if ($subjectResult->num_rows > 0) {
                        while ($subject = $subjectResult->fetch_assoc()) {
                            $subjectId = $subject['subject_id'];
                            $subjectName = $subject['subject_name'];
                            $gradesQuery = "SELECT s.student_id, s.first_name, s.middle_name, s.last_name, 
                                   g.first_quarter, g.second_quarter, g.third_quarter, g.fourth_quarter
                            FROM student s
                            JOIN grade g ON s.student_id = g.student_id
                            WHERE g.subject_id = ?";
                            $stmt = $conn->prepare($gradesQuery);
                            $stmt->bind_param('i', $subjectId);
                            $stmt->execute();
                            $gradeResult = $stmt->get_result();

                            $students = [];
                            while ($row = $gradeResult->fetch_assoc()) {
                                $totalGrades = 0;
                                $count = 0;

                                foreach (['first_quarter', 'second_quarter', 'third_quarter', 'fourth_quarter'] as $quarter) {
                                    if ($row[$quarter] !== null) {
                                        $totalGrades += $row[$quarter];
                                        $count++;
                                    }
                                }

                                if ($count > 0) {
                                    $fullName = trim($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']);
                                    $averageGrade = round($totalGrades / $count, 2);
                                    $students[] = [
                                        'student_id' => $row['student_id'],
                                        'full_name' => $fullName,
                                        'average_grade' => $averageGrade,
                                    ];
                                }
                            }

                            usort($students, function ($a, $b) {
                                return $b['average_grade'] <=> $a['average_grade'];
                            });

                            $topStudents = array_slice($students, 0, 10);

                            usort($students, function ($a, $b) {
                                return $a['average_grade'] <=> $b['average_grade'];
                            });

                            $lowestStudents = array_slice($students, 0, 10);
                            $subjects[$subjectName] = [
                                'top' => $topStudents,
                                'lowest' => $lowestStudents
                            ];
                        }
                    }

                    $conn->close();
                    ?>

                    <h1 class="text-light">Top and Lowest Students by Subject</h1>
                    <select id="subjectSelect">
                        <option value="">Select a Subject</option>
                        <?php foreach (array_keys($subjects) as $subjectName): ?>
                            <option value="<?php echo htmlspecialchars($subjectName); ?>"><?php echo htmlspecialchars($subjectName); ?></option>
                        <?php endforeach; ?>
                    </select>

                    <div id="topStudentsContainer"></div>
                    <div id="lowestStudentsContainer"></div>

                    <script>
                        const subjects = <?php echo json_encode($subjects); ?>;

                        $(document).ready(function() {
                            $('#subjectSelect').on('change', function() {
                                const subjectName = $(this).val(),
                                    topStudentsContainer = $('#topStudentsContainer'),
                                    lowestStudentsContainer = $('#lowestStudentsContainer');

                                topStudentsContainer.empty();
                                lowestStudentsContainer.empty();

                                if (subjectName && subjects[subjectName]) {
                                    const topStudents = subjects[subjectName].top,
                                        lowestStudents = subjects[subjectName].lowest;

                                    if (topStudents.length > 0) {
                                        let topStudentTable = $('<table class="table table-striped"><thead><tr><th class="text-light">Name</th><th class="text-light">Average Grade</th></tr></thead><tbody></tbody></table>');
                                        $.each(topStudents, function(index, student) {
                                            topStudentTable.find('tbody').append(`<tr><td class="text-light">${student.full_name}</td><td class="text-light">${student.average_grade}</td></tr>`);
                                        });
                                        topStudentsContainer.append('<h2 class="text-light">Top 10 Students with Highest Performance:</h2>').append(topStudentTable);
                                    } else
                                        topStudentsContainer.append('<h2 class="text-light">Top 10 Students with Highest Performance:</h2><p style="color: #000000;">No records found.</p>');

                                    if (lowestStudents.length > 0) {
                                        let lowestStudentTable = $('<table class="table table-striped"><thead><tr><th class="text-light">Name</th><th class="text-light">Average Grade</th></tr></thead><tbody></tbody></table>');
                                        $.each(lowestStudents, function(index, student) {
                                            lowestStudentTable.find('tbody').append(`<tr><td class="text-light">${student.full_name}</td><td class="text-light">${student.average_grade}</td></tr>`);
                                        });
                                        lowestStudentsContainer.append('<h2 class="text-light">Lowest 10 Students with Lowest Performance:</h2>').append(lowestStudentTable);
                                    } else
                                        lowestStudentsContainer.append('<h2 class="text-light">Lowest 10 Students with Lowest Performance:</h2><p style="color: #000000;">No records found.</p>');
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <div class="row mt-3 mb-4">
            <div class="col-md-12">
                <footer class="shadow-lg rounded-4">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center mt-5" style="column-gap: 70px;">
                            <img src="../img/kneLogo.png" class="img-fluid footer-logo" alt="kne">
                            <img src="../img/dobLogo.png" class="img-fluid footer-logo" alt="dob" style="height: 95%">
                            <img src="../img/icsLogo.png" class="img-fluid footer-logo" alt="ics">
                        </div>
                    </div>
                    <div class="row school-section">
                        <div class="col-md-12">
                            <ul class="d-flex flex-row justify-content-center mt-5 list-inline" style="column-gap: 15%;">
                                <li class="d-flex flex-row align-items-center"><iconify-icon class="iconify-footer" icon="ri:facebook-circle-line"></iconify-icon><span style="margin: 0 0 0 10px;">Ibaan Central School</span></li>
                                <li class="d-flex flex-row align-items-center"><iconify-icon class="iconify-footer" icon="iconamoon:location-pin"></iconify-icon><span style="margin: 0 0 0 10px;">R4FM+5H5, Poblacion Rd, Ibaan, Batangas</span></li>
                                <li class="d-flex flex-row align-items-center"><iconify-icon class="iconify-footer" icon="ph:phone"></iconify-icon><span style="margin: 0 0 0 10px;">(043) 702 - 3669</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row copyright-section rounded-bottom-4" style="margin: 0;">
                        <div class="col-md-12">
                            <p class="text-center fw-bold mt-3">Copyright © Ibaan Central School</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => {
            $('#statistics-btn').click(function() {
                $(this).toggleClass('not-active');
                $('.main-con').toggleClass('hidden');

                $('#announcement').toggleClass('hidden');
                $('#mission-vision').toggleClass('hidden');
            });
        });
    </script>
</body>

</html>