<?php
require('db_conn.php');
// Retrieve form data from session if there were errors_update_material
$errors_update_material = isset($_SESSION['errors_update_material']) ? $_SESSION['errors_update_material'] : array();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
unset($_SESSION['errors_update_material']); // Clear errors_update_material after retrieving
unset($_SESSION['form_data']); // Clear form data after retrieving
?>

<!-- Modal -->
<div class="modal fade <?php echo !empty($errors_update_material) ? 'show' : ''; ?>" id="updatematerial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="<?php echo !empty($errors_update_material) ? 'display:block;' : ''; ?>">
    <div class="modal-dialog" style="margin-top:23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Material</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="update-material-process.php" novalidate>
                    <!-- Display errors_update_material -->
                    <?php if (!empty($errors_update_material)) : ?>
                        <?php foreach ($errors_update_material as $error) : ?>
                            <div class='alert alert-danger'><?php echo $error; ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <!-- Input new material data -->
                    <div class="mb-3">
                        <select class="form-select" name="material_name" id="update-material-name" aria-label="Default select example" title="Name of the material" required>
                            <option value="" disabled selected>Material Name</option>
                            <?php
                            $sql_name = "SELECT material_name FROM materials_tb WHERE 1=1 ORDER BY material_name ASC";
                            $result_name = $conn->query($sql_name);
                            while ($row = $result_name->fetch_assoc()) {
                                echo "<option value='" . $row['material_name'] . "'>" . $row['material_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="material_quantity" id="update-material-quantity" placeholder="Quantity to add" value="<?php echo htmlspecialchars($form_data['material_quantity'] ?? ''); ?>" title="Quantity of material to add" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" style="color:white;" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" style="color:white;" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Show modal if there are errors_update_material
    $(document).ready(function() {
        var modalToShow = '<?php echo isset($_SESSION['modal_to_show']) ? $_SESSION['modal_to_show'] : ''; ?>';

        if (modalToShow) {
            var myModal = new bootstrap.Modal(document.getElementById(modalToShow));
            myModal.show();

            // Optionally, clear the session variable after showing the modal
            <?php unset($_SESSION['modal_to_show']); ?>
        }
    });
</script>