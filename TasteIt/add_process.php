<?php
require_once "db_conn.php"; // Include database connection

// Function to validate user inputs
function sanitizeInput($input) {
    return trim(htmlspecialchars($input));
}

// Function to validate password
function validatePassword($password) {
    return strlen($password) >= 8 && preg_match("/[a-z]/i", $password) && preg_match("/[0-9]/i", $password);
}

// Function to add employee
function addEmployee($conn, $fname, $lname, $position) {
    $sql_employee = "INSERT INTO employees_tb(employee_fname, employee_lname, employee_position) VALUES (?,?,?)";
    $stmt_employee = $conn->prepare($sql_employee);
    $stmt_employee->bind_param("sss", $fname, $lname, $position);
    
    if ($stmt_employee->execute()) {
        return $conn->insert_id; // Returns the last inserted id
    } else {
        return null;
    }
}

// Function to add login details
function addlogin($conn, $password, $uname, $employeeId) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    
    $sql_login = "INSERT INTO login_tb(login_name, login_password, employee_id) VALUES (?, ?, ?)";
    $stmt_login = $conn->prepare($sql_login);
    $stmt_login->bind_param("ssi", $uname, $passwordHash, $employeeId);
    
    return $stmt_login->execute();
}

if (isset($_POST["register"])) {
    $errors = array();
    $fname = sanitizeInput($_POST["fname"]);
    $lname = sanitizeInput($_POST["lname"]);
    $uname = sanitizeInput($_POST["uname"]);
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $position = sanitizeInput($_POST["position"]);

    // Validate inputs
    if (empty($uname) || empty($fname) || empty($lname) || empty($password) || empty($cpassword)) {
        $errors[] = "All fields are required!";
    } else {
        if (!validatePassword($password)) {
            $errors[] = "Password must be at least 8 characters long and contain a letter and a number!";
        }

        if ($password !== $cpassword) {
            $errors[] = "Passwords do not match!";
        }
    }

    // If no errors, attempt to add employee and login
    if (empty($errors)) {
        $employeeId = addEmployee($conn, $fname, $lname, $position);
        
        if ($employeeId !== null && addlogin($conn, $password, $uname, $employeeId)) {
            $_SESSION['success_register'] = "Employee added successfully!";
            // Clear the form data session variable after success
            unset($_SESSION['form_data']);
            // Redirect to the form page
            header("Location: users.php");
            exit();
        } else {
            $errors[] = "Something went wrong! Please try again.";
        }
    }

    // Store errors in the session if any
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;

    // Redirect back to the form page to display errors
    header("Location: users.php");
    exit();
}
