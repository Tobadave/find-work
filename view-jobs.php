<?php 

    // Include necessary files and functions
    require_once 'init.php';
    require_once 'functions.php';

    // Set the redirect URL to the login page with the current page URL as a parameter
    // $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();

    // Check if the user is not logged in and redirect to the login page if necessary
    // checkIfNotLoggedInAndRedirect($redirectUrl);

    $allJobs = fetchAllDataFromATable('jobs');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="assets/images/findwork.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Open Jobs - FindWork</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="http://localhost/@itms/fontawesome-free-6.4.0-web/js/all.min.js"></script>
</head>
<body>
    
    <div class="container">

        <div class="right">

            <div class="navbar">

                <div class="logo">
                    <img src="assets/images/findwork.png" alt="">
                </div>

                <div class="nav-items">

                    <a href="manage.php" class="nav-item">
                        <i class="fas fa-user"></i>
                        my profile
                    </a>

                    <form action="logout.php" class="nav-item bg-danger">
                        <button>logout</button>
                    </form>

                </div>

            </div>

            <div class="contents">

                <!-- <div class="cards card-4 jobs-list">

                    <div class="card">
                        <h3 class="title">
                            Example Title
                        </h3>
                        <p class="description">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor enim assumenda perspiciatis inventore ex, praesentium deserunt quia impedit consequuntur reiciendis possimus ratione magni non voluptatem aliquam aspernatur laborum labore tempore.
                        </p>
                        <div class="company">
                            Company Name
                        </div>

                        <div class="skills">
                            <span><b>Skills: </b></span> HTML, CSS, JS, BOOTSRAP
                        </div>

                        <a href="job_apply.php?job-id=" class="btn">Apply For Job</a>
                    </div>

                </div> -->

                <div class="cards card-4 jobs-list">
                    <?php foreach( $allJobs as $job ) : ?>

                            <div class="card">
                                <h3 class="title">
                                    <?php echo $job['job_title']; ?>
                                </h3>
                                <p class="description">
                                    <?php echo $job['job_description'] ?>
                                </p>
                                <div class="company">
                                    <?php echo fetchUserDetails('employer_id', $job['job_author_id'], 'employers' )['company_name'] ?>
                                </div>

                                <div class="skills">
                                    <span><b>Skills: </b></span> HTML, CSS, JS, BOOTSRAP
                                </div>

                                <div class="skills">
                                    <span><b>Due Date: </b></span> <?php echo $job['job_end_date'] ?>
                                </div>

                                <a href="job_apply.php?job-id=<?php echo $job['job_id'] ?>" class="btn">Apply For Job</a>
                            </div>

                    <?php endforeach; ?>
                </div>

            </div>

        </div>

    </div>

</body>
</html>