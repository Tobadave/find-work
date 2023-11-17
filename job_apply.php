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
    

    if ( $user_info['role'] !== 'client' )
    {
        loadErrorPage('NOT AUTHORISED', 'This page is only authorized to Job Seekers', 403);
        exit;
    }

    if ( !isset($_GET['job-id']) )
    {
        loadErrorPage('JOB ID NOT FOUND', 'The JOB You are seeking to apply has either expired or does not exist.');
        exit;
    }


    if ( fetchUserDetails('applicant_id', $_SESSION['id'], 'applications') !== false )
    {

        if ( hash_equals( fetchUserDetails('applicant_id', $_SESSION['id'], 'applications')['job_id'], $_GET['job-id'] ) )
        {
            loadErrorPage('JOB APPLIED ALREADY', 'YOU HAVE ALREADY APPLIED FOR THIS JOB');
            exit;
        }

    }

    $user_info = fetchUserDetails('applicant_id', $_SESSION['id'], 'applicants');
    $job_info = fetchUserDetails('job_id', $_GET['job-id'], 'jobs');

    if (  $job_info === false || $user_info === false)
    {
        loadErrorPage('JOB ID NOT FOUND', 'The JOB You are seeking to apply has either expired or does not exist.');
        exit;
    }

    // echo "<pre>";
    // var_dump($job_info);
    // var_dump($user_info);
    // echo "</pre>";

?>

<?php 



?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>Apply For <?php echo $job_info['job_title'] ?> at <?php echo fetchUserDetails('employer_id', $job_info['job_author_id'], 'employers' )['company_name'] ?> - FindWork</title>
</head>
<body>
    
    <div class="container">

        <?php include_once 'assets/layouts/sidebar.php' ?>

        <div class="right">

            <?php include_once 'assets/layouts/navbar2.php' ?>


            <div class="contents">

                <form method="post" action="assets/php/job_apply_logic.php" class="edit-profile-form" >

                    <section>
                        <div class="heading">
                            <h1><i class="fas fa-briefcase"></i> Apply for <mark><?php echo fetchUserDetails('employer_id', $job_info['job_author_id'], 'employers' )['company_name'] ?></mark> Job Opening .</h1>
                            <br>
                            <p> You are applying for this job {<?php echo $job_info['job_title'] ?>} by {<?php echo fetchUserDetails('employer_id', $job_info['job_author_id'], 'employers' )['company_name'] ?>} ...</p>
                        </div>
    
                        <br>
                        <hr>
                        <br>
                    </section>

                    <section>


                        <section>
                            <div class="heading">
                                <h1><i class="fas fa-user-tie"></i> Job Information.</h1>
                                <br>
                            </div>
        
                            <br>
                            <hr>
                            <br>
                        </section>

                        <div class="input-group">

                            <div class="input">
                                <label for="">Job Title</label>
                                <input type="text" name="job_title" value="<?php echo $job_info['job_title'] ?>" readonly>
                            </div>

                            <div class="input">
                                <label for="">Company Name</label>
                                <input type="text" name="company_name" value="<?php echo fetchUserDetails('employer_id', $job_info['job_author_id'], 'employers' )['company_name']; ?>" readonly>
                            </div>

                        </div>

                        <div class="input">
                            <label for="">Job Description</label>
                            <textarea name="job_description" id="" cols="30" rows="10" value="<?php echo $job_info['job_description'] ?>" readonly><?php echo $job_info['job_description'] ?></textarea>
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
                            <input type="text" name="job_due_date" value="<?php echo $job_info['job_end_date'] ?>" readonly>
                        </div>
                        
                    </section>

                    <section>


                        <section>
                            <div class="heading">
                                <h1><i class="fas fa-user-tie"></i> My Information.</h1>
                                <br>
                                <p>Want to edit your information? Go to <a href="manage.php">My Profile</a> </p>
                            </div>
        
                            <br>
                            <hr>
                            <br>
                        </section>

                        <div class="input-group">

                        

                            <div class="input">
                                <label for="">first Name</label>
                                <input type="text" name="fname" value="<?php echo $user_info['applicant_first_name'] ?>">
                            </div>

                            <div class="input">
                                <label for="">last Name</label>
                                <input type="text" name="lname" value="<?php echo $user_info['applicant_last_name'] ?>">
                            </div>

                        </div>

                        <div class="input">
                            <label for="">Email</label>
                            <input type="email" name="email" value="<?php echo $user_info['applicant_email'] ?>">
                        </div>

                        <div class="input">
                            <label for="">Phone Number</label>
                            <input type="text" name="email" value="<?php echo $user_info['applicant_phone_number'] ?>">
                        </div>

                        <div class="input">
                            <label for="">My Skills</label>
                            <input type="text" name="email" value="<?php echo $user_info['applicant_skills'] ?>">
                        </div>

                        <div class="input">
                            <label for="">My Education History</label>
                            <input type="text" name="email" value="<?php echo $user_info['applicant_education_history'] ?>">
                        </div>

                        <div class="input">
                            <label for="">Resume Link</label>
                            <input type="url" name="resume_url" value="<?php echo $user_info['applicant_resume_url'] ?>">
                        </div>
                        
                    </section>

                    <section class="main">
                        <input type="hidden" name="job_id" value="<?php echo $job_info['job_id'] ?>">
                        <input type="hidden" name="applicant_id" value="<?php echo fetchUserDetails('id', $_SESSION['id'])['id'] ?>">
                        <input type="hidden" name="url" value="<?php echo getCurrentPageURL(); ?>">
                    </section>

                    <div class="input">
                        <button type="submit" name="apply_for_job">Apply For This Job</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        document.querySelectorAll('input').forEach(input => {
            input.setAttribute('readonly', '');
        });
    </script>

</body>
</html>