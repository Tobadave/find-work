<?php 
    // Start the session
    session_start();

    // Include the database connection file and necessary functions
    include("db.php");
    include("../../functions.php");
?>

<?php 
    // Check if the request method is not POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST")
    {
        // Display an error message and exit if the method is not POST
        http_response_code(403);
        $response = array(
            "status" => 403,
            "message" => 'Incorrect Method',
        );
        echo json_encode($response);
        exit;
    }

    $requestData = json_decode(file_get_contents('php://input'), true);

    $title = $requestData['job_title'];
    $description = $requestData['job_description'];
    $skills = $requestData['job_skills'];
    $location = $requestData['job_location'];
    $salary = $requestData['job_salary'];
    $endDate = $requestData['job_end_date'];

    // Convert the end date to a DateTime object and format it
    $endDate = new DateTime($endDate);
    $endDate = $endDate->format('Y-m-d h:i:s');

    // Check if any required fields are empty
    if ( empty($title) || empty($description) || empty($skills) || empty($location) || empty($salary) || empty($endDate) )
    {
        // Display an error message and exit if any required fields are empty
        http_response_code(200);
        $response = array(
            "status" => 400,
            "message" => 'Empty Fields',
        );
        echo json_encode($response);
        exit;
    }

    // Generate a random job ID and get the user ID from the session
    $job_id = generateRandomStrings(15, 'JB-ID-');
    $user_id = $_SESSION['id'];

    // Prepare and execute the SQL query to insert a new job into the database
    $query = "INSERT INTO jobs (job_title, job_description, job_skills, job_location, job_salary, job_id, job_author_id, job_end_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $title, $description, $skills, $location, $salary, $job_id, $user_id, $endDate);

    // Check if the query execution was successful
    if ( mysqli_stmt_execute($stmt) )
    {
        http_response_code(200);
        $response = array(
            "status" => 200,
            "message" => 'Job Created',
        );
        echo json_encode($response);
        exit;
    }
    else
    {
        http_response_code(200);
        $response = array(
            "status" => 400,
            "message" => 'Error Creating Job.',
        );
        echo json_encode($response);
        exit;
    }
?>
