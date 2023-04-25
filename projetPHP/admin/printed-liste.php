<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['admin'] = 'admin';
    header('location: ../logout.php');
} else {
include('../includes/functions.php');

//we will need this below code !!!!!!!!!

$id_filiere = $_SESSION['id_flr'];
$max = $_SESSION['max'];
$moyen = $_SESSION['moyen'];

?>

<html>
<div class="printed">
    <title>liste principale de <?= $_SESSION['filiere'] ?> promotion <?= $_SESSION['promo'] ?> </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

    <div class="logos">
        <img src="../est.png" height="110" alt="">
        <img src="../uca.png" height="90" alt="">
    </div>
    <style>
        .logos {
            display: flex;
            justify-content: space-between;
            margin: 0;
        }
    </style>

    <div class="tablediv">
        <div class="h5-t">
            <h5>liste principale de <?= $_SESSION['filiere'] ?> promotion <?= $_SESSION['promo'] ?> EST Safi</h5>
        </div>
        <style>
            .h5-t {
                text-align: center;
            }
        </style>

        <table class="table table-bordered">

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
                $res = select_query('candidat', 'id,nom,prenom,email,addresse,phone,cin,date_N,sexe,filiere_bac_id,cne,ville_id,annee_bac,photo,regio_note,national_note,bac,bac_releve,choix1,choix2', "choix1=$id_filiere or choix1=$id_filiere order by regio_note*0.25+national_note*0.75 desc");
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

    <script>
        window.print()
    </script>
    <style>
        h5 {
            margin-top: 25px;
            margin-bottom: 40px;
        }

        .tablediv {

            margin: auto;
            margin-top: 60px;
            max-width: 95% !important;
            border: 1px groove black;
            padding: 20px;
            margin-bottom: 70px;
        }
        .printed{
            margin-top: 80px;;
        }
    </style>

</div>

</html>
<?php } ?>