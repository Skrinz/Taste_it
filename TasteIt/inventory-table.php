<div>
    <div>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th>Materials</th>
                    <th class="text-center align-middle">Price</th>
                    <th class="text-center align-middle">Current Stock</th>
                    <th class="text-center align-middle">Stock Status</th>
                    <th class="text-center align-middle">Date Restocked</th>
                    <th class="text-center align-middle">Active Status</th>
                    <th class="text-center align-middle">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $search_query = "";

                // Check if a search query is set
                if (isset($_GET['inv-searchbar']) && !empty($_GET['inv-searchbar'])) {
                    $search_query = $_GET['inv-searchbar'];
                }

                // Construct SQL query
                $sql = "SELECT materials_tb.*
                        FROM materials_tb 
                        WHERE 1=1"; // Start with a true condition to append filters

                if (!empty($search_query)) {
                    // Add search query filter
                    $sql .= " AND material_name LIKE '%$search_query%'";
                }

                $sql .= " ORDER BY material_quantity ASC";

                // Execute SQL query
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $stock_status = $row['material_quantity'] <= $row['lowstock_indicator'] ? "LOW" : "";
                    $statusClass = $row['material_status'] === 'Active' ? 'active-status' : 'inactive-status';
                    echo "
                <tr>
                    <td>" . $row['material_name'] . "</td>
                    <td class='text-center align-middle'>₱" . $row['material_price'] . "</td>
                    <td class='text-center align-middle'>" . $row['material_quantity'] . "</td>
                    <td class='text-center align-middle lowstock-indicator-text'>" . $stock_status;
                    if ($stock_status == "LOW") {
                        echo " [" . $row['lowstock_indicator'] . "]";
                    }
                    echo "</td>
                    <td class='text-center align-middle'>" . $row['date_restocked'] . "</td>
                    <td class='text-center align-middle " . $statusClass . "'>" . $row['material_status'] . "</td>
                    <td class='text-center align-middle'>
                        <button class='action-btn' data-bs-toggle='modal' data-bs-target='#editmaterial'
                            data-materialid='" . $row['material_id'] . "'
                            data-materialname='" . $row['material_name'] . "'
                            data-materialprice='" . $row['material_price'] . "'
                            data-materialquantity='" . $row['material_quantity'] . "'
                            data-lowstockindicator='" . $row['lowstock_indicator'] . "'
                            data-daterestocked='" . $row['date_restocked'] . "'
                            data-materialstatus='" . $row['material_status'] . "'
                            >
                            <img src='../Agrivet/img/edit.png' alt='Edit' width='30px' height='30px' title='Edit material'>
                        </button>
                        <button class='action-btn' data-bs-toggle='modal' data-bs-target='#deletematerial'
                            data-materialid='" . $row['material_id'] . "'
                            data-materialname='" . $row['material_name'] . "'
                            >
                            <img src='../Agrivet/img/delete.png' alt='Delete' title='Delete material' width='30px' height='30px'>
                        </button>
                    </td>
                </tr>
                ";
                }
                ?>

            </tbody>
        </table>
    </div>
</div>