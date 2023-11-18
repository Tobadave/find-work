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
        loadErrorPage('NOT AUTHORISED', 'This page cannot be accessed by You.', 403);
        exit;
    }
    
    $allJobs = fetchAllDataFromATable('applications');
    
    if( $allJobs === false )
    {
        loadErrorPage('NO JOBS APPLIED YET', 'YOU HAVE NOT YET APPLIED FOR ANY JOB', 200);
    }

    $target_id = $_SESSION['id'];

    $filtered_jobs = array_filter($allJobs, function($item) use ($target_id){
        return $item['applicant_id'] == $target_id;
    } );

    $my_jobs = array_values($filtered_jobs);

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>My Applied Jobs - FindWork</title>

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
                        <h1>Jobs I have applied for...</h1>
                        <br>
                    </div>
                </section>

                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Job Title</th>
                            <th>Job Description</th>
                            <th>Company Name</th>
                            <th>Salary</th>
                            <th>Date Applied</th>
                            <th>Job URL</th>
                            <th>Job Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($my_jobs as $key => $job): ?>

                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo fetchUserDetails('job_id', $job['job_id'], "jobs")['job_title'] ?></td>
                                <td><?php echo fetchUserDetails('job_id', $job['job_id'], "jobs")['job_description'] ?></td>
                                <td><?php echo fetchUserDetails('job_id', $job['job_id'], "jobs")['job_skills'] ?></td>
                                <td><?php echo fetchUserDetails('job_id', $job['job_id'], "jobs")['job_salary']?></td>
                                <td><?php echo $job['date_submited'] ?></td>
                                <td><a href="job_apply.php?job-id=<?php echo $job['job_id'] ?>" target="_blank" rel="noopener noreferrer">job_apply.php?job-id=<?php echo $job['job_id'] ?></a></td>
                                <td>
                                    <?php if( $job['status'] === 1 ): ?>
                                        <button>
                                            <i class="fas fa-check-circle"></i>
                                            Approved
                                        </button>
                                    <?php elseif($job['status'] === 2):?>
                                        <button class="bg-danger">
                                            <i class="fas fa-times-circle"></i>
                                            Rejected
                                        </button>
                                    <?php else: ?>
                                        <button class="bg-warning">
                                            <i class="fas fa-clock"></i>
                                            PENDING
                                        </button>
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