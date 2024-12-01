<!-- Filter Modal -->
<div class="modal fade" id="inv-filter-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top:23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Filter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="inv-modal-header-btns">
                    <!-- Search bar for filtering -->
                    <input type="text" id="inv-filter-searchbar" onkeyup="searchfilter()" placeholder="Search Filter">
                </div>
                <!-- Filter Modal content -->
                <div id="inv-filter-search-container">
                    <form method="get" novalidate>
                        <ul id="inv-filter-outer-ul">

                            <li class="list-group-item">
                                <input type="checkbox" id="all-branches-filter">
                                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#branchesCollapse" aria-expanded="true" aria-controls="branchesCollapse">Branches</button>
                                <div class="collapse hidden" id="branchesCollapse">
                                    <ul class="inv-filter-inner-ul">
                                        <?php
                                        require "db_conn.php";

                                        $sql_filter = "SELECT branch_id, branch_name FROM branch_tb WHERE branch_name!='All'";
                                        $result_filter = $conn->query($sql_filter);

                                        while ($row = $result_filter->fetch_assoc()) {
                                            $checked = isset($_GET['branch-filter-category']) && in_array($row['branch_id'], $_GET['branch-filter-category']) ? 'checked' : '';
                                            echo "<li><input type='checkbox' name='branch-filter-category[]' id='" . $row['branch_name'] . "' value='" . $row['branch_id'] . "' $checked><label for='" . $row['branch_name'] . "'>" . $row['branch_name'] . "</label></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <input type="checkbox" id="all-ingredients-filter">
                                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#ingredientsCollapse" aria-expanded="true" aria-controls="ingredientsCollapse">Ingredients</button>
                                <div class="collapse hidden" id="ingredientsCollapse">
                                    <ul class="inv-filter-inner-ul">
                                        <?php
                                        $categories = ['Dairy Products', 'Fruits', 'Vegetables'];
                                        foreach ($categories as $cat) {
                                            $checked = isset($_GET['filter-category']) && in_array($cat, $_GET['filter-category']) ? 'checked' : '';
                                            echo "<li><input type='checkbox' name='filter-category[]' id='" . strtolower($cat) . "-filter' value='" . $cat . "' $checked><label for='" . strtolower($cat) . "-filter'>" . $cat . "</label></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <input type="checkbox" id="all-tableware-filter">
                                <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#tablewareCollapse" aria-expanded="true" aria-controls="tablewareCollapse">Tableware</button>
                                <div class="collapse hidden" id="tablewareCollapse">
                                    <ul class="inv-filter-inner-ul">
                                        <?php
                                        $tableware = ['Cups', 'Plates', 'Utensils'];
                                        foreach ($tableware as $item) {
                                            $checked = isset($_GET['filter-category']) && in_array($item, $_GET['filter-category']) ? 'checked' : '';
                                            echo "<li><input type='checkbox' name='filter-category[]' id='" . strtolower($item) . "-filter' value='" . $item . "' $checked><label for='" . strtolower($item) . "-filter'>" . $item . "</label></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>

                        </ul>

                        <input class="inv-btn btn btn-success" style="float: right;" type="submit" value="Apply Filter">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>