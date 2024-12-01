<?php
include("login_process.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrivet - Login</title>
    <!-- Header -->
    <?php include("../Agrivet/header.php") ?>
</head>

<body style="background-color: #9fcbce !important;">
    <div class="overlay"></div>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">

        <form class="border shadow p-3 rounded bg-white" style="width: 450px;" method="post">
            <h2 class="text-center p-3">LOGIN</h2>

            <!-- display errors -->
            <?php if (isset($errors) && !empty($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                    <div class='alert alert-danger'><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div class="mb-3">
                <label for="uname" class="form-label">Employee Login Name</label>
                <input type="text" class="form-control" name="uname" id="uname" value="<?php echo isset($_POST['uname']) ? htmlspecialchars($_POST['uname']) : ''; ?>" placeholder="Input Employee Login Name">
            </div>
            <div class="mb-3 input_container">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Input Password">
                <img src="img/eye-off-svgrepo-com.svg" id="leyeicon">
            </div>

            <button type="submit" name="login" class="btn container d-flex justify-content-center login-btn" style="width:100px;background-color: #d17fb2; color:white;">Login</button>
        </form>
    </div>

    <!-- javascript for the show and hide of the password -->
    <script>
        let leyeicon = document.getElementById("leyeicon");
        let password = document.getElementById("password");

        leyeicon.onclick = function() {
            if (password.type == "password") {
                password.type = "text";
                leyeicon.src = "img/eye-svgrepo-com.svg";
            } else {
                password.type = "password";
                leyeicon.src = "img/eye-off-svgrepo-com.svg";

            }
        }
    </script>
</body>

</html>