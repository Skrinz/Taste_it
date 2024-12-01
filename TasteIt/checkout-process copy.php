<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "db_conn.php";

// Handling form submission
if (isset($_POST['register-transaction'])) {
    $errors = array();
    $transaction_totalprice = trim(htmlspecialchars($_POST['transaction_totalprice']));

    // Basic validation
    if (empty($transaction_totalprice)) {
        $errors[] = "All fields are required";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $sql = "INSERT INTO transactiondetails_tb (transaction_totalprice) VALUES (?)";
        $stmt_sql = $conn->prepare($sql);
        
        if ($stmt_sql === false) {
            $errors[] = "Prepare error: " . $conn->error;
        } else {
            $stmt_sql->bind_param("s", $transaction_totalprice);

            if ($stmt_sql->execute()) {
                // Success message
                $_SESSION['success_add_transaction'] = "Transaction added successfully";
                unset($_SESSION['form_data']);
            } else {
                $errors[] = "Execute error: " . $stmt_sql->error;
            }
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