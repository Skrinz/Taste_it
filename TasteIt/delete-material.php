<!-- Modal for Deleting Material -->
<div class="modal fade" id="deletematerial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalTitle">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="margin-top: 2rem; margin-bottom: 2rem;">Are you sure you want to delete material:<br>
                    <span id="material-name-tobe-deleted" style="color: red;"></span>
                </div>
            </div>
            <div class="modal-footer">
                <form method="post" action="delete-material-process.php">
                    <input type="hidden" name="materialid-delete" id="materialid-delete" value="">
                    <button type="button" class="btn btn-danger" style="color: white;" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success" style="color: white;" name="confirm">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Triggered when a delete button is clicked
        $('[data-bs-toggle="modal"]').on('click', function() {
            var materialId = $(this).data('materialid');
            var materialName = $(this).data('materialname');

            // Set material ID in the modal form
            $('#materialid-delete').val(materialId);

            // Set material name in the modal body
            $('#material-name-tobe-deleted').text(materialName);
        });
    });
</script>