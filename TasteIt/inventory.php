<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$active_page = 'inventory';
include "db_conn.php";

//prevent unauthorized access
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit;
}

// Check if Clear Filter button is clicked
if (isset($_GET['clear-filter'])) {
    // Reset filter variables
    unset($_GET['inv-searchbar']);
}

// Retrieve and clear success messages from session
$success_add = isset($_SESSION['sad_material']) ? $_SESSION['sad_material'] : '';
unset($_SESSION['sad_material']);

$material_delete = isset($_SESSION['material_delete']) ? $_SESSION['material_delete'] : '';
unset($_SESSION['material_delete']);

$success_edit = isset($_SESSION['success_edit']) ? $_SESSION['success_edit'] : '';
unset($_SESSION['success_edit']);

$success_update = isset($_SESSION['success_update']) ? $_SESSION['success_update'] : '';
unset($_SESSION['success_update']);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agrivet - Products</title>
    <!-- Header -->
    <?php include "header.php"; ?>
</head>

<body id="inventory-dashboard">
    <!-- SideBar -->
    <?php include "sidebar.php"; ?>

    <div id="inventory-container">
        <!-- Display success/error message -->
        <?php if (!empty($success_add)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_add; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (!empty($material_delete)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $material_delete; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (!empty($success_edit)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_edit; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (!empty($success_update)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success_update; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div id="inv-header-btns">
            <div id="inv-header-leftside">
                <div id="add-material-container">
                    <!-- Button to trigger Add Material modal -->
                    <button type="button" class="inv-btn" id="add-material-btn" data-bs-toggle="modal" data-bs-target="#addmaterial">Add Material</button>
                </div>
                <div id="add-material-container">
                    <!-- Button to trigger Update Material modal -->
                    <button type="button" class="inv-btn" id="update-material-btn" data-bs-toggle="modal" data-bs-target="#updatematerial">Update Material</button>
                </div>
            </div>
            <div id="inv-searchbar-container">
                <div style="margin-right: 10px;">
                    <form action="">
                        <!-- Clear Filter button -->
                        <button class="inv-btn" id="inv-clear-filter" type="submit" name="clear-filter">Clear Filter</button>
                    </form>
                </div>
                <!-- Inventory search bar -->
                <form action="" method="get">
                    <input type="search" name="inv-searchbar" id="inv-searchbar" placeholder="Search Materials" value="<?php echo isset($_GET['inv-searchbar']) ? $_GET['inv-searchbar'] : ''; ?>">
                    <input type="submit" class="inv-searchbar-submitbtn" value="&#x1F50D;">
                </form>
            </div>
        </div>

        <?php
        // Inventory Tables
        include "inventory-table.php";
        ?>
    </div>

    <!-- Scripts -->
    <script src="../Agrivet/js/script.js"></script>

    <?php
    // for adding materials
    include "add-material.php";
    include "add-material-process.php";

    // for editing materials
    include "edit-material.php";
    include "edit-material-process.php";

    // for deleting materials
    include "delete-material.php";
    include "delete-material-process.php";

    // for updating materials
    include "update-material.php";
    include "update-material-process.php";

    ob_end_flush();
    ?>
</body>

</html>