<?php

session_start();

// Connect Close

include_once 'db_connect.php';

mysqli_close($connect);

// Close Session

session_unset();
session_destroy();

header('Location: ../login.php');