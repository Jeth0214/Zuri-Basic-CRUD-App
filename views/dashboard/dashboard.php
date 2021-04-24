<?php
require('../../sessions/session.php');
require('../../controllers/controllers.php');

$result = new Courses();
$courses = $result->show();
//print_r($courses);

?>

<?php include('../layout/header.php'); ?>
<?php include('../layout/topbar.php'); ?>



<div class="container mt-5">

    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-primary text-center">
                        Courses we offer
                    </h3>
                </div>
                <div class="card-body px-0">
                    <a href="./courses/add.php" class="btn btn-primary mx-4 mb-4">Add a course</a>
                    <div class="text-center text-muted font-italic">
                        <?php if (count($courses) < 1) : ?>
                            <p>No Courses offered yet</p>
                        <?php endif ?>
                    </div>


                    <ul class="list-group list-group-flush">
                        <?php foreach ($courses as $course) :; ?>
                            <li class="list-group-item d-flex justify-content-between">

                                <?php echo htmlspecialchars($course['course_name']); ?>
                                <a href="../dashboard/courses/details.php?course_id=<?php echo $course['course_id'] ?>" class="text-right">more details..</a>
                            </li>

                        <?php endforeach; ?>
                    </ul>


                </div>

            </div>
        </div>
    </div>
</div>

<?php include('../layout/footer.php'); ?>