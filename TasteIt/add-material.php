<?php
require('db_conn.php');
// Retrieve form data from session if there were errors
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
unset($_SESSION['errors']); // Clear errors after retrieving
unset($_SESSION['form_data']); // Clear form data after retrieving
?>

<!-- Modal -->
<div class="modal fade <?php echo !empty($errors) ? 'show' : ''; ?>" id="addmaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="<?php echo !empty($errors) ? 'display:block;' : ''; ?>">
    <div class="modal-dialog" style="margin-top:23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Material</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="add-material-process.php" novalidate>
                    <!-- Display errors -->
                    <?php if (!empty($errors)) : ?>
                        <?php foreach ($errors as $error) : ?>
                            <div class='alert alert-danger'><?php echo $error; ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <!-- Input new material data -->
                    <div class="mb-3">
                        <input type="text" class="form-control" name="material_name" placeholder="Material Name" value="<?php echo htmlspecialchars($form_data['material_name'] ?? ''); ?>" title="Name of material" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="material_price" placeholder="0.00" step="0.01" value="<?php echo htmlspecialchars($form_data['material_price'] ?? ''); ?>" title="Material selling price" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="material_quantity" placeholder="Current Stock" value="<?php echo htmlspecialchars($form_data['material_quantity'] ?? ''); ?>" title="Quantity of material" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="lowstock_indicator" placeholder="Lowstock Indicator" value="<?php echo htmlspecialchars($form_data['lowstock_indicator'] ?? ''); ?>" title="Lowstock Indicator" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="date_restocked" id="date_restocked" placeholder="Date Restocked" value="<?php echo htmlspecialchars($form_data['date_restocked'] ?? ''); ?>" title="Date material was restocked" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" style="color:white;" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" style="color:white;" name="register-material">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Show modal if there are errors
    $(document).ready(function() {
        var modalToShow = '<?php echo isset($_SESSION['modal_to_show']) ? $_SESSION['modal_to_show'] : ''; ?>';

        if (modalToShow) {
            var myModal = new bootstrap.Modal(document.getElementById(modalToShow));
            myModal.show();

            // Optionally, clear the session variable after showing the modal
            <?php unset($_SESSION['modal_to_show']); ?>
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        let productPriceInput = document.querySelector('#addmaterial input[name="material_price"]');

        productPriceInput.addEventListener('blur', function(e) {
            let value = parseFloat(this.value);
            if (!isNaN(value)) {
                this.value = value.toFixed(2);
            } else {
                this.value = '';
            }
        });
    });
</script>