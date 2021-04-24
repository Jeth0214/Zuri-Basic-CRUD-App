<?php
require('../../sessions/session.php');
require('../../controllers/controllers.php');


$user = new User();
$userProfile = $user->index($_SESSION['userid']);
// echo $userProfile[0]['id'];
if (count($userProfile) < 1) {
    $_SESSION['status'] = "Invalid";
    echo "<script>window.location.href = '../../index.php'</script>";
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
                        Profile
                    </h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Username: </strong> <?php echo htmlspecialchars($userProfile[0]['username']) ?></p>
                        </li>
                        <li class="list-group-item"><strong>Hashed password: </strong> <?php echo htmlspecialchars($userProfile[0]['password']) ?></li>
                    </ul>
                    <div class="d-flex justify-content-between mt-4">
                        <div class="">
                            <a href="./resetpassword.php" class="btn btn-success">Reset Password?</a>
                        </div>
                        <div class="">
                            <a class="btn btn-primary" href="../dashboard/dashboard.php"> Back to DashBoard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../layout/footer.php'); ?>