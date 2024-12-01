<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//prevent unauthorized access
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit;
}
$active_page = 'dashboard';

include("sales-graph-dash-process.php");

?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agrivet - Dashboard</title>
    <!-- Header -->
    <?php include("../Agrivet/header.php") ?>
</head>

<body id="dashboard-body">
    <!-- SideBar -->
    <?php include("../Agrivet/sidebar.php"); ?>

    <!-- Dashboard Contents -->
    <div class="dashboard-container">
        <div class="dashboard-main-content">
            <?php
            date_default_timezone_set("Asia/Manila");

            $hour = date("H");

            if ($hour >= 0 && $hour < 12) {
                $greeting = "Good Morning, ";
            } elseif ($hour >= 12 && $hour <= 17) {
                $greeting = "Good Afternoon, ";
            } elseif ($hour >= 18 && $hour <= 23) {
                $greeting = "Good Evening, ";
            }
            ?>
            <h1><?php echo $greeting;
                echo htmlspecialchars($_SESSION['username']); ?>!</h1>

            <!-- Graph -->
            <?php include("sales-graph-dash.php") ?>
            <div id="chart_div" style="width: 1100px; height: 400px;"></div>

            <div class="dashboard-notifbar-container" style="margin-top:3vh; width:1100px !important;">
                <div class="dashboard-notif-header">
                    <h1>Low Stocks Notifications</h1>
                    <a href="../Agrivet/inventory.php" class="dashboard-view-all-button" title="View All notifications">View All</a>
                </div>

                <table class="dashboard-data-table">
                    <th>Material Name</th>
                    <th class="text-center align-middle">Status</th>
                    <?php
                    include "db_conn.php";

                    $sql_query = "SELECT materials_tb.material_name FROM materials_tb where material_quantity<=lowstock_indicator order by material_quantity asc LIMIT 3";
                    $result = $conn->query($sql_query);

                    while ($row = $result->fetch_assoc()) {
                        echo '
                            <tr class="dashboard-data-row">
                                <td class="dashboard-material-name">' . $row["material_name"] . '</td>
                                <td class="dashboard-material-lowstock text-center align-middle">LOW</td>
                            </tr>';
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    </div>

</body>

</html>