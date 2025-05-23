<?php
session_start();
session_unset();

$_SESSION['registration_success'] = false;
header("Location: ../index.php");
exit();

?>