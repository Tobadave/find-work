<?php


    include("assets/php/db.php");


?>

<?php


/**
 * Redirects to the specified URL.
 *
 * @param string $url The URL to which the redirection should occur.
 * @return bool False if the URL is empty, indicating that the redirection cannot be performed; true otherwise.
 */
function redirect($url)
{
    /** Check if the provided URL is empty */
    if (empty($url))
    {
        /** If the URL is empty, print an error message */
        echo "URL CANNOT BE EMPTY";

        /** Return false to indicate that the redirection cannot be performed */
        return false;
    }

    /** If the URL is not empty, use the 'header' function to perform a redirection */
    header("Location: $url");

    /** Return true to indicate that the redirection was successful */
    return true;
}




/**
 * Checks if a user is logged in.
 *
 * @return bool Returns true if the user is logged in (session variables 'id', 'name', and 'session' are set), otherwise returns false.
 */
function checkIfLoggedIn()
{
    /** Check if the session variables 'id', 'name', and 'session' are set */
    if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['session']))
    {
        /** Return true if all session variables are set, indicating that the user is logged in */
        return true;
    }

    /** Return false if any of the required session variables is not set, indicating that the user is not logged in */
    return false;
}

/**
 * Checks if a user is logged in and redirects to the specified URL if logged in.
 *
 * @param string $url The URL to which the redirection should occur if the user is logged in.
 */
function checkIfLoggedInAndRedirect($url)
{
    /** Check if the user is logged in by calling the checkIfLoggedIn function */
    if (checkIfLoggedIn() === true)
    {
        /** If the user is logged in, perform a redirection to the specified URL */
        redirect($url);
    }
}


/**
 * Checks if a user is not logged in and redirects to the specified URL if not logged in.
 *
 * @param string $url The URL to which the redirection should occur if the user is not logged in.
 */
function checkIfNotLoggedInAndRedirect($url)
{
    /** Check if the user is not logged in by negating the result of the checkIfLoggedIn function */
    if (checkIfLoggedIn() === false)
    {
        /** If the user is not logged in, perform a redirection to the specified URL */
        redirect($url);
    }
}

/**
 * Logs in a user by setting session variables for user ID, user name, and session.
 *
 * @param int    $user_id   The ID of the user to be logged in.
 * @param string $user_name The name of the user to be logged in.
 * @return bool Returns true after successfully logging in the user.
 */
function loginUser($user_id, $user_name)
{
    /** Check if the session variables 'id', 'name', and 'session' are already set */
    if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['session']))
    {
        /** If already logged in, log out the user before logging in again */
        logoutUser();
    }

    /** Set session variables for the user ID, user name, and generate a random session string */
    $_SESSION['id'] = $user_id;
    $_SESSION['name'] = $user_name;
    $_SESSION['session'] = generateRandomStrings(30, 'SSID_');

    /** Return true to indicate a successful login */
    return true;
}

/**
 * Logs out the current user by unsetting session variables for user ID, user name, and session.
 *
 * @return bool Returns true after successfully logging out the user.
 */
function logoutUser()
{
    /** Check if the session variables 'id', 'name', and 'session' are set */
    if (isset($_SESSION['id']) && isset($_SESSION['name']) && isset($_SESSION['session']))
    {
        /** Unset (remove) the session variables for user ID, user name, and session */
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['session']);
    }

    /** Return true to indicate a successful logout */
    return true;
}

/**
 * Gets the current page URL.
 *
 * @return string Returns the current page URL including the protocol, host, and URI.
 */
function getCurrentPageURL()
{
    /** Determine the protocol based on whether HTTPS is on or not */
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

    /** Get the host (domain) from the server environment variables */
    $host = $_SERVER['HTTP_HOST'];

    /** Get the URI (Uniform Resource Identifier) from the server environment variables */
    $uri = $_SERVER['REQUEST_URI'];

    /** Combine the protocol, host, and URI to form the complete URL */
    $url = $protocol . $host . $uri;

    /** Return the complete URL */
    return $url;
}


/**
 * Fetches all users from the 'login_form' table in the database.
 *
 * @param mysqli $con The MySQLi connection object.
 * @return array Returns an associative array containing user information if users are found, otherwise, prints an error message and exits.
 */
function fetchAllUsers($con)
{
    /** SQL query to select all users from the 'login_form' table */
    $query = "SELECT * FROM users";

    /** Prepare the SQL query using MySQLi prepared statement */
    $stmt = mysqli_prepare($con, $query);

    /** Execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /** Get the result set from the executed statement */
    $results = mysqli_stmt_get_result($stmt);

    /** Check if any users are found in the database */
    if (mysqli_num_rows($results) === 0)
    {
        /** Print an error message if no users are found and exit the script */
        echo "NO USER FOUND IN DATABASE";
        exit;
    }

    /** Fetch the first row of the result set as an associative array */
    $results = mysqli_fetch_assoc($results);

    /** Return the associative array containing user information */
    return $results;
}

