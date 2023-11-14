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

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="assets/images/findwork.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - FindWork</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="http://localhost/@itms/fontawesome-free-6.4.0-web/js/all.min.js"></script>
    <style>
        .container .right
        {
            width: calc(100% - 200px);
        }
    </style>
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

                <table class="table">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Job Title</th>
                            <th>Job URL</th>
                            <th>Job URL</th>
                            <th>Number Of Applicants</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach($myJobs as $key => $myJob): $job_id = $myJob['job_id']; ?>

                            <?php 
                                $allApplications = fetchAllDataFromATable('applications');    
                                $filtered_applications = array_filter($allApplications, function($item) use ($job_id){
                                    return $item['job_id'] == $job_id;
                                } );
                            
                                $applicationsForEachJob = array_values($filtered_applications);

                                $numberOfApplications = count($applicationsForEachJob);

                                $numberOfApplications = ($numberOfApplications >= 0) ? $numberOfApplications : 0;

                            ?>

                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $myJob['job_title'] ?></td>
                                <td><?php echo $myJob['job_description'] ?></td>
                                <td><?php echo $myJob['job_salary'] ?></td>
                                <td align="center"><?php echo $numberOfApplications; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="view_job_to_be_approved.php?job-id=<?php echo $myJob['job_id'] ?>" class="btn"> <i class="fas fa-eye"></i> View All Applicants</a>
                                        <!-- <form action="assets/php/delete_job_logic.php" method="post">
                                            <input type="hidden" name="job_id" value="<?php echo $myJob['job_id'] ?>">
                                            <button type="submit" class="bg-danger" name="delete_job"> <i class="fas fa-backspace"></i> Delete job</button>
                                        </form> -->
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