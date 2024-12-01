<?php
// Generate date ranges based on selected period
function generateDateRanges($graphDateInterval) {
    $ranges = [];
    if ($graphDateInterval == 'week') {
        // Last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $ranges[] = date('Y-m-d', strtotime("-$i days"));
        }
    } elseif ($graphDateInterval== 'month') {
        // Last 4 weeks
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = date('Y-m-d', strtotime("last sunday -$i weeks"));
            $endOfWeek = date('Y-m-d', strtotime("next saturday -$i weeks"));
            $ranges[] = ['start' => $startOfWeek, 'end' => $endOfWeek];
        }
    } elseif ($graphDateInterval== 'year') {
        // Last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $month = date('F Y', strtotime("-$i months"));
            $ranges[] = $month;
        }
    }
    return $ranges;
}

// Get the selected period from GET parameters or set default
$graphPeriod = isset($_GET['graph_period']) ? $_GET['graph_period'] : 'week';

// Generate date ranges based on selected period
$dateRanges = generateDateRanges($graphPeriod);

// Initialize sales data array
$salesData = [];
if ($graphPeriod == 'week') {
    // Initialize sales data array with 0 sales for each day
    $salesData = array_fill_keys($dateRanges, 0);
} elseif ($graphPeriod == 'month') {
    // Initialize sales data array with 0 sales for each week
    foreach ($dateRanges as $range) {
        $salesData[$range['start'] . ' - ' . $range['end']] = 0;
    }
} elseif ($graphPeriod == 'year') {
    // Initialize sales data array with 0 sales for each month
    $salesData = array_fill_keys($dateRanges, 0);
}

// Fetch sales data from database based on selected period
$sql = "
    SELECT DATE(transactiondetails_tb.transaction_date) AS sale_date, 
    SUM(transaction_totalprice) AS total_sales
    FROM transactiondetails_tb 
    WHERE transactiondetails_tb.transaction_date >= CURDATE() - INTERVAL 1 $graphPeriod
    GROUP BY DATE(transactiondetails_tb.transaction_date)
    ORDER BY sale_date
";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    $date = $row['sale_date'];
    $sales = (float)$row['total_sales'];
    
    if ($graphPeriod == 'week') {
        $salesData[$date] = $sales;
    } elseif ($graphPeriod == 'month') {
        foreach ($dateRanges as $range) {
            if ($date >= $range['start'] && $date <= $range['end']) {
                $key = $range['start'] . ' - ' . $range['end'];
                $salesData[$key] += $sales;
                break;
            }
        }
    } elseif ($graphPeriod == 'year') {
        $month = date('F Y', strtotime($date));
        $salesData[$month] += $sales;
    }
}

$conn->close();
?>


<!-- Load Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Sales'],
            <?php
            foreach ($salesData as $date => $sales) {
                echo "['" . htmlspecialchars($date) . "', " . $sales . "],";
            }
            ?>
        ]);

        var options = {
            title: 'Sales over Time',
            curveType: 'function',
            legend: { displayMode: 'none' },
            backgroundColor: '#9fcbce',
            series: {
                0: {
                    color: 'red'
                }
            },
            gridlineColor: '#000',
            lineWidth: 2,
            vAxis: { viewWindow: { min: 0 } },
            titleTextStyle: {
                color: '#000',
                fontSize: 18,
                bold: true,
                italic: false,
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
