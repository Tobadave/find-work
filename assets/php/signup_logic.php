<?php
    session_start();

    include("db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $email = $_POST['email'];
    // $firstname = $_POST['fname'];
    // $lastname = $_POST['lname'];
    $password = $_POST['pass'];
    $password2 = $_POST['pass2'];

    // echo $email . "<br>";
    // echo $firstname . "<br>";
    // echo $lastname . "<br>";
    // echo $telephone . "<br>";
    // echo $password . "<br>";

    // exit;

    if(!empty($email) && !empty($password) && !empty($password2) && !is_numeric($email))
    {
        // INSERT INTO `login_form` (`id`, `mail`, `fname`, `lname`, `tel`, `pass`) VALUES (NULL, '', '', '', '', '')
        $query = "INSERT INTO login_form (mail, pass, pass2) VALUES('$email','$firstname','$lastname','$telephone','$password')";

        if ( mysqli_query($con, $query) )
        {
            // echo "<script type='text/javascript'> alert('Sucessfully Register')</script>";

            header("Location: ../../login.php");

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

?>