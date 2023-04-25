<?php
session_start();
if (!isset($_SESSION['email']))
    header('location: logout.php');
else {
include('includes/functions.php');
$e = $_SESSION['email'];
$p = $_SESSION['password'];
$res = select_query('candidat', 'nom,prenom,addresse,phone,cin,date_N,sexe,filiere_bac_id,cne,ville_id,annee_bac,photo,regio_note,national_note,bac,bac_releve,choix1,choix2', "email='$e' and password='$p'");
$row = mysqli_fetch_array($res);
// a message indicates that the candidat that he's successfully registred ****
if (isset($_SESSION['candidat_added'])) {
    echo '<div class="alert alert-success indxalert" id="target" role="alert">
 vous êtes inscrit avec succès. <img width="22" class="close_alert" src="img/valid.png" alt="" onclick="hide()">
</div>';
    unset($_SESSION['candidat_added']);
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
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <img class="estLogo" id="estImg" src="<?= $row['photo']; ?>" onclick="window.location.href='old_candidat_infos.php'" height="60" width="62" alt="img">

        <!-- the full name of the candidat which has brought from the DB!! -->
        <b class="font-weight-bold full-name">Mr. <?= $row['prenom'] . ' ' . $row['nom']; ?></b>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto navlist">

                <li class="nav-item"><a class="nav-link n1" href="old_candidat.php">Acceuil</a> </li>
                <li class="nav-item"><a class="nav-link n2" href="old_candidat_infos.php">Vos informations</a> </li>
                <li class="nav-item"><a class="nav-link n3" href="#" data-toggle="modal" data-target="#change_password_modal"><u> changer mot de passe</a> </u></li>
                <div class="modal fade  " id="change_password_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Filière</th>
                <th scope="col">Nombre de places</th>
                <th scope="col">Moyen (25% régional 75% national)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td><?php
                    $id_choix1 = $row['choix1'];
                    $res = select_query('departements', 'filiere,max_etudiants', "id = $id_choix1");
                    $ro = mysqli_fetch_array($res);
                    echo $ro['filiere']; ?></td>
                <td><?= $ro['max_etudiants'] ?></td>
                <td><?= $row['regio_note'] * 0.25 + $row['national_note'] * 0.75 ?></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td><?php
                    $id_choix2 = $row['choix2'];
                    $res = select_query('departements', 'filiere,max_etudiants', "id = $id_choix2");
                    $ro = mysqli_fetch_array($res);
                    echo $ro['filiere']; ?></td>
                <td><?= $ro['max_etudiants'] ?></td>
                <td><?= $row['regio_note'] * 0.25 + $row['national_note'] * 0.75 ?></td>
            </tr>
        </tbody>
    </table>
    <div class="alert alert-info note" role="alert">
        <b>Note : </b>
        <div class="endDate"><u>une fois la date de fin de pré-inscription</u><b> (<?= $_SESSION['endDate'] ?>)</b></div> est atteinte vous ne pourrez plus modifier vos informations ni vos choix.
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<style>
    .endDate {
        color: red;

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
</style>
<?php
include('includes/footer.php');
?>


<script>
    function hide() {
        document.getElementById("target").style.display = "none";
    }
    let elem = document.getElementsByClassName('n1');
    elem[0].classList.add('active')
</script>

</html>
<?php } ?>