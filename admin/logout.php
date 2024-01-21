<?php

session_start();



session_destroy();

$id = $_SESSION['AdminEmail'];

unset($id);

header("Location: ../login.php");
