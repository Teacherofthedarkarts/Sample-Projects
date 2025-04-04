<?php
session_start();
session_destroy();
header("Location: http://localhost/csc680/parking_system/index.php");
?>
