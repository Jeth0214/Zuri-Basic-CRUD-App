<?php
require('../../../sessions/session.php');
require('../../../controllers/controllers.php');

if (isset($_POST['delete'])) {
    //get the id of record to delete
    $id_to_delete = $_POST['id_to_delete'];
    $courses = new Courses();
    $deleted = $courses->delete($id_to_delete);
    if ($deleted) {
        echo "<script>window.location.href = '../././dashboard.php'</script>";
    }
}

if (isset($_GET['course_id'])) {
    // echo $_GET['course_id'];
    $id = htmlspecialchars($_GET['course_id']);
    $courses = new Courses();
    $course = $courses->index($id);
    //print_r($course);
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
                        Course Details
                    </h3>
                </div>
                <div class="card-body">
                    <p> <span class="text-success font-weight-bold">Course name: </span> <?php echo htmlspecialchars($course['course_name']) ?></p>

                    <div class="d-flex justify-content-between">
                        <div class="">
                            <a class="btn btn-primary" href="../../dashboard/dashboard.php"> Back to DashBoard</a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <!-- Edit Link -->
                            <a href="../courses/edit.php?course_id=<?php echo htmlspecialchars($course['course_id']) ?>" class="btn btn-success px-3 mr-2">Edit</a>
                            <!-- Delete form -->
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" class="text-right" method="POST">
                                <input type="hidden" name="id_to_delete" value="<?php echo htmlspecialchars($course['course_id']) ?>">
                                <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include('../../layout/footer.php'); ?>