<?php
// Generate the last 7 days
$last7Days = [];
for ($i = 6; $i >= 0; $i--) {
    $last7Days[] = date('Y-m-d', strtotime("-$i days"));
}

// Initialize sales data array with 0 sales for each day
$salesDataWithDates = array_fill_keys($last7Days, 0);

// Update sales data with actual sales amounts
foreach ($salesData as $dataPoint) {
    $salesDataWithDates[$dataPoint['date']] = (float)$dataPoint['sales'];
}
?>

<!-- Load Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date');
        data.addColumn('number', 'Sales');

        <?php
        foreach ($salesDataWithDates as $date => $sales) {
            echo "data.addRow(['{$date}', {$sales}]);\n";
        }
        ?>

        var options = {
            title: 'Total Sales Over Last 7 Days',
            legend: { displayMode: 'none' },
            curveType: 'function',
            titleTextStyle: {
                color: '#000',
                fontSize: 18,
                bold: true,
                italic: false,
            },
            vAxis: {
                title: 'Sales Amount',
                minValue: 0
            },
            chartArea: {
                width: '70%',
                height: '70%',
            },
            backgroundColor: '#9fcbce',
            series: {
                0: {
                    color: 'red'
                }
            },
            gridlineColor: '#000',
            lineWidth: 2,
            vAxis: { viewWindow: { min: 0 } }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>