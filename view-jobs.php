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

<?php include_once 'assets/layouts/head.php' ?>
    <title>View All Open Jobs - FindWork</title>
</head>
<body>
    
    <div class="container">

        <div class="right">

            <?php include_once 'assets/layouts/navbar.php' ?>

            <div class="contents">
                <?php if( $allJobs !== false ): ?>
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
                                    <span><b>Skills: </b></span>  <?php echo $job['job_skills'] ?>
                                </div>

                                <div class="skills">
                                    <span><b>Due Date: </b></span> <?php echo $job['job_end_date'] ?>
                                </div>

                                <a href="job_apply.php?job-id=<?php echo $job['job_id'] ?>" class="btn">Apply For Job</a>
                            </div>

                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                    <center><h1>THERE ARE NO OPEN JOBS YET.  <br> CHECK BACK LATER</h1></center>
                <?php endif; ?>

            </div>

        </div>

    </div>

</body>
</html>