<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "db_conn.php";

// Handling form submission
if (isset($_POST['register-transaction'])) {
    $errors = array();
    $transaction_totalprice = trim(htmlspecialchars($_POST['transaction_totalprice']));
    $orderList = json_decode($_POST['orderList'], true);

    // Basic validation
    if (empty($transaction_totalprice) || empty($orderList)) {
        $errors[] = "All fields are required";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        // Begin a transaction
        $conn->begin_transaction();

        try {
            $sql = "INSERT INTO transactiondetails_tb (transaction_totalprice) VALUES (?)";
            $stmt_sql = $conn->prepare($sql);
            
            if ($stmt_sql === false) {
                throw new Exception("Prepare error: " . $conn->error);
            }

            $stmt_sql->bind_param("s", $transaction_totalprice);

            if (!$stmt_sql->execute()) {
                throw new Exception("Execute error: " . $stmt_sql->error);
            }

            $transaction_id = $stmt_sql->insert_id;

            foreach ($orderList as $orderItem) {
                $material_id = $orderItem['id'];
                $quantity = $orderItem['quantity'];

                echo $material_id;

                // Update the inventory
                $update_sql = "UPDATE materials_tb SET material_quantity = material_quantity - ? WHERE material_id = ?";
                $update_stmt = $conn->prepare($update_sql);

                if ($update_stmt === false) {
                    throw new Exception("Prepare error: " . $conn->error);
                }

                $update_stmt->bind_param("di", $quantity, $material_id);

                if (!$update_stmt->execute()) {
                    throw new Exception("Execute error: " . $update_stmt->error);
                }
            }

            // Commit the transaction
            $conn->commit();

            // Success message
            $_SESSION['success_add_transaction'] = "Transaction added successfully";
            unset($_SESSION['form_data']);
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $conn->rollback();
            $errors[] = $e->getMessage();
        }
    }

    // Store errors in the session if any
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['form_data'] = $_POST; // Preserve form data for repopulation
    }

    header("Location: cashier.php");
    exit();
}
?>