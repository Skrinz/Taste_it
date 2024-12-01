<?php   
// Include database connection
include "db_conn.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    // Sanitize and validate inputs
    $employee_id = $_POST['employee_id'];
    $uname = trim($_POST['uname']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $position = $_POST['position'];
    $status = $_POST['status'];

        try {
            // Prepare SQL statement to update employee information
            $stmt = $conn->prepare("UPDATE employees_tb SET employee_fname = ?, employee_lname = ?, employee_position = ?, employee_status = ? WHERE employee_id = ?");
            $stmt->execute([$fname, $lname, $position, $status, $employee_id]);

            // Retrieve the updated username
            $stmt_username = $conn->prepare("UPDATE login_tb SET login_name = ? WHERE employee_id = ?");
            $stmt_username->execute([$uname, $employee_id]);

            $_SESSION['success_edit'] = "Employee information updated successfully";
            header("Location:users.php");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Error updating employee: " . $e->getMessage();
        }
}
?>