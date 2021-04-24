<?php
require('../../sessions/session.php');
require('../../controllers/controllers.php');

$errorMessage = "";
if (isset($_POST['submit'])) {
    if (empty($_POST['newPassword'])) {
        $errorMessage = "Please enter you new password";
    } else {
        $user = new User();
        $user->resetPassword($_POST['newPassword'], $_SESSION['userid']);
        echo "<script>window.location.href = './profile.php'</script>";
    }
}
?>

<?php include('../layout/header.php'); ?>
<?php include('../layout/topbar.php'); ?>



<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-primary text-center">
                        Reset Password
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-danger text-center mb-3"><?php echo $errorMessage ?? "" ?></div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label for="password">Enter your new password</label>
                            <input id="password" type="password" class="form-control" name="newPassword">
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <div class="">
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            </div>
                            <div class="">
                                <a class="btn btn-success" href="./profile.php"> Back to your Profile</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('../layout/footer.php'); ?>