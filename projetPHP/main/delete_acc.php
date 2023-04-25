<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo "<script>window.open('../index.php','_self')</script>";
} else {
    include('../includes/functions.php');
    //**************delete acc.
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $res = select_query('candidat', 'photo', "id = $id");
        $row = mysqli_fetch_array($res);
        unlink('../' . $row['photo']);
        delete('candidat', "id = $id");
        header('Location: ../logout.php');
    }
}
