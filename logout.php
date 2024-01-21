<?php

session_start();



$id = $_SESSION['User_ID'];

unset($id);

session_destroy();


header("Location: index.php");
