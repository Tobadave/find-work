<?php
    // Include necessary files and functions
    include("../../init.php");
    include("../../functions.php");
?>

<?php 

    // Check if the request method is not POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo "INCORRECT METHOD";
        exit;
    }

    if( isset($_POST["delete_job"]) )
    {

        $delete_id = $_POST['job_id'];

        if (empty($delete_id))
        {
            echo "ID NOT FOUND";
            exit;
        }

        if ( fetchUserDetails('job_id', $delete_id, 'jobs') === false )
        {
            echo "THE JOB DOES NOT EXIST";
            exit;
        }


        if (deleteItem('jobs', 'job_id', $delete_id)  )
        {
            header('Location: ../../view_my_jobs.php?code=200&message=Successfully_Deleted');
            exit;
        }

    }


?>