<div class="sidebar">
    <ul class="sidebar-list">
        <a href="../Agrivet/index.php"><li id="dashboardside" <?php if ($active_page == 'dashboard') echo 'class="active"'; ?>>Dashboard</li></a>
        <a href="../Agrivet/users.php"><li id="userside" <?php if ($active_page == 'users') echo 'class="active"'; ?>>Users</li></a>
        <a href="../Agrivet/inventory.php"><li id="inventoryside" <?php if ($active_page == 'inventory') echo 'class="active"'; ?>>Inventory</li></a>
        <a href="../Agrivet/sales.php"><li id="saleside" <?php if ($active_page == 'sales') echo 'class="active"'; ?>>Sales</li></a>

        <a href="logout.php"><li class="logout-btn" style="margin-top: 45vh; color:#ff5757; font-weight: 800;">Logout</li></a>
    </ul>
</div>
