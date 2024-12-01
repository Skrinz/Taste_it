<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "db_conn.php";
// Prevent unauthorized access
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit;
}

// Retrieve and clear success messages from session
$success_add_transaction = isset($_SESSION['success_add_transaction']) ? $_SESSION['success_add_transaction'] : '';
unset($_SESSION['success_add_transaction']);

// For transaction processing
include "checkout-process.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agrivet - Cashier</title>
    <link rel="stylesheet" href="../Agrivet/css/cashier.css">
    <script src="https://kit.fontawesome.com/7c0a592bf5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Section -->
            <div class="col-8">

                <!-- Success notif -->
                <?php if (!empty($success_add_transaction)) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $success_add_transaction; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>


                <div class="searchInputContainer">
                    <input type="search" id="cashier-searchbar" placeholder="Search products..." value="">
                </div>
                <div class="searchResultContainer">
                    <div class="row" id="product-list">
                        <?php
                        $sql = "SELECT material_id, material_name, material_price FROM materials_tb WHERE material_status != 'Inactive'";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            echo '
                                <div class="col-4 product-item" data-id="' . $row['material_id'] . '" data-name="' . $row['material_name'] . '" data-price="' . $row['material_price'] . '">
                                    <div class="productResultContainer" data-bs-toggle="modal" data-bs-target="#quantityModal">
                                        <div class="productInfoContainer">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <p class="productName">' . $row['material_name'] . '</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p class="productPrice">₱' . $row['material_price'] . '</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-4 posOrderContainer">
                <div class="pos_header">
                    <div class="pos-header-content">
                        <div>
                            <p class="Cashier_logo">Agrivet</p>
                        </div>
                        <div>
                            <button class="pos_item_btn"><a href="logout.php">Logout</a></button>
                        </div>
                    </div>
                </div>
                <div class="pos_items_container">
                    <div class="pos_items">
                        <table class="table" id="pos_items_tbl">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="order-list">
                                <!-- Orders will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="item_total_container">
                        <p class="item_total">
                            <span class="item_total--label">Total</span>
                            <span class="item_total--value" id="total-amount">₱0.00</span>
                        </p>
                    </div>
                </div>
                <div class="checkoutBtnContainer">
                    <a href="javascript:void(0);" class="checkoutBtn" data-bs-toggle="modal" data-bs-target="#checkoutModal">CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Adding Products Modal -->
    <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quantityModalLabel">Enter Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="quantityForm">
                        <div class="mb-3">
                            <label for="productQuantity" class="form-label">Quantity</label>
                            <input type="number" step="0.01" class="form-control" id="productQuantity" min="0.01" required>
                            <input type="hidden" id="productId">
                            <input type="hidden" id="productName">
                            <input type="hidden" id="productPrice">
                        </div>
                        <button type="submit" class="btn btn-primary">Add to Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- POS checkout modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Checkout Options</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Display errors -->
                    <?php if (!empty($errors)) : ?>
                        <?php foreach ($errors as $error) : ?>
                            <div class='alert alert-danger'><?php echo $error; ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <form id="checkoutForm" method="post" action="checkout-process.php" novalidate>
                        <input type="hidden" name="orderList" id="orderListInput">
                        <div class="mb-3">
                            <label for="checkoutTotalPrice" class="form-label">Total Price</label>
                            <input type="number" name="transaction_totalprice" class="form-control" id="checkoutTotalPrice" readonly required>
                        </div>

                        <div class="mb-3">
                            <label for="amountPaid" class="form-label">Customer Paid</label>
                            <input type="number" class="form-control" name="amountPaid" id="amountPaid" min="0" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="changeAmount" class="form-label">Change Amount</label>
                            <input type="number" class="form-control" name="changeAmount" id="changeAmount" min="0" step="0.01" readonly>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="register-transaction">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="../Agrivet/js/cashier_script.js"></script>
</body>

</html>