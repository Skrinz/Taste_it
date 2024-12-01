<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "db_conn.php"; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $materialId = $_POST['materialid-delete'];

    // Initialize errors array
    $errors = array();

    // Check if material ID is valid
    if (!empty($materialId)) {
        try {
            // Create a new PDO instance
            $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
            // Set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Begin transaction
            $conn->beginTransaction();

            // Delete from materials_tb
            $stmt1 = $conn->prepare("DELETE FROM materials_tb WHERE material_id = ?");
            $stmt1->execute([$materialId]);

            // Commit transaction
            $conn->commit();
            // Set success message in session
            $_SESSION['material_delete'] = "Material deleted successfully!";
            // Redirect to the previous page after processing
            header("Location: inventory.php");
            exit();
        } catch (PDOException $e) {
            // Rollback transaction if there is an error
            $conn->rollBack();
            $_SESSION['errors'][] = 'Database error: ' . $e->getMessage();
        }
        // Close the database connection
        $conn = null;
    } else {
        // If material ID is empty, add error message to session
        $_SESSION['errors'][] = 'Invalid material ID';
    }
}
?>
