<?php
    // Include necessary files and functions
    include("../../init.php");
    include("../../functions.php");
?>

<?php
    // Check if the request method is not POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        http_response_code(403);
        $response = array(
            "status" => 403,
            "message" => 'Incorrect Method',
        );
        echo json_encode($response);
        exit;
    }

    $requestData = json_decode(file_get_contents('php://input'), true);

    // Check if the form with the name "emp_info" was submitted
    if (isset($requestData["emp_info"])) {
        // Fetch employer information from the database
        $compInfo = fetchUserDetails('employer_id', $_SESSION['id'], 'employers');

        // Retrieve updated employer information from the POST data
        $employer_name = $requestData['comp_employer_name'];
        $company_name = $requestData['comp_name'];
        $company_email = $requestData['comp_email'];
        $company_feild = $requestData['comp_feild'];

        // Get the user ID from the session
        $user_id = $_SESSION['id'];

        // Array to track if each update operation was successful
        $shouldContinue = [];

        // Update employer name if it's not empty and different from the current value
        if (!empty($employer_name) && $employer_name !== $compInfo['employer_name']) {
            if (updateItem('employers', 'employer_name', $employer_name, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Update company name if it's not empty and different from the current value
        if (!empty($company_name) && $company_name !== $compInfo['company_name']) {
            if (updateItem('employers', 'company_name', $company_name, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Update company field if it's not empty and different from the current value
        if (!empty($company_feild) && $company_feild !== $compInfo['employer_feild']) {
            if (updateItem('employers', 'employer_feild', $company_feild, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Update company email if it's not empty and different from the current value
        if (!empty($company_email) && $company_email !== $compInfo['employer_email']) {
            if (updateItem('users', 'email', $company_email, 'employer_id', $user_id)) {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
        } else {
            array_push($shouldContinue, true);
        }

        // Check if all update operations were successful
        $allTrue = array_reduce($shouldContinue, function ($carry, $item) {
            return $carry && $item;
        }, true);

        // Redirect based on the success of update operations
        if ($allTrue) {
            http_response_code(200);
            $response = array(
                "status" => 200,
                "message" => 'Incorrect Method',
            );
            echo json_encode($response);
            exit;
        } else {
            http_response_code(400);
            $response = array(
                "status" => 403,
                "message" => 'An Error Occured',
            );
            echo json_encode($response);
            exit;
        }
    }

    if(  isset($requestData['usr_info']) )
    {

        $userInfo = fetchUserDetails('applicant_id', $_SESSION['id'], 'applicants');

        $first_name = $requestData['fname'];
        $last_name = $requestData['lname'];
        $email = $requestData['email'];
        $phone_number = $requestData['phone'];
        $resume_url = $requestData['resume_url'];

        // Get the user ID from the session
        $user_id = $_SESSION['id'];

        // Array to track if each update operation was successful
        $shouldContinue = [];

        if( !empty($first_name) && $first_name !== $userInfo['applicant_first_name'] )
        {
            if ( updateItem('applicants', 'applicant_first_name', $first_name, 'applicant_id', $user_id) )
            {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
            
        } else {
            array_push($shouldContinue, true);
        }

        if( !empty($last_name) && $last_name !== $userInfo['applicant_last_name'] )
        {
            if ( updateItem('applicants', 'applicant_last_name', $last_name, 'applicant_id', $user_id)  )
            {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
            
        } else {
            array_push($shouldContinue, true);
        }

        if( !empty($phone_number) && $phone_number !== $userInfo['applicant_phone_number'] )
        {
            if ( updateItem('applicants', 'applicant_phone_number', $phone_number, 'applicant_id', $user_id)  )
            {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
            
        } else {
            array_push($shouldContinue, true);
        }

        if( !empty($resume_url) && $resume_url !== $userInfo['applicant_resume_url'] )
        {
            if ( updateItem('applicants', 'applicant_resume_url', $resume_url, 'applicant_id', $user_id)  )
            {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
            
        } else {
            array_push($shouldContinue, true);
        }

        if( !empty($email) && $email !== $userInfo['applicant_email'] )
        {
            if ( updateItem('users', 'email', $email, 'id', $user_id) )
            {
                array_push($shouldContinue, true);
            } else {
                array_push($shouldContinue, false);
            }
            
        } else {
            array_push($shouldContinue, true);
        }

        // Check if all update operations were successful
        $allTrue = array_reduce($shouldContinue, function ($carry, $item) {
            return $carry && $item;
        }, true);

        // Redirect based on the success of update operations
        if ($allTrue) {
            http_response_code(200);
            $response = array(
                "status" => 200,
                "message" => 'Updated Successfully',
            );
            echo json_encode($response);
            exit;
        } else {
            http_response_code(400);
            $response = array(
                "status" => 400,
                "message" => 'An Error Occured',
            );
            echo json_encode($response);
            exit;
        }

    }

    if ( isset($requestData['password_info']) )
    {

        // Get user info for password change
        $paassword_from_db = fetchUserDetails('id',$_SESSION ['id'])['password'];

        $old_password_from_user = $requestData['old_pass'];
        $new_password_from_user = $requestData['new_pass'];
        $confirm_password_from_user = $requestData['con_pass'];

        if( empty($old_password_from_user) || empty($new_password_from_user) || empty($confirm_password_from_user) )
        {
            http_response_code(200);
            $response = array(
                "status" => 403,
                "message" => 'Empty Feilds',
            );
            echo json_encode($response);
            exit;
        }

        // Validate old password    

        if ( ! password_verify( $old_password_from_user , $paassword_from_db ) )
        {
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'Your Old Password is not correct',
            );
            echo json_encode($response);
            exit;
        }

        if ( ! hash_equals( $new_password_from_user, $confirm_password_from_user ) )
        {
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'Your New Passwords do not match',
            );
            echo json_encode($response);
            exit;
        }

        $new_password_from_user = password_hash($new_password_from_user, PASSWORD_DEFAULT);

        // Update new password in database
        if (!updateItem('users','password',$new_password_from_user,'id',$_SESSION['id']))
        {
            http_response_code(200);
            $response = array(
                "status" => 403,
                "message" => 'An Error Occured',
            );
            echo json_encode($response);
            exit;
        }

        http_response_code(200);
        $response = array(
            "status" => 200,
            "message" => ' Password Updated Successfully',
        );
        echo json_encode($response);
        exit;
    }

    http_response_code(200);
    $response = array(
        "status" => 400,
        "message" => 'UNKOWN ERROR',
    );
    echo json_encode($response);
    exit;
        
?>
