<!-- Modal for Deleting Employee -->
<div class="modal fade" id="deleteemployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalTitle">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="margin-top: 2rem; margin-bottom: 2rem;">Are you sure you want to delete employee:<br>
                    <span id="employeeName" style="color: red;"></span>
                </div>
            </div>
            <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="employee_id" id="deleteEmployeeId" value="">
                    <button type="button" class="btn btn-danger" style="color: white;" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" style="color: white;" name="confirm">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to handle deletion confirmation
    $(document).ready(function() {
        // Triggered when delete button is clicked
        $('.action-btn').on('click', function() {
            var employeeId = $(this).data('id'); // Get employee_id from data-id attribute
            var employeeFname = $(this).data('fname'); // Get employee_fname from data-fname attribute
            var employeeLname = $(this).data('lname'); // Get employee_lname from data-lname attribute
            
            // Set employee_id in the modal form
            $('#deleteEmployeeId').val(employeeId);
            
            // Set employee name in the modal title
            $('#employeeName').text(employeeFname + ' ' + employeeLname);
        });
    });
</script>
