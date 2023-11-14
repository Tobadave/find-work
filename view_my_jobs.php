<?php 

    // Include necessary files and functions
    require_once 'init.php';
    require_once 'functions.php';

    // Set the redirect URL to the login page with the current page URL as a parameter
    $redirectUrl = 'login.php?redirect=' . getCurrentPageURL();

    // Check if the user is not logged in and redirect to the login page if necessary
    checkIfNotLoggedInAndRedirect($redirectUrl);

    $allJobs = fetchAllDataFromATable('jobs');

    // var_dump($allJobs);

    $target_id = $_SESSION['id'];

    $filtered_jobs = array_filter($allJobs, function($item) use ($target_id){
        return $item['job_author_id'] == $target_id;
    } );

    $myJobs = array_values($filtered_jobs);

    // var_dump($myJobs);

    // usort($allJobs, function($a, $b){
    //     return $a['id'] - $b['id'];
    // });

    // echo "<pre>";
    // var_dump($myJobs);
    // echo "</pre>";
    

?>

<?php include_once 'assets/layouts/head.php' ?>

    <title>My Posted Jobs - FindWork</title>
</head>
<body>
    
    <div class="container">

    <?php include_once 'assets/layouts/sidebar.php' ?>

        <div class="right">

        <?php include_once 'assets/layouts/navbar2.php' ?>


            <div class="contents">

            <table class="table">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Job Title</th>
                        <th>Job Description</th>
                        <th>Job Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($myJobs as $key => $myJob): ?>

                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $myJob['job_title'] ?></td>
                            <td><?php echo $myJob['job_description'] ?></td>
                            <td><?php echo $myJob['job_salary'] ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="edit_job.php?job-id=<?php echo $myJob['job_id'] ?>" class="btn"> <i class="fas fa-pen"></i> Edit Job</a>
                                    <form action="assets/php/delete_job_logic.php" method="post">
                                        <input type="hidden" name="job_id" value="<?php echo $myJob['job_id'] ?>">
                                        <button type="submit" class="bg-danger" name="delete_job"> <i class="fas fa-backspace"></i> Delete job</button>
                                    </form>
                                </div>
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