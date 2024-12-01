<?php
try {
    // Start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Include database connection
    include "db_conn.php";

    // Set default timezone
    date_default_timezone_set('Asia/Manila'); // Change to your desired timezone

    // Check if username is set and has the required position
    if (!isset($_SESSION['username'])) {
        header("Location: user_login.php");
        exit;
    }

    $active_page = 'sales';

    // Get periods from GET parameters or set defaults
    $graphPeriod = isset($_GET['graph_period']) ? $_GET['graph_period'] : 'week';
    $tablePeriod = isset($_GET['table_period']) ? $_GET['table_period'] : 'week';

    // Determine date range based on selected graph period
    $graphDateInterval = '';
    switch ($graphPeriod) {
        case 'month':
            $graphDateInterval = 'INTERVAL 30 DAY';
            break;
        case 'year':
            $graphDateInterval = 'INTERVAL 1 YEAR';
            break;
        case 'week':
        default:
            $graphDateInterval = 'INTERVAL 7 DAY';
            break;
    }

    // Determine date range based on selected table period
    $tableDateInterval = '';
    switch ($tablePeriod) {
        case 'month':
            $tableDateInterval = 'INTERVAL 30 DAY';
            break;
        case 'year':
            $tableDateInterval = 'INTERVAL 1 YEAR';
            break;
        case 'week':
        default:
            $tableDateInterval = 'INTERVAL 7 DAY';
            break;
    }

    // Calculate total sales per day for the selected graph period
    $sql = "
        SELECT DATE(transactiondetails_tb.transaction_date) AS sale_date, 
        SUM(transaction_totalprice) AS total_sales 
        FROM transactiondetails_tb 
        WHERE transactiondetails_tb.transaction_date >= CURDATE() - $graphDateInterval 
        ORDER BY sale_date
    ";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $salesData = [];
    while ($row = $result->fetch_assoc()) {
        $salesData[] = [
            'date' => $row['sale_date'],
            'sales' => (float)$row['total_sales']
        ];
    }

    // Fetch total orders, average sales, and total sales for the selected table period
    $sql_data = "
        SELECT 
            COUNT(DISTINCT transactiondetails_tb.transaction_id) AS total_orders, 
            AVG(transactiondetails_tb.transaction_totalprice) AS avg_sales, 
            SUM(transactiondetails_tb.transaction_totalprice) AS total_sales 
        FROM transactiondetails_tb 
        WHERE transactiondetails_tb.transaction_date >= CURDATE() - $graphDateInterval
    ";
    $data_result = $conn->query($sql_data);

    if (!$data_result) {
        die("Query failed: " . $conn->error);
    }

    $data = $data_result->fetch_assoc();
    $totalOrders = $data['total_orders'];
    $avgSales = number_format($data['avg_sales'], 2);
    $totalSales = number_format($data['total_sales'], 2);

    // Fetch transaction details for the selected table period
    $sql_table = "
        SELECT
            DATE_FORMAT(transactiondetails_tb.transaction_date, '%Y-%m-%d %H:%i:%s') AS transaction_date,
            transactiondetails_tb.transaction_id AS transaction_id,
            transactiondetails_tb.transaction_totalprice AS total_sales 
        FROM transactiondetails_tb 
        WHERE transactiondetails_tb.transaction_date >= CURDATE() - $tableDateInterval
    ";

    $data_table = $conn->query($sql_table);

    if (!$data_table) {
        die("Query failed: " . $conn->error);
    }
} catch (Exception $e) {
    die('An unexpected error occurred: ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrivet - Sales</title>
    <style>
        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin-left: 10vh;
            margin-top: 2vh;
        }

        .boxes-container {
            display: flex;
            justify-content: center;
            gap: 100px;
            margin-top: 30px;
        }

        .box-text {
            width: 300px;
            height: 75px;
            background-color: #9fcbce;
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .box-text p {
            color: red;
            text-align: center;
            margin: 3px;
            padding: 0;
        }
    </style>

    <!-- Header -->
    <?php include("../Agrivet/header.php"); ?>
</head>

<body>
    <?php include("sidebar.php") ?>

    <div class="content-container">
        <!-- Graph Filter Form -->
        <div style="margin-bottom: 2rem;">
            <form method="GET" action="">
                <label for="graph_period">Select Graph Period:</label>
                <select name="graph_period" id="graph_period" onchange="this.form.submit()">
                    <option value="week" <?php echo (isset($_GET['graph_period']) && $_GET['graph_period'] == 'week') ? 'selected' : ''; ?>>Last 7 Days</option>
                    <option value="month" <?php echo (isset($_GET['graph_period']) && $_GET['graph_period'] == 'month') ? 'selected' : ''; ?>>Last 30 Days</option>
                    <option value="year" <?php echo (isset($_GET['graph_period']) && $_GET['graph_period'] == 'year') ? 'selected' : ''; ?>>Last 12 Months</option>
                </select>
            </form>
        </div>

        <!-- Graph -->
        <?php include("sales-graph.php") ?>
        <div id="chart_div" style="width: 1100px; height: 400px;"></div>

        <!-- Boxes container -->
        <div class="boxes-container">
            <div class="box-text">Total Orders: <p><?php echo $totalOrders; ?></p>
            </div>
            <div class="box-text">Avg Sales: <p><?php echo $avgSales; ?></p>
            </div>
            <div class="box-text">Total Sales: <p><?php echo $totalSales; ?></p>
            </div>
        </div>

        <!-- Transaction Table Filter Form -->
        <div style="margin-top: 2rem;">
            <form method="GET" action="">
                <label for="table_period">Select Table Period:</label>
                <select name="table_period" id="table_period" onchange="this.form.submit()">
                    <option value="week" <?php echo (isset($_GET['table_period']) && $_GET['table_period'] == 'week') ? 'selected' : ''; ?>>Last 7 Days</option>
                    <option value="month" <?php echo (isset($_GET['table_period']) && $_GET['table_period'] == 'month') ? 'selected' : ''; ?>>Last 30 Days</option>
                    <option value="year" <?php echo (isset($_GET['table_period']) && $_GET['table_period'] == 'year') ? 'selected' : ''; ?>>Last 12 Months</option>
                </select>
            </form>
        </div>

        <!-- Display transactions table -->
        <table class="table table-hover mt-4" style="max-width: 1107px;">
            <thead>
                <tr>
                    <th>Date</th>
                    <th class="text-center align-middle">Transaction #</th>
                    <th class="text-center align-middle">Transaction Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data_table->num_rows > 0) : ?>
                    <?php while ($row = $data_table->fetch_assoc()) : ?>
                        <tr>
                            <?php
                            // Fetch and format the transaction_date
                            $formattedDate = htmlspecialchars($row['transaction_date']);
                            ?>
                            <td><?php echo $formattedDate; ?></td>
                            <td class="text-center align-middle"><?php echo htmlspecialchars($row['transaction_id']); ?></td>
                            <td class="text-center align-middle">₱<?php echo number_format($row['total_sales'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No transactions found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>