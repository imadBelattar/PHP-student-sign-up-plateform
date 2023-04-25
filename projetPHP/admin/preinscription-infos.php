<?php
session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['admin'] = 'admin';
    header('location: ../logout.php');
} else {
    
include('../includes/functions.php');
$admin_id = $_SESSION['id'];
//pour créer un nouveau inscription :
if (isset($_POST['submit'])) {
    $promo = $_POST['promo'];
    $endDate = $_POST['endDate'];
    insert_query('inscription', 'promotion,endDate,adminId', "'$promo', '$endDate', $admin_id ");
}
//pour changer les informations correspondantes a certaine filière :
if (isset($_POST['submit2'])) {
    $id_filiere = $_POST['id_filiere'];
    $max = $_POST['max-etudiants'];
    $nom = $_POST["nom_fill"];
    update_query('departements', "max_etudiants=$max,adminId = $admin_id ,filiere='$nom'", "id='$id_filiere'");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pre-inscription admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="nav-div">
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark position-fixed">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <img class="estLogo" id="estImg" src="../img/admin.png" onclick="window.location.href='admin-candidats.php'" height="60" width="62" alt="img">

            <!-- the full name of the admin which has brought from the DB!! -->
            <b class="font-weight-bold full-name">Mr. <?= $_SESSION['prenom'] . ' ' . $_SESSION['nom'] ?></b>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto navlist">

                    <li class="nav-item"><a class="nav-link n1" href="admin-candidats.php">liste des candidats</a> </li>
                    <li class="nav-item"><a class="nav-link n2" href="preinscription-infos.php">pre-inscription infos</a> </li>
                    <!-- changer le mot de passe -->
                    <li class="nav-item"><a class="nav-link n33" href="#" data-toggle="modal" data-target="#change_password_modal"> changer mot de passe</a> </li>
                    <li class="nav-item"><a class="nav-link n3" data-toggle="modal" data-target="#change_academic3_modal" href="#"><u>liste principale</a> </u></li>
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
                </ul>
            </div>
            <button class="btn btn-warning logout" onclick="window.location.href='../logout.php'">Déconnecter</button>

        </nav>
        <!-- add a new preinscription -->
        <button class="btn btn-info insc" data-toggle="modal" data-target="#change_academic_modal">Créer un pré-inscription</button>
        <style>
            .insc {
                position: fixed;
                top: 90px;
                left: 10px;
            }
        </style>
    </div>
    <table class="table table-striped table-light table-hover">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Filière</th>
                <th scope="col">capacité</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $ress = select_query('departements', 'id,filiere,max_etudiants', 0);
            $num = 0;
            while ($roww = mysqli_fetch_array($ress)) {
                $num++;
            ?>

                <tr id="<?= $roww["id"] ?>">
                    <th scope="row"><?= $num ?></th>
                    <td><?= $roww['filiere'] ?></td>
                    <td><?= $roww['max_etudiants'] ?></td>
                    <td> <button class="btn btn-success" data-toggle="modal" data-target="#change_academic2_modal" onclick="modifier_fill('<?= $roww[0] ?>' )">modifier</button></td>
                    <!--  pour le modifiere ou bien le supprimer -->
                </tr>

            <?php
            }
            ?>
        </tbody>
    </table>
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
                            <input type="number" class="form-control" name="moyen" value="10" step="0.01" min="10" max="20" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="generate">Générer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->
    <div class="modal fade" id="change_academic_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau pré-inscription</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">promotion</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="entrer le promotion" name="promo" required>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Date de fin</label>
                            <input type="date" class="form-control" name="endDate" required>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">créer</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->
    <!-- modify  filiere -->
    <div class="modal fade" id="change_academic2_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">filière de département</h5>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <input type="text" id="id_filiere" name="id_filiere" value="" hidden/>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nom</label>
                            <input type="text" class="form-control" id="nom_fill" name="nom_fill" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">capacité</label>
                            <input type="number" class="form-control" id="cap" name="max-etudiants" min="1" max="2000" required>
                        </div>
                        <script>
                            function modifier_fill(id_row) {
                                var row = document.getElementById(id_row);
                                let name = row.childNodes[3].innerHTML;
                                let number = row.childNodes[5].innerHTML;
                                let modal_nom = document.getElementById("nom_fill");
                                modal_nom.value = name;
                                let modal_number = document.getElementById("cap");
                                modal_number.value = number;
                                let id = document.getElementById("id_filiere");
                                id.value = id_row;
                            }
                        </script>
                        <button type="submit" class="btn btn-primary" name="submit2">modifier</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end  -->



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

<style>
    .position-fixed {
        position: relative !important;
    }

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
    let elem = document.getElementsByClassName('n2');
    elem[0].classList.add('active')
</script>
<style>

</style>

</html>
<?php } ?>