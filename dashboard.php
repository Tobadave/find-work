<?php
require_once 'init.php';
require_once 'functions.php';

    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    checkIfNotLoggedInAndRedirect($redirectUrl);

    $userDetails = fetchUserDetails('id', $_SESSION['id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="assets/images/findwork.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - FindWork</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="http://localhost/@itms/fontawesome-free-6.4.0-web/js/all.min.js"></script>
</head>
<body>
    
    <div class="container">

        <div class="left">

            <div class="header">
                <div class="logo">
                    <img src="assets/images/findwork.png" alt="">
                </div>
            </div>

            <div class="main"></div>

            <div class="footer"></div>

        </div>

        <div class="right">

            <div class="navbar">

                <div></div>

                <div class="nav-items">

                    <a href="#" class="nav-item">
                        <i class="fas fa-user"></i>
                        my profile
                    </a>

                    <form action="logout.php" class="nav-item">
                        <button>logout</button>
                    </form>

                </div>

            </div>

            <div class="contents">

                <div class="cards card-4 admin-dashboard">

                <?php if ( $userDetails['role'] === 'client' ): ?>

                    <a href="index.php" class="card">
                        <div class="icon">
                            <i class="fas fa-external-link"></i>
                        </div>
                        <div class="text">
                            go to home page
                        </div>
                    </a>

                    <a href="manage.php" class="card">
                        <div class="icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="text">
                            manage my profile
                        </div>
                    </a>

                    <a href="view-jobs.php" class="card">
                        <div class="icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="text">
                            apply for a job
                        </div>
                    </a>

                    <a href="#" class="card">
                        <div class="icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="text">
                            view all my applied jobs
                        </div>
                    </a>

                <?php else: ?>

                    <a href="index.php" target="_blank" class="card">
                        <div class="icon">
                            <i class="fas fa-external-link"></i>
                        </div>
                        <div class="text">
                            go to home page
                        </div>
                    </a>

                    <a href="manage.php" class="card">
                        <div class="icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="text">
                            manage my profile
                        </div>
                    </a>

                    <a href="create_job.php" class="card">
                        <div class="icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="text">
                            create new job posting
                        </div>
                    </a>

                    <a href="view_my_jobs.php" class="card">
                        <div class="icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <div class="text">
                            view all my jobs posted
                        </div>
                    </a>

                    <?php endif; ?>

                    <form action="logout.php" method="post" class="card bg-danger">
                        <div class="icon">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="text">LOGOUT</div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</body>
</html>