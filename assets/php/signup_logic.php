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
            setcookie('registration_status', 2, 0, '/');

            header("Location: ../../jobposting.php" );
            exit;

        }

    }

//    session_get_cookie_params();
    
    if ( !isset($_COOKIE['registration_status'])  )
    {
        createUser();
    }

    if ( isset($_COOKIE['registration_status']) && ! empty( $_COOKIE['registration_status'] ) && $_COOKIE['registration_status'] === '1'   )
    {
        // || $_COOKIE['registration_status'] === 2
        createApplicant();
        // echo "Create Applicant";
    }

    

}

?>