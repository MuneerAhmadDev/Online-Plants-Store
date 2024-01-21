<?php

session_start();

if (!isset($_SESSION['AdminEmail'])) {
    header("Location: ../login.php");
}
