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
        loadErrorPage('JOB ID NOT FOUND', 'The JOB You are seeking to approve has either expired or does not exist.');
        exit;
    }

    $jobDetails = fetchUserDetails('job_id', $_GET['job-id'], "jobs");

    if ( $jobDetails === false )
    {
        loadErrorPage('JOB ID NOT FOUND', 'The JOB You are seeking to approve has either expired or does not exist.');
        exit;
    }
    
    $allJobs = fetchAllDataFromATable('applications');

    // var_dump($allJobs);

    $target_id = $_GET['job-id'];

    $filtered_jobs = array_filter($allJobs, function($item) use ($target_id){
        return $item['job_id'] == $target_id;
    } );

    $applicants = array_values($filtered_jobs);

    // foreach ($applicants as $key => $applicant) {
            
    //     if ( $applicant['applicant_id'] != $target_id )
    //     {
            
    //         loadErrorPage("NO APPLICATION", "YOU DID NOT APPLY FOR THIS JOB. <a href='job_apply.php?job-id=".  $target_id ."'>Apply Here...</a>");
    //         exit;

    //     }

    // }

    // var_dump($myJobs);

    // usort($allJobs, function($a, $b){
    //     return $a['id'] - $b['id'];
    // });

    // echo "<pre>";
    // var_dump($applicants);
    // echo "</pre>";
    

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>Applicants Requests for <?php echo $jobDetails['job_title']  ?> - FindWork</title>

    <style>
        .container .right
        {
            width: calc(100% - 200px);
        }
    </style>
</head>
<body>
    
    <div class="container">

    <?php include_once 'assets/layouts/sidebar.php' ?>


        <div class="right">

        <?php include_once 'assets/layouts/navbar2.php' ?>


            <div class="contents">

                <section>
                    <div class="heading">
                        <h1>Job Title: <?php echo $jobDetails['job_title'] ?></h1>
                        <br>
                        <p>
                            Job Description: <?php echo $jobDetails['job_description'] ?>
                        </p>
                        <br>
                        <p>
                            Job Salary: <?php echo $jobDetails['job_salary'] ?>
                        </p>
                        <br>
                        <p>
                            Job Skills: <?php echo $jobDetails['job_skills'] ?>
                        </p>
                        <br>
                        <br>
                    </div>
                </section>

                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Applicant Name</th>
                            <th>Applicant Email</th>
                            <th>Applicant Skills</th>
                            <th>Applicant Education History</th>
                            <th>Applicant Phone Number</th>
                            <th>Applicant Resume URL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($applicants as $key => $applicant): ?>

                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_first_name'] . ' ' . fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_last_name'] ?></td>
                                <td><a href="mailto:<?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_email'] ?>"><?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_email'] ?></a></td>
                                <td><?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_skills'] ?></td>
                                <td><?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_education_history'] ?></td>
                                <td><a href="tel:<?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_phone_number'] ?> target="_blank""><?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_phone_number'] ?></a></td>
                                <td><a href="<?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_resume_url'] ?>" target="_blank" rel="noopener noreferrer"><?php echo fetchUserDetails('applicant_id', $applicant['applicant_id'], "applicants")['applicant_resume_url'] ?></a></td>
                                <td>
                                    <?php if( $applicant['status'] === 1 ): ?>
                                        <button>
                                            <i class="fas fa-check-circle"></i>
                                            Approved
                                        </button>
                                    <?php elseif($applicant['status'] === 2):?>
                                        <button class="bg-danger">
                                            <i class="fas fa-times-circle"></i>
                                            Rejected
                                        </button>
                                    <?php else: ?>
                                    <div class="btn-group">
                                        <form action="assets/php/job_approval_logic.php" method="post">
                                            <input type="hidden" name="job_id" value="<?php echo $_GET['job-id'] ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $applicant['applicant_id'] ?>">
                                            <input type="hidden" name="url" value="<?php echo getCurrentPageURL(); ?>">
                                            <button type="submit" name="approve_candidate"> <i class="fas fa-check"></i>  approve</button>
                                        </form>
                                        <form action="assets/php/job_approval_logic.php" method="post">
                                            <input type="hidden" name="job_id" value="<?php echo $_GET['job-id'] ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $applicant['applicant_id'] ?>">
                                            <input type="hidden" name="url" value="<?php echo getCurrentPageURL(); ?>">
                                            <button type="submit" class="bg-danger" name="reject_candidate"> <i class="fas fa-backspace"></i> reject</button>
                                        </form>
                                    </div>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>