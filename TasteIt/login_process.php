<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "db_conn.php"; // Include database connection

// Function to sanitize user inputs
function sanitize($input) {
    global $conn; // Access the global connection variable
    return htmlspecialchars(mysqli_real_escape_string($conn, $input));
}

if(isset($_POST["login"])){
    $errors = array();
    // Sanitize user inputs
    $username = sanitize($_POST['uname']);
    $password = sanitize($_POST['password']);

    // Check if all fields are filled
    if(empty($username) || empty($password)){
        $errors[] = "All fields are required!";
    }

    if(empty($errors)) {
        // Prepare and execute SQL query using prepared statements
        $stmt = $conn->prepare("SELECT login_tb.*, employees_tb.employee_position FROM login_tb
                                 INNER JOIN employees_tb ON login_tb.employee_id = employees_tb.employee_id
                                 WHERE login_tb.login_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            if(password_verify($password, $user['login_password'])){
                $_SESSION['username'] = $username;
    
                // Assign the position for redirecting
                $position = $user['employee_position'];
                $_SESSION['position'] = $position;
    
                if ($position == "Owner") {
                    header("Location: index.php");
                    exit();
                } elseif ($position == "Employee") {
                    header("Location: cashier.php");
                    exit();
                } else {
                    $errors[] = "Unknown position: " . $position;
                }
            } else {
                $errors[] = "Incorrect Password!";
            }
        } else {
            $errors[] = "Account doesn't exist!";
        }
    }
}
?>
