<?php

    require_once 'init.php';
    require_once 'functions.php';

    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();
    checkIfNotLoggedInAndRedirect($redirectUrl);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="assets/images/findwork.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Job Opening - FindWork</title>
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

                <form method="post" action="assets/php/create_job_logic.php" class="edit-profile-form" >

                    <section>
                        <div class="heading">
                            <h1><i class="fas fa-plus-circle"></i> Create New Job Opening.</h1>
                            <br>
                            <p> Post a new job opening to the public...</p>
                        </div>
    
                        <br>
                        <hr>
                        <br>
                    </section>

                    <div class="input">
                        <label for="">job title</label>
                        <input type="text" name="job_title" placeholder="Job Title">
                    </div>

                    <div class="input">
                        <label for="">description</label>
                        <textarea name="job_description" id="" cols="30" rows="10" placeholder="Description for the job"></textarea>
                    </div>

                    <div class="input">
                        <label for="">Skill <br> <small>seperate each skill with a comma(,)</small> </label>
                        <input type="text" name="job_skills" placeholder="Skills you are in need of?...">
                    </div>

                    <div class="input">
                        <label for="">Location</label>
                        <input type="text" name="job_location" placeholder="Where is your job located?...">
                    </div>

                    <div class="input">
                        <label for="">salary</label>
                        <input type="number" name="job_salary" value="0">
                    </div>

                    <div class="input">
                        <label for="">Deadline</label>
                        <input type="date" name="job_end_date">
                    </div>

                    <div class="input">
                        <button type="submit">Post This Job</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>