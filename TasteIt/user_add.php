<?php
include "db_conn.php"; 
// Retrieve errors and form data from session
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
unset($_SESSION['errors']); // Clear errors after retrieving
unset($_SESSION['form_data']); // Clear form data after retrieving
?>

<!-- Modal -->
<div class="modal fade <?php echo !empty($errors) ? 'show' : ''; ?>" id="addemployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="<?php echo !empty($errors) ? 'display:block;' : ''; ?>">
    <div class="modal-dialog" style="margin-top:23vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
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
                        <input type="text" class="form-control" name="uname" placeholder="Username login" value="<?php echo htmlspecialchars($form_data['uname'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="fname" placeholder="Enter employee first name" value="<?php echo htmlspecialchars($form_data['fname'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" name="lname" placeholder="Enter employee last name" value="<?php echo htmlspecialchars($form_data['lname'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3 input_container">
                        <input type="password" class="form-control" name="password" placeholder="Enter your password" id="password" required>
                        <img src="img/eye-off-svgrepo-com.svg" id="eyeicon">
                    </div>

                    <div class="mb-3 input_container">
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm password" id="cpassword" required>
                        <img src="img/eye-off-svgrepo-com.svg" id="ceyeicon">
                    </div>
                    
                    <select class="form-select mb-3" name="position" aria-label="Default select example" required>
                        <option value="Employee" <?php echo (isset($form_data['position']) && $form_data['position'] == 'Employee') ? 'selected' : ''; ?>>Employee</option>
                        <option value="Owner" <?php echo (isset($form_data['position']) && $form_data['position'] == 'Owner') ? 'selected' : ''; ?>>Owner</option>
                    </select>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" style="color:white;" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" style="color:white;" name="register">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Automatically show the modal if there are errors
    $(document).ready(function() {
        if ($('.modal.show').length > 0) {
            var myModal = new bootstrap.Modal(document.getElementById('addemployee'));
            myModal.show();
        }
    });

    // Javascript for the show and hide of the password
    let eyeicon = document.getElementById("eyeicon");
    let password = document.getElementById("password");
    let ceyeicon = document.getElementById("ceyeicon");
    let cpassword = document.getElementById("cpassword");

    eyeicon.onclick = function() {
        if (password.type == "password") {
            password.type = "text";
            eyeicon.src = "img/eye-svgrepo-com.svg";
        } else {
            password.type = "password";
            eyeicon.src = "img/eye-off-svgrepo-com.svg";
        }
    }

    ceyeicon.onclick = function() {
        if (cpassword.type == "password") {
            cpassword.type = "text";
            ceyeicon.src = "img/eye-svgrepo-com.svg";
        } else {
            cpassword.type = "password";
            ceyeicon.src = "img/eye-off-svgrepo-com.svg";
        }
    }
</script>
