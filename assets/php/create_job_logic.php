<?php 
    session_start();

    include("db.php");
    include("../../functions.php");
?>

<?php 

    if ($_SERVER["REQUEST_METHOD"] !== "POST")
    {
        echo "INCORRECT METHOD";
        exit;
    }

    $title = $_POST['job_title'];
    $description = $_POST['job_description'];
    $skills = $_POST['job_skills'];
    $location = $_POST['job_location'];
    $salary = $_POST['job_salary'];
    $endDate = $_POST['job_end_date'];
    $endDate = new DateTime($endDate);
    $endDate = $endDate->format('Y-m-d h:i:s');

    // echo $title . ' ' . $description . ' ' . $skills . ' ' .$location . ' ' . $salary  . ' ' . $endDate;

    // exit;

    if ( empty($title) || empty($description) || empty($skills) || empty($location) || empty($salary) || empty($endDate) )
    {
        echo 'EMPTY FEILDS';
        exit;
    }

    $job_id = generateRandomStrings(15, 'JB-ID-');
    $user_id = $_SESSION['id'];

    $query = "INSERT INTO jobs (job_title, job_description, job_skills, job_location, job_salary, job_id, job_author_id, job_end_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $title, $description, $skills, $location, $salary, $job_id, $user_id, $endDate);

    if ( mysqli_stmt_execute($stmt) )
    {
        header('Location: ../../create_job.php?code=201&message=sucessfully_created');
        exit;
    }
    else
    {
        echo "ERROR";
        exit;
    }


?>