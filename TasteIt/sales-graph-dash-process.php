<?php
// Calculate total sales per day for the last 7 days
include ("db_conn.php");
$sql = "
    SELECT DATE(transactiondetails_tb.transaction_date) AS sale_date, 
    SUM(transaction_totalprice) AS total_sales
    FROM transactiondetails_tb 
    WHERE transactiondetails_tb.transaction_date >= CURDATE() - INTERVAL 7 DAY
    GROUP BY DATE(transactiondetails_tb.transaction_date)
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
        'sales' => (float)$row['total_sales'] // Ensure this is a float
    ];
}
?>
