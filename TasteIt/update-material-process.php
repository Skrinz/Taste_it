<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "db_conn.php";

// Handling form submission
if (isset($_POST['update'])) {
    $errors_update_material = array();
    $material_name = trim(htmlspecialchars($_POST['material_name']));
    $material_quantity = trim(htmlspecialchars($_POST['material_quantity']));

    // Basic validation
    if (empty($material_name) || empty($material_quantity)) {
        $errors_update_material[] = "All fields are required";
    }

    // If no errors_update_material, update material info
    if (empty($errors_update_material)) {
        $sql = "UPDATE materials_tb SET material_quantity = material_quantity + ? WHERE material_name = ?";
        $stmt_sql = $conn->prepare($sql);
        
        if ($stmt_sql === false) {
            $errors_update_material[] = "Prepare error: " . $conn->error;
        } else {
            $stmt_sql->bind_param("ss", $material_quantity, $material_name);

            if ($stmt_sql->execute()) {
                // Success message
                $_SESSION['success_update'] = "Material updated successfully";
                unset($_SESSION['form_data']);
            } else {
                $errors_update_material[] = "Execute error: " . $stmt_sql->error;
            }
        }
    }

    // Store errors_update_material in the session if any
    if (!empty($errors_update_material)) {
        $_SESSION['errors_update_material'] = $errors_update_material;
        $_SESSION['form_data'] = $_POST;
        $_SESSION['modal_to_show'] = 'updatematerial'; // Set the modal ID to show upon returning to the form page
    }

    // Redirect back to inventory.php
    header("Location: inventory.php");
    exit();
}
?>