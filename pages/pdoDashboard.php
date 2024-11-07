<?php
session_start();

if (isset($_SESSION['logged_in']) != True) {
    header("Location: ../index");
    exit;
}
?>

!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICS - PDO Dashboard</title>
    <?php include "../partials/head.php" ?>
    <?php include "../modal/calendarActivityModal.php" ?>
    <?php include "../modal/viewAnnouncementModal.php" ?>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/footer.css">
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
                icon: '$swalType',
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
                                <p class="header-title">Ibaan Central School - PDO Portal</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Information Section -->
                        <div class="col-md-6">
                            <div class="student-section d-flex flex-row position-absolute bottom-0 start-0">
                                <img src="../img/avatar.jpg" class="avatar m-4" alt="Profile" style="width: 11%; height: 11%;">
                                <div class="student-info d-flex flex-column justify-content-center">
                                    <p class="info-bold text-start">DELA CRUZ, JUAN C.</p>
                                    <p class="info-text text-start">ID (123456)</p>
                                    <p class="info-text text-start">Project Development Office</p>
                                </div>
                            </div>
                        </div>
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
        <div class="row mt-3">
            <div class="col-md-3">
                <!-- Menu Bar -->
                <div class="menu d-flex flex-column rounded-4 row-gap-4 p-4" style="height: 520px;">
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#announcementModal"><iconify-icon class="menu-icon ph-icon" icon="iconoir:megaphone"></iconify-icon><span style="margin: 0 0 0 10px;">Announcement</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2"><iconify-icon class="menu-icon ph-icon" icon="material-symbols:list-alt-outline"></iconify-icon><span style="margin: 0 0 0 10px;">Student Record</span></a>
                    <a type="button" class="text-break d-flex flex-row align-items-center btn menu-btn btn-primary rounded-2" data-bs-toggle="modal" data-bs-target="#calendarActivityModal"><i class="menu-icon bi bi-calendar"></i><span style="margin: 0 0 0 10px;">Calendar Activities</span></a>
                </div>
            </div>
            <div class="col-md-4">
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
                        <a href="" class="expand text-decoration-none">Expand</a>
                    </div>
                </div>
            </div>

            <!-- Announcement  -->
            <div class="col-md-5">
                <div class="announcement-scroll rounded-4 p-4" style="height: 520px">
                    <p class="announcement-title fs-4 fw-bold text-center p-2">ANNOUNCEMENT</p>
                    <div class="announcement overflow-scroll" style="height: 383px; overflow-x: hidden !important; padding-left: 20px">
                        <div class="row announcement-section rounded-2 overflow-hidden" style="height: 300px; width: 100%;">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="../img/avatar.jpg" class="mt-3" alt="Profile" style="width: 70%; border-radius: 50%; margin-left: 20px;">
                                    </div>
                                    <div class="col-md-9 mt-4">
                                        <p class="name-text fw-bold">Dr. ALBERTO M. DE CHAVEZ</p>
                                        <p class="name-text">Principal IV</p>
                                        <p class="name-text fst-italic">Jan. 01, 2024</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <p class="announcement-text text-break lh-1 rounded-2 px-5 pb-2">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row announcement-section rounded-2 overflow-hidden mt-3" style="height: 300px; width: 100%;">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="../img/avatar.jpg" class="mt-3" alt="Profile" style="width: 70%; border-radius: 50%; margin-left: 20px;">
                                    </div>
                                    <div class="col-md-9 mt-4">
                                        <p class="name-text fw-bold">Dr. ALBERTO M. DE CHAVEZ</p>
                                        <p class="name-text">Principal IV</p>
                                        <p class="name-text fst-italic">Jan. 01, 2024</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="p-2">
                                        <p class="announcement-text text-break lh-1 rounded-2 px-5 pb-2">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="text-center mt-4">
                        <a href="" class="expand text-decoration-none">View More</a>
                    </div>
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
</body>

</html>