<?php
include "db_conn.php"; 
?>

<!-- Modal -->
<div class="modal fade" id="editemployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top:23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        
            <div class="modal-body">
                <form method="post" novalidate>
                    <!-- Display errors -->
                    <?php if (!empty($errors)): ?>
                        <?php foreach($errors as $error): ?>
                            <div class='alert alert-danger'><?php echo $error; ?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Input credentials -->
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="employee_id" id="edit-employee-id" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="uname" id="edit-uname" placeholder="Username login" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="fname" id="edit-fname" placeholder="Enter employee first name" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="lname" id="edit-lname" placeholder="Enter employee last name" required>
                    </div>
                    
                    <select class="form-select mb-3" name="position" id="edit-position" aria-label="Default select example" required>
                        <option selected value="Employee">Employee</option>
                        <option value="Owner">Owner</option>
                    </select>

                    <select class="form-select mb-3" name="status" id="edit-status" aria-label="Default select example" required>
                        <?php
                        $statuses = ["Active", "Inactive"];
                        foreach ($statuses as $status) {
                            echo "<option value='" . htmlspecialchars($status) . "'>" . htmlspecialchars($status) . "</option>";
                        }
                        ?>
                    </select>
                    
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
document.addEventListener('DOMContentLoaded', function () {
    let editemployeeModal = document.getElementById('editemployee');
    editemployeeModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        let button = event.relatedTarget;

        // Extract info from data-* attributes
        let id = button.getAttribute('data-id');
        let lname = button.getAttribute('data-lname');
        let fname = button.getAttribute('data-fname');
        let position = button.getAttribute('data-position');
        let status = button.getAttribute('data-status'); 

        // Update the modal's content
        let modalTitle = editemployeeModal.querySelector('.modal-title');
        modalTitle.textContent = 'Edit ' + fname + ' ' + lname;

        let employeeIdInput = editemployeeModal.querySelector('#edit-employee-id');
        let unameInput = editemployeeModal.querySelector('#edit-uname');
        let fnameInput = editemployeeModal.querySelector('#edit-fname');
        let lnameInput = editemployeeModal.querySelector('#edit-lname');
        let positionInput = editemployeeModal.querySelector('#edit-position');
        let statusInput = editemployeeModal.querySelector('#edit-status');

        employeeIdInput.value = id;
        unameInput.value = button.getAttribute('data-uname');
        fnameInput.value = fname;
        lnameInput.value = lname;
        positionInput.value = position;
        statusInput.value = status;
    });
});
</script>
