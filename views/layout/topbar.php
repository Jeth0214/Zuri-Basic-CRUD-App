<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top mb-5">
    <div class="container">
        <a class="navbar-brand" href="javascript:void(0);">
            Zuri Basic CRUD App
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hello <?php echo $_SESSION['username'] ?>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="../profile/profile.php">Manage profile</a>
                        <div class="dropdown-divider"></div>
                        <form class="dropdown-item" action="../../sessions/logout.php" method="POST">
                            <input class="logout" type="submit" value="LOGOUT">
                        </form>
                    </div>
                </div>
                </li>


            </ul>

        </div>

    </div>

</nav>