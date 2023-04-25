<?php
session_start();
if (!isset($_SESSION['email']))
    header('location: logout.php');
else {
include('includes/functions.php');


if (isset($_POST['terminer'])) {
    $e = $_SESSION['email'];
    $p = $_SESSION['password'];

    $_SESSION['nom'] = $nom = $_POST['nom'];
    $_SESSION['prenom'] = $prenom = $_POST['prenom'];
    $_SESSION['residence'] = $residence = $_POST['residence'];
    $_SESSION['phone'] = $phone = $_POST['phone'];
    //validate the candidat's phone
    $valid_phone = false;
    if (preg_match("/^[0][6-7][0-9]{8}$/", $phone)) {
        // $phone is valid
        $valid_phone = true;
    }
    $_SESSION['cin'] = $cin = $_POST['cin'];
    $_SESSION['dateN'] = $dateN = $_POST['dateN'];

    $_SESSION['sexe'] = $sexe = $_POST['sexe'];

    $_SESSION['bac_filiere'] = $bac_filiere = $_POST['bac_filiere'];
    $_SESSION['cne_code'] = $cne_code = $_POST['cne_code'];
    $_SESSION['ville'] = $ville = $_POST['ville'];
    $_SESSION['bac_annee'] = $bac_anne = $_POST['bac_annee'];
    // the photo file ****
    $_SESSION['photo'] = $_FILES['photo'];
    $photo = upload($_FILES['photo'], array('jpg', 'png', 'jpeg'));
    $_SESSION['regional'] = $regional = $_POST['regional'];
    $_SESSION['national'] = $national = $_POST['national'];
    // the bac file ****
    $_SESSION['bac_scan'] = $_FILES['bac_scan'];
    $bac_scan = upload($_FILES['bac_scan'], array('pdf'));
    // the bac releve file ****
    $_SESSION['releve_scan'] = $_FILES['releve_scan'];
    $releve_scan = upload($_FILES['releve_scan'], array('pdf'));
    $_SESSION['choix1'] = $choix1 = $_POST['choix1'];
    $_SESSION['choix2'] = $choix2 = $_POST['choix2'];

    // this is to select the filiere id to update it inside the candidat ********
    $res = select_query('filiere', 'id', "title = '$bac_filiere'");
    $row = mysqli_fetch_array($res);
    $filiere_id = $row['id'];
    //********************************** */

    // this is to select the ville id to update it inside the candidat ********
    $res = select_query('villes', 'id', "ville = '$ville'");
    $row = mysqli_fetch_array($res);
    $ville_id = $row['id'];
    //********************************** */

    // this is to select the choix 1 id to update it inside the candidat ********
    $res = select_query('departements', 'id', "filiere = '$choix1'");
    $row = mysqli_fetch_array($res);
    $choix1_id = $row['id'];
    //********************************** */

    // this is to select the choix 2 id to update it inside the candidat ********
    $res = select_query('departements', 'id', "filiere = '$choix2'");
    $row = mysqli_fetch_array($res);
    $choix2_id = $row['id'];
    // ********************************** */
    //test if the 3 files are successfully uploaded and both of 'choix' are different !!***********
    if ($choix1_id != $choix2_id && $photo && $bac_scan && $releve_scan && $valid_phone) {
        //here we want to bring out the last id of an the last existing inscription in which the candidat is registerd
        $resi = select_query('inscription', 'MAX(id)', 0);
        $rowi = mysqli_fetch_array($resi);
        $last_id = $rowi[0];
        $res = update_query('candidat', "nom='$nom',prenom='$prenom',addresse='$residence',phone='$phone',cin='$cin',date_N='$dateN',sexe='$sexe',filiere_bac_id=$filiere_id,cne='$cne_code',ville_id=$ville_id,annee_bac=$bac_anne,photo='$photo',regio_note=$regional,national_note=$national,bac='$bac_scan',bac_releve='$releve_scan',choix1=$choix1_id,choix2=$choix2_id,first_login='No',promotion_id=$last_id", "email='$e' and password='$p'");
        if ($res) {
            $_SESSION['candidat_added'] = true;
            header('location:old_candidat.php');
        } else {
            $_SESSION['register'] = false;
            header('location:formSP/steps.php');
        }
    } else {
        $_SESSION['infos'] = false;
        header('location:formSP/steps.php');
    }
}
}
