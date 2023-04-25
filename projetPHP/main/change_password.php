<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo "<script>window.open('../index.php','_self')</script>";
} else {
    include('../includes/functions.php');
    //change password for the candidat :  *********
    if (isset($_POST['changer'])) {
        $id = $_SESSION['id'];
        $candidat_password = $_SESSION['password'];
        $current_password = md5($_POST['password']);
        $new_password = $_POST['Newpassword'];
        $confirmNew_password = $_POST['CNewpassword'];
        $set_password = md5($new_password);
        if ($current_password == $candidat_password && $new_password == $confirmNew_password) {
            $res = update_query('candidat', "password = '$set_password'", "id = $id");
            if ($res) {
                $_SESSION['password_changed'] = true;
                header('location: ../logout.php');
            } else {
                $_SESSION['password_changed'] = false;
                header('location: ../old_candidat_infos.php');
            }
        } else {
            $_SESSION['password_changed'] = false;
            header('location: ../old_candidat_infos.php');
        }
    }

    //change the password for the admin : ********
    if (isset($_POST['changer2'])) {
        $id = $_SESSION['id'];
        $admin_password = $_SESSION['password'];
        $current_password = $_POST['password'];
        $new_password = $_POST['Newpassword'];
        $confirmNew_password = $_POST['CNewpassword'];
        if ($current_password == $admin_password && $new_password == $confirmNew_password) {
            $res = update_query('admin', "password = '$new_password'", "id = $id");
            if ($res) {
                $_SESSION['password_changed'] = true;
                header('location: ../logout.php');
            } else {
                $_SESSION['password_changed'] = false;
                header('location: ../admin/admin-candidats.php');
            }
        } else {
            $_SESSION['password_changed'] = false;
            header('location: ../admin/admin-candidats.php');
        }
    }
}
