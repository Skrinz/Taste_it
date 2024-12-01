<?php
include "db_conn.php"; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    echo $_POST['employee_id'];
    $employeeId = $_POST['employee_id'];

    // Check if employee ID is valid
    if (!empty($employeeId)) {
        try {
            // Create a new PDO instance
            $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Begin transaction
            $conn->beginTransaction();

            // Delete from login_tb
            $stmt1 = $conn->prepare("DELETE FROM login_tb WHERE employee_id = ?");
            $stmt1->execute([$employeeId]);

            // Delete from employees_tb
            $stmt2 = $conn->prepare("DELETE FROM employees_tb WHERE employee_id = ?");
            $stmt2->execute([$employeeId]);

            // Commit transaction
            $conn->commit();

            // Set success message in session
            $_SESSION['success_delete'] = "Employee deleted successfully!";
            unset($_SESSION['errors']);
            // Redirect to the previous page after processing
            header("Location:users.php");
            exit();
        } catch (PDOException $e) {
            // Rollback transaction if there is an error
            $conn->rollBack();
            $_SESSION['errors'][] = 'Database error: ' . $e->getMessage();
        }
        // Close the database connection
        $conn = null;
    } else {
        // If employee ID is empty, add error message to session
        $_SESSION['errors'][] = 'Invalid employee ID';
    } 
}
?>
