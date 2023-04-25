<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['admin'] = 'admin';
    header('location: ../logout.php');
} else {
include('../includes/functions.php');

//we will need this below code !!!!!!!!!


if (isset($_POST['generate'])) {
    $id = $_POST['idd'];
    $rees = select_query('departements', 'filiere,max_etudiants', "id=$id");
    $line = mysqli_fetch_array($rees);
    $_SESSION['id_flr'] = $id;
    $_SESSION['max'] = $max = $line['max_etudiants'];
    $_SESSION['moyen'] = $moyen = $_POST['moyen'];
    $_SESSION['filiere'] = $line['filiere'];
}
$max = $_SESSION['max'];
$moyen = $_SESSION['moyen'];
$id = $_SESSION['id_flr'];
$promo_id = $_SESSION['inscription_id'];
$promo_res = select_query('inscription', 'promotion', "id=$promo_id");
$promo = mysqli_fetch_array($promo_res);
$_SESSION['promo'] = $promo['promotion'];

?>

<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<div class="tablediv">
    <button class="btn btn-primary" onclick="window.location.href='printed-liste.php'">imprimer</button>
    <div class="h5-t">
        <h5>Liste principale de <?= $_SESSION['filiere'] ?> promotion <?= $_SESSION['promo'] ?> EST Safi</h5>
    </div>
    <style>
        .h5-t {
            text-align: center;
            margin-bottom: 35px;
            margin-top: 15px;
        }
    </style>

    <table id="example" class="table table-bordered">

        <thead class="thead-light">
            <tr>
                <th>N° </th>

                <th>Nom</th>
                <th>Prenom</th>
                <th>CNE</th>
                <th>CIN</th>
                <th>filière</th>
            </tr>
        </thead>
        <tbody>


            <?php

            $res = select_query('candidat', 'id,nom,prenom,email,addresse,phone,cin,date_N,sexe,filiere_bac_id,cne,ville_id,annee_bac,photo,regio_note,national_note,bac,bac_releve,choix1,choix2', "(choix1= $id or choix1=$id) and promotion_id=$promo_id order by regio_note*0.25+national_note*0.75 desc");
            $num = 0;

            while ($row = mysqli_fetch_array($res)) {
                $rss = select_query('filiere', 'title', "id = $row[9]");
                $bac_flr = mysqli_fetch_array($rss);
                $num++;
                if (($row['regio_note'] * 0.25 + $row['national_note'] * 0.75) >= $moyen && ($num <= $max)) {
                    echo '<tr>
                <td>' . $num . '</td>
                <td>' . $row['nom'] . '</td>
                <td>' . $row['prenom'] . '</td>
                <td>' . $row['cne'] . '</td>
                <td>' . $row['cin'] . '</td>
                <td>' . $bac_flr[0] . '</td>
                     </tr>';
                }
            } ?>

        </tbody>
    </table>

</div>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    function print_liste() {

        window.print()
    }
    $(document).ready(function() {
        $('#example').DataTable({


            /*   
                searching: false,
                ordering: false,
                "info": false */
        });
    });
</script>
<style>
    .tablediv {

        margin: auto;
        margin-top: 100px;
        max-width: 82% !important;
        border: 2px groove black;
        padding: 20px;
        margin-bottom: 70px;
    }
</style>

</html>
<?php } ?>