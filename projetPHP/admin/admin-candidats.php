<?php
session_start();

if (!isset($_SESSION['email'])){
$_SESSION['admin']='admin';
header('location: ../logout.php');}
else {
    
include('../includes/functions.php');
//after changing the password ::
if (isset($_SESSION['password_changed'])) {

    if ($_SESSION['password_changed']) {
        //it's true !
        echo '<div class="alert alert-success indxalert" id="target" role="alert">
 votre mot de passe a été changé avec succés. <img width="22" class="close_alert" src="img/valid.png" alt="" onclick="hide()">
</div>';
    } else {
        //it's false !
        echo '<div class="alert alert-danger indxalert" id="target" role="alert">
 Mot de passe inchangé, vérifiez vos informations et réessayez. <img width="22" class="close_alert" src="../img/not.png" alt="" onclick="hide()">
</div>';
    }
    unset($_SESSION['password_changed']);
}
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
    <div class="nav-div">
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark position-fixed">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <img class="estLogo" id="estImg" src="../img/admin.png" onclick="window.location.href='preinscription-infos.php'" height="60" width="62" alt="img">

            <!-- the full name of the admin which has brought from the DB!! -->
            <b class="font-weight-bold full-name">Mr. <?= $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></b>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto navlist">

                    <li class="nav-item"><a class="nav-link n1" href="admin-candidats.php">liste des candidats</a> </li>
                    <li class="nav-item"><a class="nav-link n2" href="preinscription-infos.php">pre-inscription infos</a> </li>
                    <!-- changer le mot de passe -->
                    <li class="nav-item"><a class="nav-link n33" href="#" data-toggle="modal" data-target="#change_password_modal"> changer mot de passe</a> </li>
                    <li class="nav-item"><a class="nav-link n3" data-toggle="modal" data-target="#change_academic3_modal" href="#"><u>liste principale</a> </u></li>
                </ul>
            </div>
            <button class="btn btn-warning logout" onclick="window.location.href='../logout.php'">Déconnecter</button>

        </nav>
    </div>
    <!-- generate the principle list of the accepted candidats -->
    <div class="modal fade" id="change_academic3_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Génération de liste principale</h5>
                </div>
                <div class="modal-body">
                    <form action="liste-principale.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Selectionnez la filière :</label>
                            <select id="first_select" class="form-control" name="idd">
                                <!-- it will display 'les choix' from our database  -->
                                <?php
                                $ress = select_query('departements', 'id,filiere', 0);
                                while ($roww = mysqli_fetch_array($ress)) {
                                    if ($roww['filiere'] != $choix2['filiere'])
                                        echo '<option value="' . $roww['id'] . '">' . $roww['filiere'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"><b>Entrez le moyen d'admission</b></label>
                            <input type="number" class="form-control" id="exampleInputPassword1" name="moyen" value="10" step="0.01" min="10" max="20" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="generate">Générer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->
    <div class="modal fade" id="change_password_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">changer le mot de passe</h5>
                </div>
                <div class="modal-body">
                    <form action="../main/change_password.php" method="post">
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
                            <button type="submit" class="btn btn-success" name="changer2">Changer</button>
                            <button type="button" class="btn btn-secondary" id="close_pass" data-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end modal  -->
    <!-- les candidate -->
    <iframe class="embed-responsive-item" src="../liste_candidats.php" frameborder="0" width="100%" height="100%"></iframe>
    <!-- end of liste de candidats -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<style>
    .nav-div nav {
        width: 100%;
    }

    .n33 {
        margin-left: 30px;
        color: yellow !important;
    }


    .n3 {
        margin-left: 30px;
        color: yellow !important;
    }

    .note {
        width: 40%;
        font-size: 120%;
        margin: auto;
        margin-top: 20px;
        border-color: black;
    }

    .table {
        margin: auto;
        margin-top: 100px;
        width: 70%;
    }

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
</style>
<footer class="footer bg-primary">
    <img src="../includes/logo-footer.png" alt="pré-inscription EST Safi" height="50px">
    <h6> Ecole Supérieure de Technologie - Safi
        Route Dar Si Aïssa, B.P. 89, 46000 – Tél : (+212) 5 24 62 50 53 - Fax: (+212) 5 24 62 70 26 &nbsp; &copy; by Belattar Imad</h6>
</footer>
<style>
    .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        display: flex;
        z-index: 99999;

    }

    footer h6 {
        margin-top: 18px;
        margin-left: 15px;
        font-size: smaller;
        color: white;
    }

    footer img {

        margin-left: 40px;
    }
</style>


<script>
    function hide() {
        document.getElementById("target").style.display = "none";
    }
    let elem = document.getElementsByClassName('n1');
    elem[0].classList.add('active')
</script>

</html>
<?php } ?>