/**
 * Fetches user details from the specified table based on a given column and value.
 *
 * @param string $columnName The name of the column to search for.
 * @param mixed  $value      The value to search for in the specified column.
 * @param string $table_name The name of the table from which to fetch user details (default: "users").
 * @return array|false Returns an associative array containing user details if a user is found, otherwise, returns false.
 */
function fetchUserDetails($columnName = 'mail', $value, string $table_name = "users")
{
    /** Include the database connection file */
    include("assets/php/db.php");

    /** SQL query to select user details from the specified table based on the given column and value */
    $query = "SELECT * FROM $table_name WHERE $columnName=?";

    /** Prepare the SQL query using MySQLi prepared statement */
    $stmt = mysqli_prepare($con, $query);

    /** Bind the parameter to the prepared statement */
    mysqli_stmt_bind_param($stmt, "s", $value);

    /** Execute the prepared statement */
    mysqli_stmt_execute($stmt);

    /** Get the result set from the executed statement */
    $results = mysqli_stmt_get_result($stmt);

    /** Check if exactly one user is found in the database */
    if (mysqli_num_rows($results) !== 1)
    {
        /** Return false if no user or more than one user is found */
        return false;
    }

    /** Fetch the user details as an associative array */
    $results = mysqli_fetch_assoc($results);

    /** Return the associative array containing user details */
    return $results;
}

/**
 * Updates a specific column in a row of a table with a new value based on the given conditions.
 *
 * @param string $table_name The name of the table to update.
 * @param string $columnName The name of the column to update.
 * @param string $value      The new value to set in the specified column.
 * @param string $idName     The name of the column used for the condition.
 * @param string $idValue    The value in the condition column to identify the row to update.
 * @return bool Returns true if the update is successful, otherwise returns false.
 */
function updateItem(string $table_name, string $columnName, string $value, $idName, string $idValue)
{
    /** Include the database connection file */
    include("assets/php/db.php");
    
    /** SQL query to update a specific column in a row based on the given conditions */
    $query = "UPDATE `$table_name` SET `$columnName` = ? WHERE `$table_name`.`$idName` = ?";

    /** Prepare the SQL query using MySQLi prepared statement */
    $stmt = mysqli_prepare($con, $query);

    /** Bind the parameters to the prepared statement */
    mysqli_stmt_bind_param($stmt, "ss", $value, $idValue);

    /** Execute the prepared statement and check if the update is successful */
    if (mysqli_stmt_execute($stmt))
    {
        /** Return true if the update is successful */
        return true;
    }

    /** Return false if the update is not successful */
    return false;
}

/**
 * Loads the error page with the specified title, message, and status code.
 *
 * @param string $title   The title of the error page.
 * @param string $message The error message to display on the error page.
 * @param int    $code    The HTTP status code associated with the error (default: 500).
 */
function loadErrorPage($title, $message, $code = 500)
{
    /** Generate a random integer and store it in a session variable for error page identification */
    $_SESSION['error_page_'] = random_int(1, 100);

    /** Store the error title, message, and code in session variables for use on the error page */
    $_SESSION['error_page_title'] = $title;
    $_SESSION['error_page_message'] = $message;
    $_SESSION['error_page_code'] = $code;

    /** Include the error page file to display the error content */
    include_once 'error.php';

    /** Note: Uncomment the line below if you want to redirect to the error page instead of including it */
    // header('Location: error.php?returnURL=' . getCurrentPageURL());
}

/**
 * Generates a random string with the specified length, prefix, and suffix.
 *
 * @param int          $length The length of the random string (default: 40).
 * @param string|int   $prefix The prefix to prepend to the random string.
 * @param string|int   $suffix The suffix to append to the random string.
 * @return string Returns the generated random string.
 */
function generateRandomStrings(int $length = 40, string|int $prefix = '', string|int $suffix = ''): string
{
    /** If the length is set to 0, use the default length of 40 */
    if ($length === 0)
    {
        $length = 40;
    }

    /** Define the characters from which the random string will be generated */
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTWXYZ";

    /** Initialize the generated text variable */
    $generatedText = '';

    /** Generate the random string based on the provided options (prefix, suffix) */
    if (!empty($prefix))
    {
        $generatedText = $prefix . substr(str_shuffle($chars), 0, $length);
    }
    elseif (!empty($suffix))
    {
        $generatedText = substr(str_shuffle($chars), 0, $length) . $suffix;
    }
    else
    {
        $generatedText = substr(str_shuffle($chars), 0, $length);
    }

    /** Return the generated random string */
    return $generatedText;
}


?>