<?php
    session_start();

    include("db.php");
    include("../../functions.php");

if ($_SERVER["REQUEST_METHOD"] === "POST")
{

    // echo var_dump($_COOKIE['registration_status']);

    function createUser() {
        include("db.php");
        
        $requestData = json_decode(file_get_contents('php://input'), true);

        $email = $requestData['email'];
        $password = $requestData['pass'];
        $confirm_password = $requestData['c_pass'];

        $role = $requestData['role'];

        if(!empty($email) && !empty($role) && !empty($password) &&!empty($confirm_password))
        {

            $user_email = fetchUserDetails('email', $email);

            if ( $user_email !== false )
            {
                http_response_code(200);
                $response = array(
                    "status" => 400,
                    "message" => 'Another User exist with this email Address',
                );
                echo json_encode($response);
                exit;
            }


            if ( !hash_equals($password, $confirm_password) )
            {
                http_response_code(200);
                $response = array(
                    "status" => 400,
                    "message" => 'passwords do not match',
                );
                echo json_encode($response);
                exit;
            }

            $id = generateRandomStrings(20, 'USER_ID_');
            $password = password_hash($password,  PASSWORD_DEFAULT);


            $query = "INSERT INTO users (email, password, id, role) VALUES(?, ?, ?, ?)";

            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $email, $password, $id, $role);

            if (mysqli_stmt_execute($stmt) )
            {

                if( ! checkIfLoggedIn() && fetchUserDetails('id', $id) !== false )
                {
                    loginUser($id, $email);
                }

                $_SESSION['registration_continue'] = $role;
                setcookie('registration_status', 1, 0, '/');
                setcookie('registration_id', $id, 0, '/');
                
                http_response_code(200);
                $response = array(
                    "status" => 200,
                    "message" => 'Your Account Has Successfully Been Created, Kindly Wait for the next step.',
                );
                echo json_encode($response);
                exit;

            }
            else
            {
                http_response_code(200);
                $response = array(
                    "status" => 400,
                    "message" => 'Registraion Failed. Please Try Again.',
                );
                echo json_encode($response);
                exit;

            }
            
        }
        else
        {
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'Empty Feild',
            );
            echo json_encode($response);
            exit;
        }

    }

    function createApplicant()
    {
        include("db.php");

        $requestData = json_decode(file_get_contents('php://input'), true);

        $firstname = $requestData['fname'];
        $lastname = $requestData['lname'];
        $telephone = $requestData['tel'];

        $skills  = $requestData['skills'];

        $education_history = $requestData['education'];

        $resume_url = $requestData['resume_url'];

        if( empty($firstname) || empty($lastname) || empty($telephone) || empty($skills) || empty($education_history) || empty($resume_url) )
        {
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'Empty Feilds',
            );
            echo json_encode($response);
            exit;
        }


        $user_id = $_SESSION['id'];

        $user_email = fetchUserDetails('id', $user_id)['email'];

        $query = "INSERT INTO  applicants (applicant_first_name, applicant_last_name, applicant_email, applicant_phone_number, applicant_skills, applicant_education_history,  applicant_id, applicant_resume_url) VALUES (?,?,?,?,?, ?, ?,?)";
        
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssss", $firstname, $lastname, $user_email, $telephone, $skills, $education_history, $user_id, $resume_url);


        if (mysqli_stmt_execute($stmt) )
        {

            // session_start();
            unset($_SESSION['registration_continue']);
            setcookie('registration_status', '', time() - 3600, '/');
            setcookie('registration_id', '', time() - 3600, '/');

            http_response_code(200);
            $response = array(
                "status" => 200,
                "message" => 'Your Information Has Been Created Sucessfully.',
            );
            echo json_encode($response);
            exit;

        }
        else
        {
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'Error Creating Your Work Account..',
            );
            echo json_encode($response);
            exit;
        }

    }

    function createEmployeer() {
        
        include("db.php");

        $requestData = json_decode(file_get_contents('php://input'), true);


        $employeer_name = $requestData['emp_name'];
        // $employeer_company_email = $requestData['emp_email'];
        $employeer_company_name = $requestData['emp_comp_name'];
        $employeer_company_feild = $requestData['emp_feild'];
        $employeer_company_location = $requestData['emp_location'];

        $id = $requestData['id'];

        if ( empty($employeer_name) || empty($employeer_company_name) || empty($employeer_company_feild) || empty($employeer_company_location)   )
        {
            http_response_code(200);
            $response = array(
                "status" => 400,
                "message" => 'Empty Fields',
            );
            echo json_encode($response);
            exit;
        }

        $user_id = $id;

        $user_email = fetchUserDetails('id', $user_id)['email'];

        $query = "INSERT INTO employers (employer_name, company_name, employer_email, employer_feild, employer_id) VALUES (?,?,?,?,?) ";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $employeer_name, $employeer_company_name, $user_email, $employeer_company_feild, $user_id );

        if ( mysqli_stmt_execute($stmt) )
        {
            unset($_SESSION['registration_continue']);
            setcookie('registration_status', "", time() - 3600, '/');

            http_response_code(200);
            $response = array(
                "status" => 200,
                "message" => 'Your Information Has Been Created Sucessfully. Welcome to FindWork',
            );
            echo json_encode($response);
            exit;
        }

    }

    if ( !isset($_COOKIE['registration_status'])  )
    {
        createUser();
    }

    if ( isset($_COOKIE['registration_status']) && ! empty( $_COOKIE['registration_status'] ) && $_COOKIE['registration_status'] === '1' && $_SESSION['registration_continue'] === 'client'  )
    {
        createApplicant();
    }

    if ( isset($_COOKIE['registration_status']) && ! empty( $_COOKIE['registration_status'] ) && $_COOKIE['registration_status'] === '1' && $_SESSION['registration_continue'] === 'employeer'  )
    {
        createEmployeer();
    }

    

}

?>