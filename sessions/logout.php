<?php

session_start();

$_SESSION['status'] = "Invalid";

unset($_SESSION['username']);

echo "<script>window.location.href = '../index.php'</script>";
