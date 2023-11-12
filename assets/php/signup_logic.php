<?php
    session_start();

    include("db.php");
    include("../../functions.php");

if ($_SERVER["REQUEST_METHOD"] === "POST")
{

    // echo var_dump($_COOKIE['registration_status']);

    function createUser() {
        include("db.php");
        
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $confirm_password = $_POST['c_pass'];

        $role = $_POST['role'];

        if(!empty($email) && !empty($role) && !empty($password) &&!empty($confirm_password))
        {

            $user_email = fetchUserDetails('email', $email);

            if ( $user_email !== false )
            {
                echo "Another User exist with this email Address";
                exit;
            }


            if ( !hash_equals($password, $confirm_password) )
            {
                echo "<script type='text/javascript'> alert('password is nto valid')</script>";
                header("Location: ../../signup.php");
                exit;
            }

            $id = generateRandomStrings(20, 'USER_ID_');
            $password = password_hash($password,  PASSWORD_DEFAULT);


            $query = "INSERT INTO users (email, password, id, role) VALUES(?, ?, ?, ?)";

            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $email, $password, $id, $role);

            // if ( mysqli_query($con, $query) )
            if (mysqli_stmt_execute($stmt) )
            {
                // echo "<script type='text/javascript'> alert('Sucessfully Register')</script>";

                // echo "<h1>LOGIN PAGE</h1>";

                session_start();

                loginUser($id, $email);

                // $_COOKIE['registration_status'] = 1;
                $_SESSION['registration_continue'] = $role;
                setcookie('registration_status', 1, 0, '/');
                


                // session_set_cookie_params();

                header("Location: ../../signup_" . $role . "_page.php" );
                exit;

            }
            else
            {
                echo "<script type='text/javascript'> alert('not Registered')</script>";

            }
            
        }
        else
        {
            echo "<script type='text/javascript'> alert('Please Enter some valid Information')</script>";
        }

    }

    function createApplicant()
    {
        include("db.php");

        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $telephone = $_POST['tel'];

        $skills  = $_POST['skills'];

        $education_history = $_POST['education'];

        $resume_url = $_POST['resume_url'];


        // echo $firstname . ' ' . $lastname . ' ' . $telephone . ' ' . $skills . ' ' . $education_history . ' ' . $resume_url;

        $user_id = $_SESSION['id'];

        $user_email = fetchUserDetails('id', $user_id)['email'];

        $query = "INSERT INTO  applicants (applicant_first_name, applicant_last_name, applicant_email, applicant_phone_number, applicant_skills, applicant_education_history,  applicant_id, applicant_resume_url) VALUES (?,?,?,?,?, ?, ?,?)";
        
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssss", $firstname, $lastname, $user_email, $telephone, $skills, $education_history, $user_id, $resume_url);


        if (mysqli_stmt_execute($stmt) )
        {

            session_start();
            unset($_SESSION['registration_continue']);
            setcookie('registration_status', '', time() - 3600, '/');

            header("Location: ../../dashboard.php" );
            exit;

        }

    }

    function createEmployeer() {
        
        include("db.php");

        $employeer_name = $_POST['emp_name'];
        // $employeer_company_email = $_POST['emp_email'];
        $employeer_company_name = $_POST['emp_comp_name'];
        $employeer_company_feild = $_POST['emp_feild'];
        $employeer_company_location = $_POST['emp_location'];

        if ( empty($employeer_name) || empty($employeer_company_name) || empty($employeer_company_feild) || empty($employeer_company_location)   )
        {
            echo "EMPTY FEILDS";
            exit;
        }

        $user_id = $_SESSION['id'];

        $user_email = fetchUserDetails('id', $user_id)['email'];

        $query = "INSERT INTO employers (employer_name, company_name, employer_email, employer_feild, employer_id) VALUES (?,?,?,?,?) ";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $employeer_name, $employeer_company_name, $user_email, $employeer_company_feild, $user_id );

        if ( mysqli_stmt_execute($stmt) )
        {
            session_start();
            unset($_SESSION['registration_continue']);
            setcookie('registration_status', "", time() - 3600, '/');

            header("Location: ../../dashboard.php" );
            exit;
        }

    }

//    session_get_cookie_params();
    
    if ( !isset($_COOKIE['registration_status'])  )
    {
        createUser();
    }

    if ( isset($_COOKIE['registration_status']) && ! empty( $_COOKIE['registration_status'] ) && $_COOKIE['registration_status'] === '1' && $_SESSION['registration_continue'] === 'client'  )
    {
        // || $_COOKIE['registration_status'] === 2
        createApplicant();
        // echo "Create Applicant";
    }

    if ( isset($_COOKIE['registration_status']) && ! empty( $_COOKIE['registration_status'] ) && $_COOKIE['registration_status'] === '1' && $_SESSION['registration_continue'] === 'employeer'  )
    {
        // || $_COOKIE['registration_status'] === 2
        createEmployeer();
        // echo "Create Applicant";
    }

    

}

?>