<?php
require('./controllers/controllers.php');
session_start();
$errorMessage;

if (empty($_SESSION['status'])) {
    $_SESSION['status'] = "Invalid";
};

if ($_SESSION['status'] === "valid") {
    echo "<script>window.location.href = './views/dashboard/dashboard.php'</script>";
};

if (isset($_POST['submit'])) {
    // print_r($_POST);
    $register = new User();
    $validationMessage =  $register->validate($_POST);
    //echo $validationMessage;
    if (empty($validationMessage)) {
        $result =  $register->login($_POST);
        //print_r($result);
        echo "<br>";
        if (count($result) < 1) {
            $errorMessage = "No such credentials on our records.";
            $_SESSION['status'] = "Invalid";
        } else {
            $_SESSION['status'] = "valid";
            $_SESSION['username'] = $result[0]['username'];
            $_SESSION['userid'] = $result[0]['id'];
            echo "<script>window.location.href = './views/dashboard/dashboard.php'</script>";
        }
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
                        Log In
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center text-danger">
                        <strong><?php echo $validationMessage ?? ' '; ?></strong>
                    </div>
                    <div class="text-center text-danger">
                        <strong><?php echo $errorMessage ?? ' '; ?></strong>
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
                                Not registered yet?
                                <a href="./register.php" class="card-link ml-3">Register Here</a>
                            </small>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
<?php include './views/layout/header.php' ?>