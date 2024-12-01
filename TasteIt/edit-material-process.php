<?php
// Include database connection
require "db_conn.php";

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    // Sanitize and validate inputs
    $material_id = $_POST['material_id'];
    $material_name = trim($_POST['material_name']);
    $material_price = trim($_POST['material_price']);
    $material_quantity = trim($_POST['material_quantity']);
    $lowstock_indicator = $_POST['lowstock_indicator'];
    $date_restocked = $_POST['date_restocked'];
    $material_status = $_POST['material_status'];

    if (empty($material_name) || empty($material_price) || empty($material_quantity) || empty($lowstock_indicator) || empty($date_restocked)) {
        $errors[] = "All fields are required";
    }

    // Validate product price to ensure it has no more than two decimal places
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $material_price)) {
        $errors[] = "Material price must not have more than two decimal places.";
    }

    try {
        // Prepare SQL statement to update material information
        $stmt = $conn->prepare("UPDATE materials_tb SET material_name = ?, material_price = ?, material_quantity = ?, lowstock_indicator = ?, date_restocked = ?, material_status = ? WHERE material_id = ?");
        $stmt->execute([$material_name, $material_price, $material_quantity, $lowstock_indicator, $date_restocked, $material_status, $material_id]);

        $_SESSION['success_edit'] = "Material information updated successfully";
        header("Location: inventory.php");
        exit();
    } catch (PDOException $e) {
        $errors[] = "Error updating material: " . $e->getMessage();
    }
}
?>