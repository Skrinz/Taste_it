<?php
include "db_conn.php";
?>

<!-- Modal -->
<div class="modal fade" id="editmaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top:23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="post" novalidate>
                    <!-- Display errors -->
                    <?php if (!empty($errors)) : ?>
                        <?php foreach ($errors as $error) : ?>
                            <div class='alert alert-danger'><?php echo $error; ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Input new material data -->
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="material_id" id="edit-material-id" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="material_name" id="edit-material-name" placeholder="Material Name" value="<?php echo htmlspecialchars($form_data['material_name'] ?? ''); ?>" title="Name of material" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="material_price" id="edit-material-price" placeholder="0.00" step="0.01" value="<?php echo htmlspecialchars($form_data['material_price'] ?? ''); ?>" title="Material selling price" required>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" name="material_quantity" id="edit-material-quantity" placeholder="Current Stock" value="<?php echo htmlspecialchars($form_data['material_quantity'] ?? ''); ?>" title="Quantity of material" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="lowstock_indicator" id="edit-lowstock-indicator" placeholder="Lowstock Indicator" value="<?php echo htmlspecialchars($form_data['lowstock_indicator'] ?? ''); ?>" title="Lowstock Indicator" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="date_restocked" id="edit-date-restocked" placeholder="Date Restocked" value="<?php echo htmlspecialchars($form_data['date_restocked'] ?? ''); ?>" title="Date material was restocked" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="material_status" id="edit-status" aria-label="Default select example" title="Active status of the material" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" style="color:white;" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" style="color:white;" name="edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let editmaterialModal = document.getElementById('editmaterial');
        editmaterialModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            let button = event.relatedTarget;

            // Extract info from data-* attributes
            let materialid = button.getAttribute('data-materialid');
            let materialname = button.getAttribute('data-materialname');
            let materialprice = button.getAttribute('data-materialprice');
            let materialquantity = button.getAttribute('data-materialquantity');
            let lowstockindicator = button.getAttribute('data-lowstockindicator');
            let daterestocked = button.getAttribute('data-daterestocked');
            let materialstatus = button.getAttribute('data-materialstatus');

            // Update the modal's content
            let modalTitle = editmaterialModal.querySelector('.modal-title');
            modalTitle.textContent = 'Edit ' + materialname;

            let materialIdInput = editmaterialModal.querySelector('#edit-material-id');
            let materialNameInput = editmaterialModal.querySelector('#edit-material-name');
            let materialPriceInput = editmaterialModal.querySelector('#edit-material-price');
            let quantityInput = editmaterialModal.querySelector('#edit-material-quantity');
            let lowstockindicatorInput = editmaterialModal.querySelector('#edit-lowstock-indicator');
            let daterestockedInput = editmaterialModal.querySelector('#edit-date-restocked');
            let statusInput = editmaterialModal.querySelector('#edit-status');

            materialIdInput.value = materialid;
            materialNameInput.value = materialname;
            materialPriceInput.value = materialprice;
            quantityInput.value = materialquantity;
            lowstockindicatorInput.value = lowstockindicator;
            daterestockedInput.value = daterestocked;
            statusInput.value = materialstatus;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        let productPriceInput = document.querySelector('#editmaterial input[name="material_price"]');

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