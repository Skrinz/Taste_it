<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Prevent unauthorized access
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit;
}
$active_page = 'users';
include "db_conn.php"; // Include database connection

// Include the add, edit, and delete processing scripts
include("add_process.php");
include("delete_process.php");
include("edit_process.php");

// Retrieve and clear success messages from session
$success_register = isset($_SESSION['success_register']) ? $_SESSION['success_register'] : '';
unset($_SESSION['success_register']);
$success_delete = isset($_SESSION['success_delete']) ? $_SESSION['success_delete'] : '';
unset($_SESSION['success_delete']);
$success_edit = isset($_SESSION['success_edit']) ? $_SESSION['success_edit'] : '';
unset($_SESSION['success_edit']);

// Check if Clear Filter button is clicked
if (isset($_GET['clear-filter'])) {
    // Reset filter variables
    unset($_GET['user-search']);
    unset($_GET['position_filter']);
    unset($_GET['status_filter']);
}

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Initialize the base query
    $query = "SELECT employees_tb.*, login_tb.login_name
              FROM employees_tb
              LEFT JOIN login_tb ON employees_tb.employee_id = login_tb.employee_id
              WHERE 1=1";

    // Initialize parameters array
    $params = [];

    // Check for search term
    if (isset($_GET['user-search']) && !empty($_GET['user-search'])) {
        $searchTerm = $_GET['user-search'];
        $query .= " AND employees_tb.employee_lname LIKE :searchTerm";
        $params[':searchTerm'] = '%' . $searchTerm . '%';
    }

    // Apply filters
    $statusFilter = isset($_GET['status_filter']) ? $_GET['status_filter'] : '';
    $positionFilter = isset($_GET['position_filter']) ? $_GET['position_filter'] : '';

    if (!empty($statusFilter)) {
        $query .= " AND employees_tb.employee_status = :statusFilter";
        $params[':statusFilter'] = $statusFilter;
    }
    if (!empty($positionFilter)) {
        $query .= " AND employees_tb.employee_position = :positionFilter";
        $params[':positionFilter'] = $positionFilter;
    }

    // Prepare and execute the statement
    $stmt = $conn->prepare($query);

    // Bind parameters
    foreach ($params as $key => &$val) {
        $stmt->bindParam($key, $val);
    }

    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $records = []; // Ensure $records is defined as an empty array in case of error
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agrivet - Users</title>
    <!-- Header -->
    <?php include("../Agrivet/header.php") ?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include("../Agrivet/sidebar.php") ?>
    <div style="margin-top: 1.5rem; margin-left:20rem; margin-right: 5rem;">
        <!-- Display success message -->
        <?php if (!empty($success_register)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_register; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (!empty($success_delete)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_delete; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (!empty($success_edit)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_edit; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php include("user_add.php");?>
        <div style="display: flex; justify-content: space-between; align-items: center;">
                <!-- Add employee button -->
                <div>
                    <button type="button" class="btn" style="background-color: #00bf63; color:white;" data-bs-toggle="modal" data-bs-target="#addemployee">
                        Add user
                    </button>
                </div>

            <!-- Filter Form -->
            <div>
                <form action="" method="get">
                    <select name="position_filter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc; background-color:#d17fb2; color:white;">
                        <option value="" <?php echo $positionFilter == ''?'selected' : '';?>>All Positions</option>
                        <option value="Owner" <?php echo $positionFilter == 'Owner'?'selected' : '';?>>Owner</option>
                        <option value="Employee" <?php echo $positionFilter == 'Employee'?'selected' : '';?>>Employee</option>
                    </select>
                    <select name="status_filter" style="padding: 8px; border-radius: 5px; border: 1px solid #ccc; background-color:#d17fb2; color:white;">
                        <option value="" <?php echo $statusFilter == ''?'selected' : '';?>>All Statuses</option>
                        <option value="Active" <?php echo $statusFilter == 'Active'?'selected' : '';?>>Active</option>
                        <option value="Inactive" <?php echo $statusFilter == 'Inactive'?'selected' : '';?>>Inactive</option>
                    </select>
                    <button type="submit" name="apply_filters" style="background-color: #007bff; color: white; padding: 8px; border: none; border-radius: 5px; margin-left:7rem;">Apply Filters</button>
                    <button type="submit" name="clear-filter" style="background-color: #dc3545; color: white; padding: 8px; border: none; border-radius: 5px;">Clear Filters</button>
                </form>
            </div>

                <!-- Search Form -->
                <div>
                    <form action="" method="get">
                        <div style="display: flex;">
                            <input type="search" name="user-search" id="user-search" placeholder="Search By Last Name" value="<?php echo isset($_GET['user-search'])? $_GET['user-search'] : ''; ?>">
                            <input type="submit" class="user-search-submitbtn" value="&#x1F50D;">
                        </div>
                    </form>
                </div>
        </div>

        <!-- Display employees table -->
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th>Login name</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include("user_delete.php");
                include("user_edit.php");
                ?>
                <?php if (!empty($records)): ?>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($record['login_name']); ?></td>
                            <td><?php echo htmlspecialchars($record['employee_lname']); ?></td>
                            <td><?php echo htmlspecialchars($record['employee_fname']); ?></td>
                            <td><?php echo htmlspecialchars($record['employee_position']); ?></td>
                            <td style="<?php echo htmlspecialchars($record['employee_status']) === 'Active' ? 'color:#00bf63; font-weight: bold' : 'color:#ff5757; font-weight: bold'; ?>">
                                <?php echo htmlspecialchars($record['employee_status']); ?>
                            </td>
                            <td>
                                <button type="button" class='action-btn' data-bs-toggle="modal" data-bs-target="#editemployee"
                                    data-id="<?php echo htmlspecialchars($record['employee_id']); ?>"
                                    data-uname="<?php echo htmlspecialchars($record['login_name']); ?>"
                                    data-lname="<?php echo htmlspecialchars($record['employee_lname']); ?>"
                                    data-fname="<?php echo htmlspecialchars($record['employee_fname']); ?>"
                                    data-position="<?php echo htmlspecialchars($record['employee_position']); ?>"
                                    data-status="<?php echo htmlspecialchars($record['employee_status']); ?>">
                                    <img src='../Agrivet/img/edit.png' alt='Edit' width='30px' height='30px' title='Edit employee'>
                                </button>
                                <button type="button" class='action-btn' data-bs-toggle="modal" data-bs-target="#deleteemployee"
                                    data-id="<?php echo htmlspecialchars($record['employee_id']); ?>"
                                    data-lname="<?php echo htmlspecialchars($record['employee_lname']); ?>"
                                    data-fname="<?php echo htmlspecialchars($record['employee_fname']); ?>">
                                    <img src='../Agrivet/img/delete.png' alt='Delete' title='Delete product' width='30px' height='30px'>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
