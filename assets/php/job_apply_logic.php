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
        $requestData = json_decode(file_get_contents('php://input'), true);

        $job_id = $requestData['job_id'];
        $applicant_id = $requestData['applicant_id'];
        $url = $requestData['url'];

        if ( empty($job_id) || empty($applicant_id) )
        {
            // echo 'SOME REQUIRED INFORMATIONS ARE MISSING FROM YOUR REQUEST.';
            // exit;
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'SOME REQUIRED INFORMATIONS ARE MISSING FROM YOUR REQUEST.',
            );
            echo json_encode($response);
            exit;
        }

        $applicationId = generateRandomStrings(20, 'APP-ID-');
        

        $query = 'INSERT INTO applications (application_id, applicant_id, job_id) VALUES (?,?,?)';

        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sss", $applicationId, $applicant_id, $job_id);

        if ( mysqli_stmt_execute($stmt) )
        {
            // header("Location:" . $url . "&code=201&message=your_application_has_been_sent");
            // exit;
            http_response_code(200);
            $response = array(
                "status" => 200,
                "message" => 'YOUR APPLICATION HAS BEEN SENT✅',
            );
            echo json_encode($response);
            exit;
        }
        else
        {
            // echo "ERROR";
            // exit;
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'An Error Occured',
            );
            echo json_encode($response);
            exit;
        }
        




?>