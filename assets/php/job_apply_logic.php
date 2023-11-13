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

?>

<?php 

    if ( isset( $_POST['apply_for_job'] ) )
    {

        $job_id = $_POST['job_id'];
        $applicant_id = $_POST['applicant_id'];
        $url = $_POST['url'];

        if ( empty($job_id) || empty($applicant_id) )
        {
            echo 'SOME REQUIRED INFORMATIONS ARE MISSING FROM YOUR REQUEST.';
            exit;
        }

        $applicationId = generateRandomStrings(20, 'APP-ID-');
        

        $query = 'INSERT INTO applications (application_id, applicant_id, job_id) VALUES (?,?,?)';

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sss", $applicationId, $applicant_id, $job_id);

        if ( mysqli_stmt_execute($stmt) )
        {
            header("Location:" . $url . "&code=201&message=your_application_has_been_sent");
            exit;
        }
        else
        {
            echo "ERROR";
            exit;
        }
        



    }

?>