<?php
session_start();
include('../includes/functions.php');
if (isset($_SESSION['email'])) {
    $e = $_SESSION['email'];
    $p = $_SESSION['password'];

    if (isset($_POST['personal'])) {
        $a = $_POST['nom'];
        $b = $_POST['prenom'];
        $c = $_POST['email'];
        $d = $_POST['phone'];
        //re-validate the candidat's phone
        $valid_phone = false;
        if (preg_match("/^[0][6-7][0-9]{8}$/", $d)) {
            // $phone is valid
            $valid_phone = true;
        }
        $cin = $_POST['cin'];
        $f = $_POST['date_n'];
        $g = $_POST['addresse'];
        $h = $_POST['sexe'];
        $i = $_POST['ville'];
        if ($valid_phone) {
            $res = update_query('candidat', "nom='$a',prenom='$b',email='$c',addresse='$g',phone='$d',cin='$cin',date_N='$f',sexe='$h',ville_id=$i", "email='$e' and password='$p'");
            if ($res) {
                $_SESSION['email'] = $c;
                $_SESSION['infos-updated'] = true;
                header('location: ../old_candidat_infos.php');
            } else {
                $_SESSION['infos-updated'] = false;
                header('location: ../old_candidat_infos.php');
            }
        } else {
            $_SESSION['infos-updated'] = false;
            header('location: ../old_candidat_infos.php');
        }
    } else if (isset($_POST['academic'])) {
        $a = $_POST['cne'];
        $b = $_POST['bac_filiere'];
        $c = $_POST['bac_annee'];
        $d = $_POST['national_note'];
        $f = $_POST['regio_note'];
        $ch1 = $_POST['choix1'];
        $ch2 = $_POST['choix2'];
        if ($ch1!=$ch2) {
            $res = update_query('candidat', "cne='$a',filiere_bac_id=$b,annee_bac='$c',national_note=$d,regio_note=$f,choix1=$ch1,choix2=$ch2", "email='$e' and password='$p'");
            if ($res) {
                $_SESSION['infos-updated'] = true;
                header('location: ../old_candidat_infos.php');
            } else {
                $_SESSION['infos-updated'] = false;
                header('location: ../old_candidat_infos.php');
            }
        } else {
            $_SESSION['infos-updated'] = false;
            header('location: ../old_candidat_infos.php');
        }
    } else if (isset($_POST['document'])) {
        $ph = $_SESSION['photo'];
        $bc = $_SESSION['bac'];
        $rlv = $_SESSION['releve'];
        $one_file_is_uploaded = false;
        // 1 the photo if he wanted to change it of course :

        $photo_location = upload_mdf($_FILES['photo'], array('jpg', 'jpeg', 'png'));
        if ($photo_location) {
            $one_file_is_uploaded = true;
            unlink('../' . $ph);
        } else {
            $photo_location = $ph;
        }

        // 2 the bac if he wanted to change it of course :

        $bac_location = upload_mdf($_FILES['bac'], array('pdf'));
        if ($bac_location) {
            $one_file_is_uploaded = true;
            unlink('../' . $bc);
        } else {
            $bac_location = $bc;
        }
        // 3 the releve if he wanted to change it of course :

        $releve_location =  upload_mdf($_FILES['releve'], array('pdf'));
        if ($releve_location) {
            $one_file_is_uploaded = true;
            unlink('../' . $rlv);
        } else {
            $releve_location = $rlv;
        }
        $res = update_query('candidat', "photo='$photo_location',bac='$bac_location',bac_releve='$releve_location'", "email='$e'and password='$p'");
        if ($res) {
            if ($one_file_is_uploaded) {
                $_SESSION['infos-updated'] = true;
                header('location: ../old_candidat_infos.php');
            } else {
                header('location: ../old_candidat_infos.php');
            }
        } else {
            $_SESSION['infos-updated'] = false;
            header('location: ../old_candidat_infos.php');
        }
    }
} else {
    header('location: ../logout.php');
}
