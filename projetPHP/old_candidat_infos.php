<?php
session_start();
if (!isset($_SESSION['email']))
    header('location: logout.php');
else {
include('includes/functions.php');
include('includes/footer.php');
$e = $_SESSION['email'];
$p = $_SESSION['password'];
$res = select_query('candidat', 'nom,prenom,addresse,phone,cin,date_N,sexe,filiere_bac_id,cne,ville_id,annee_bac,photo,regio_note,national_note,bac,bac_releve,choix1,choix2', "email='$e' and password='$p'");
$row = mysqli_fetch_array($res);
// selectionner la ville de candidat
$v_id = $row['ville_id'];
$res = select_query('villes', 'ville', "id = $v_id ");
$ville = mysqli_fetch_array($res);
// selectionner la filiere de bac de candidat
$filiere_bac_id = $row['filiere_bac_id'];
$res = select_query('filiere', 'title', "id = $filiere_bac_id  ");
$bac_filiere = mysqli_fetch_array($res);
// selectionner la choix 1 de candidat
$ch1 = $row['choix1'];
$res = select_query('departements', 'filiere', "id = $ch1 ");
$choix1 = mysqli_fetch_array($res);
// selectionner la choix 2 de candidat
$ch2 = $row['choix2'];
$res = select_query('departements', 'filiere', "id = $ch2 ");
$choix2 = mysqli_fetch_array($res);
//get the destinations folders of the 3 files :
$_SESSION['photo'] = $row['photo'];
$_SESSION['bac'] = $row['bac'];
$_SESSION['releve'] = $row['bac_releve'];
//see if the infos modification is done successfully :
if (isset($_SESSION['infos-updated'])) {

    if ($_SESSION['infos-updated']) {
        //it's true !
        echo '<div class="alert alert-success indxalert" id="target" role="alert">
 vos infos a été changé avec succés. <img width="22" class="close_alert" src="img/valid.png" alt="" onclick="hide()">
</div>';
    } else {
        //it's false !
        echo '<div class="alert alert-danger indxalert" id="target" role="alert">
informations inchangé, vérifiez les informations et réessayez. <img width="22" class="close_alert" src="img/not.png" alt="" onclick="hide()">
</div>';
    }
    unset($_SESSION['infos-updated']);
}
//the modals 
include('update_candidat.php');
?>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="est.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pre-inscription EST safi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <img class="estLogo" id="estImg" src="<?= $row['photo']; ?>" onclick="window.location.href='old_candidat.php'" height=" 60" width="62" alt="img">

        <!-- the full name of the candidat which has brought from the DB!! -->
        <p class="font-weight-bold full-name">Mr. <?= $row['prenom'] . ' ' . $row['nom']; ?></p>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto navlist">

                <li class="nav-item"><a class="nav-link n1" href="old_candidat.php">Acceuil</a> </li>
                <li class="nav-item"><a class="nav-link n2" href="old_candidat_infos.php">Vos informations</a> </li>
                <li class="nav-item"><a class="nav-link n3" href="#" data-toggle="modal" data-target="#change_password_modal"><u> changer mot de passe</a> </u></li>
                <div class="modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">changer le mot de passe</h5>

                            </div>
                            <div class="modal-body">
                                <form action="main/change_password.php" method="post">
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label>Mot de passe actuel :</label>
                                            <input type="password" id="old_pass" class="form-control js-name" name="password" required>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Nouveau mot de passe :</label>
                                            <input type="password" id="new_pass" class="form-control js-name" name="Newpassword" required>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label>Confirmer le mot de passe :</label>
                                            <input type="password" id="new_confirm_pass" class="form-control js-name" name="CNewpassword" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="changer">Changer</button>
                                        <button type="button" class="btn btn-secondary" id="close_pass" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
        <button class="btn btn-warning logout" onclick="window.location.href='logout.php'">Déconnecter</button>

    </nav>
    <div class="annuler"><button class="btn btn-danger bt-danger" data-toggle="modal" data-target="#deleteModal">Supprimer compte</button></div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">voulez vous vraiment supprimer votre compte?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='main/delete_acc.php'">Oui</button>
                </div>
            </div>
        </div>
    </div>

    <div class=" cards_candidat">
        <!-- card 1 -->
        <div class="card text-white bg-dark mb-3" style="width: 21rem;">
            <div class="card-header">Informations personnelles</div>
            <div class="card-body">
                <div class="personal">
                    <h5 class="card-title">Numéro de candidature :&nbsp;</h5>
                    <p class="card-text"><u><?= $_SESSION['id'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Nom complet :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['prenom'] . ' ' . $row['nom'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Email :&nbsp;</h5>
                    <p class="card-text"><u><?= $e ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Phone :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['phone'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">CIN :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['cin'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Date de naissance :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['date_N'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Résidence :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['addresse'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Sexe :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['sexe'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Ville :&nbsp;</h5>
                    <p class="card-text"><u><?= $ville['ville'] ?></u></p>
                </div>


            </div>
            <button class="btn btn-success mdf" data-toggle="modal" data-target="#change_infos_modal">Modifier</button>

        </div>
        <!-- card 2 -->
        <div class="card text-white bg-Secondary mb-3" style="width: 21rem;">
            <div class="card-header">Informations académique et choix</div>
            <div class="card-body">
                <div class="personal">
                    <h5 class="card-title">CNE :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['cne'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Filière de bac :&nbsp;</h5>
                    <p class="card-text"><u><?= $bac_filiere['title'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Année de baccalauréat :&nbsp;</h5>
                    <p class="card-text"><u><?= $row['annee_bac'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Note de national:&nbsp;</h5>
                    <p class="card-text"><u><?= $row['national_note'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Note de régional:&nbsp;</h5>
                    <p class="card-text"><u><?= $row['regio_note'] ?></u></p>
                </div>
                <div class="personal">
                    <h5 class="card-title">Choix&nbsp;</h5>
                    <p class="card-text">
                    <h5 class="ch">1 : </h5><u><?= $choix1['filiere'] ?></u></p>
                </div>
                <div class="personal ch2">
                    <h5 class="card-title">Choix&nbsp;</h5>
                    <p class="card-text">
                    <h5 class="ch">2 : </h5><u><?= $choix2['filiere'] ?></u></p>
                </div>
            </div>
            <button class="btn btn-success mdf" data-toggle="modal" data-target="#change_academic_modal">Modifier</button>
        </div>
        <!-- card 3 -->
        <div class="card text-white bg-info mb-3" style="width: 21rem;">
            <div class="card-header">Documents</div>
            <div class="card-body">
                <div class="personal">
                    <img src="img/pdf.png" onclick="window.location.href='<?= $row['bac'] ?>'" width="25" height="25" alt="">
                    <h5 class="card-title">Bac diplôme :&nbsp;</h5>
                    <p class="card-text"><a href="<?= $row['bac'] ?>" download="<?= $row['prenom'] . ' ' . $row['nom'] . ' bac' ?>">Download the pdf</a></p>
                </div>
                <div class="personal releve">
                    <img src="img/pdf.png" onclick="window.location.href='<?= $row['bac_releve'] ?>'" width="25" height="25" alt="">
                    <h5 class="card-title">Relevé de bac :&nbsp;</h5>
                    <p class="card-text"><a href="<?= $row['bac_releve'] ?>" download="<?= $row['prenom'] . ' ' . $row['nom'] . ' bac relevé' ?>">Download the pdf</a></p>
                </div>
                <!-- the photo card start -->
                <div class="card text-dark bg-light mb-3 photo-card" style="max-width: 10rem;">
                    <div class="card-header">Photo</div>
                    <div class="card-body">

                        <img class="photo-card-img" src="<?= $row['photo'] ?>" alt="photo" height="120" width="124">
                    </div>

                </div>
                <!-- photo card end  -->
            </div>
            <button class="btn btn-success mdf" data-toggle="modal" data-target="#change_files_modal">Modifier</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php
    //this is for deny the user from modifying his info when the pre-inscription end date is reached !!!
    if ($_SESSION['endDate'] == date('Y-m-d')) {

        echo '<style>
         .mdf{
             display: none;
          }
           </style>';
    }

    ?>

</body>

<style>
    .n3 {
        margin-left: 30px;
        color: yellow !important;
    }

    .bt-danger {
        margin-left: 86.4%;
        margin-top: 10px;
    }

    .personal img {
        cursor: pointer;
    }

    .releve {
        margin-top: 20px;
    }

    .card-text a {
        color: red;
    }

    .ch {
        width: 11%;
        /* margin-right: 15px; */
    }

    .ch2 {
        margin-top: 10px;
    }

    .personal {
        display: flex !important;
    }

    .cards_candidat {
        display: flex;
        justify-content: space-between;
        width: 80%;
        margin: auto;
        margin-top: 12px;


    }

    h5 {
        font-size: 110%;
        width: fit-content;
    }


    /*  .table {
        margin: auto;
        margin-top: 100px;
        width: 70%;
    } */

    .estLogo {
        border-radius: 50%;
        transition: .5s;

    }

    .estLogo:hover {
        transition: .5s;
        scale: 122%;
        cursor: pointer;
    }

    .n1 {
        margin-right: 50px;
    }

    .navlist {
        margin-left: 35px;
    }

    .full-name {
        font-size: 110%;
        color: white;
        margin: 0;
        margin-left: 15px;
    }

    /* the button to close the error alert */
    .close_alert:hover {
        cursor: pointer;

    }

    .alert-success {
        left: 63px;
        top: 64px;
        width: fit-content;
        position: fixed;
        z-index: 1;
    }

    .alert-danger {
        left: 63px;
        top: 64px;
        width: fit-content;
        position: fixed;
        z-index: 1;
    }

    .photo-card {
        margin: auto;
        margin-top: 6%;

    }

    .card-body {
        padding: 0.6rem;
    }

    .photo-card .card-body {
        padding: 8px;
    }

    .photo-card-img {

        margin: 8px;
        /*   width: 100%; */
        border-radius: 50%;

    }

    .modal {
        z-index: 99999;
        padding-bottom: 0;
        height: 800px;
    }

    .modal-footerx {
        padding: 0;
    }
</style>



<script>
    let elem = document.getElementsByClassName('n2');
    elem[0].classList.add('active')

    function hide() {
        document.getElementById("target").style.display = "none";
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
<?php   }?>