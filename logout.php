<?php
include('inc/connections.php');
session_unset();
session_destroy();
header('Location:index.php');
?>