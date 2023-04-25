<?php
session_start();
$admin = $_SESSION['admin'];
session_unset();
session_destroy();

if ($admin) {
    header('location: admin.php');
} else {
    header('location: index.php');
}
