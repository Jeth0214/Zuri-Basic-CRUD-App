<?php
require('./controllers/controllers.php');

session_start();

if ($_SESSION['status'] === "Invalid" || empty($_SESSION['status'])) {
    $_SESSION['status'] = "Invalid";
};

if ($_SESSION['status'] === "valid") {
    echo "<script>window.location.href = './views/dashboard/dashboard.php'</script>";
};

if (isset($_POST['submit'])) {
    //print_r($_POST);
    $register = new User();
    $erroMessage =  $register->validate($_POST);
    //echo $erroMessage;
    if (empty($erroMessage)) {
        $register->register($_POST);
        header('Location:index.php');
    }
}


?>


<?php include './views/layout/header.php' ?>

<div class="container">
    <h1 class="text-center my-5"> Zuri Basic CRUD Application</h1>
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-primary text-center">
                        Register
                    </h3>
                </div>
                <div class="card-body">

                    <div class="text-center text-danger">
                        <strong><?php echo $erroMessage ?? ' ' ?></strong>
                    </div>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">

                        <div class="card-text text-center">
                            <small>
                                Already have account?
                                <a href="./login.php" class="card-link ml-3">Log In Here</a>
                            </small>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<?php include './views/layout/header.php' ?>