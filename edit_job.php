<?php 

    // Include necessary files and functions
    require_once 'init.php';
    require_once 'functions.php';

    // Set the redirect URL to the login page with the current page URL as a parameter
    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();

    // Check if the user is not logged in and redirect to the login page if necessary
    checkIfNotLoggedInAndRedirect($redirectUrl);

    $user_info = fetchUserDetails('id', $_SESSION['id']);

    if ( $user_info === false )
    {
        loadErrorPage('USER NOT FOUND', 'NO USER FOUND');
        exit;
    }
    
    if ( $user_info['role'] !== 'employeer' )
    {
        loadErrorPage('NOT AUTHORISED', 'This page cannot be accessed by You.', 403);
        exit;
    }

    if ( !isset($_GET['job-id']) )
    {
        loadErrorPage('JOB ID NOT FOUND', 'The JOB You are seeking to apply has either expired or does not exist.');
        exit;
    }


    if ( ! hash_equals( fetchUserDetails('job_id', $_GET['job-id'], 'jobs')['job_author_id'], $_SESSION['id'] ) )
    {
        loadErrorPage('JOB NOT FOUND', 'THE JOB YOU WISH TO EDIT IS NOT FOUND');
        exit;
    }

    // $user_info = fetchUserDetails('applicant_id', $_SESSION['id'], 'applicants');
    $job_info = fetchUserDetails('job_id', $_GET['job-id'], 'jobs');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="assets/images/findwork.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply For {ROLE} at {COMPANY NAME} - FindWork</title>
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

                <form method="post" action="assets/php/edit_job_logic.php" class="edit-profile-form" >

                    <section>
                        <div class="heading">
                            <h1><i class="fas fa-briefcase"></i> Editing the <mark><?php echo $job_info['job_title'] ?></mark> Job Opening .</h1>
                            <br>
                        </div>
    
                        <br>
                        <hr>
                        <br>
                    </section>

                    <section>


                        <section>
                            <div class="heading">
                                <br>
                            </div>
        
                            <br>
                            <br>
                        </section>

                        <div class="input-group">

                            <div class="input">
                                <label for="">Job Title</label>
                                <input type="text" name="job_title" value="<?php echo $job_info['job_title'] ?>" >
                            </div>

                            <div class="input">
                                <label for="">Company Name</label>
                                <input type="text" name="company_name" value="<?php echo fetchUserDetails('employer_id', $job_info['job_author_id'], 'employers' )['company_name']; ?>" >
                            </div>

                        </div>

                        <div class="input">
                            <label for="">Job Description</label>
                            <textarea name="job_description" id="" cols="30" rows="10" value="<?php echo $job_info['job_description'] ?>" ><?php echo $job_info['job_description'] ?></textarea>
                        </div>

                        <div class="input">
                            <label for="">Salary</label>
                            <input type="text" name="job_salary" value="<?php echo $job_info['job_salary'] ?>">
                        </div>

                        <div class="input">
                            <label for="">Required Skills</label>
                            <input type="text" name="job_skills" value="<?php echo $job_info['job_skills'] ?>">
                        </div>

                        <div class="input">
                            <label for="">Location</label>
                            <input type="text" name="location" value="<?php echo $job_info['job_location']; ?>">
                        </div>

                        <div class="input">
                            <label for="">Job Closing Date</label>
                            <input type="text" name="job_due_date" value="<?php echo $job_info['job_end_date'] ?>" >
                        </div>
                        
                    </section>

                    <section class="main">
                        <input type="hidden" name="job_id" value="<?php echo $job_info['job_id'] ?>">
                        <input type="hidden" name="url" value="<?php echo getCurrentPageURL(); ?>">
                    </section>

                    <div class="input">
                        <button type="submit" name="update_job"> Update This Job</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>