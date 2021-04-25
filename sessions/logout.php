<?php

session_start();

$_SESSION['status'] = "Invalid";

unset($_SESSION['username']);
unset($_SESSION['userid']);

echo "<script>window.location.href = '../index.php'</script>";
