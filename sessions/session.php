<?php
session_start();

if ($_SESSION['status'] === "Invalid" || empty($_SESSION['status'])) {
    $_SESSION['status'] = "Invalid";

    unset($_SESSION['username']);

    echo "<script>window.location.href = '../../login.php'</script>";
}
