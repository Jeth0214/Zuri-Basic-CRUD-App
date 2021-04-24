<?php
require('../../../sessions/session.php');
require('../../../controllers/controllers.php');

$errorMessage = "";
if (isset($_POST['submit'])) {
    if (empty($_POST['course_name'])) {
        $errorMessage = "Please provide a title";
    } else {
        $courses = new Courses();
        $added =  $courses->create($_POST['course_name']);
        if ($added) {
            echo "<script>window.location.href = '../././dashboard.php'</script>";
        }
    }
}

?>

<?php include('../../layout/header.php'); ?>
<?php include('../../layout/topbar.php'); ?>



<div class="container mt-5">

    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-primary text-center">
                        Add a Course
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-danger text-center">
                        <?php echo $errorMessage ?? "" ?>
                    </div>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

                        <div class="form-group">
                            <label for="course_name">Course Name</label>
                            <input type="text" class="form-control" id="course_name" name="course_name">
                        </div>

                        <div class="d-flex justify-content-between">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            <!-- Delete form -->
                            <a class="btn btn-success" href="../dashboard.php">Back To DashBoard</a>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('../../layout/footer.php'); ?>