<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "db_conn.php";

// Function to sanitize and validate user inputs
function sanitizeInput($input) {
    return trim(htmlspecialchars($input));
}

// Handling form submission
if (isset($_POST['register-material'])) {
    $errors = array();
    $material_name = sanitizeInput($_POST['material_name']);
    $material_price = sanitizeInput($_POST['material_price']);
    $material_quantity = sanitizeInput($_POST['material_quantity']);
    $lowstock_indicator = sanitizeInput($_POST['lowstock_indicator']);
    $date_restocked = sanitizeInput($_POST['date_restocked']);

    // Basic validation
    if (empty($material_name) || empty($material_price) || empty($material_quantity) || empty($lowstock_indicator) || empty($date_restocked)) {
        $errors[] = "All fields are required";
    }

    // Validate product price to ensure it has no more than two decimal places
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $material_price)) {
        $errors[] = "Material price must not have more than two decimal places.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $sql = "INSERT INTO materials_tb (material_name, material_price, material_quantity, lowstock_indicator, date_restocked) VALUES (?,?,?,?,?)";
        $stmt_sql = $conn->prepare($sql);
        
        if ($stmt_sql === false) {
            $errors[] = "Prepare error: " . $conn->error;
        } else {
            $stmt_sql->bind_param("sssss", $material_name, $material_price, $material_quantity, $lowstock_indicator, $date_restocked);

            if ($stmt_sql->execute()) {
                // Success message
                $_SESSION['sad_material'] = "Material added successfully";
                unset($_SESSION['form_data']);
            } else {
                $errors[] = "Execute error: " . $stmt_sql->error;
            }
        }
    }

    // Store errors in the session if any
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST;
        $_SESSION['modal_to_show'] = 'addmaterial'; // Set the modal ID to show upon returning to the form page
    }

    // Redirect back to inventory.php
    header("Location: inventory.php");
    exit();
}
?>