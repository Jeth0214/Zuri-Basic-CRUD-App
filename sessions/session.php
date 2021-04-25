<?php
session_start();

if ($_SESSION['status'] === "Invalid" || empty($_SESSION['status'])) {
    $_SESSION['status'] = "Invalid";

    unset($_SESSION['username']);
    unset($_SESSION['userid']);

    echo "<script>window.location.href = '../../index.php'</script>";
}
