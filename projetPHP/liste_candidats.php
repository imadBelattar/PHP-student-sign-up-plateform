<?php
session_start();
if (!isset($_SESSION['email']))
header('location: logout.php');
else {
    ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">



<div class="tablediv">
    <table id="example" class="table table-striped table-bordered">

        <thead class="thead-dark">
            <tr>
                <th>N° </th>
                <th>photo</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>CNE</th>
                <th>CIN</th>
                <th>Infos</th>
            </tr>
        </thead>
        <tbody>


            <?php
            include('./includes/functions.php');
            $res = select_query('candidat', 'id,nom,prenom,email,addresse,phone,cin,date_N,sexe,filiere_bac_id,cne,ville_id,annee_bac,photo,regio_note,national_note,bac,bac_releve,choix1,choix2', "choix1 is not NULL");

            while ($row = mysqli_fetch_array($res)) {
                /*  $ress = select_query('villes', 'ville', "id = $row[11]");
                $ville = mysqli_fetch_array($ress); */
                echo '<tr>
                <td>' . $row['id'] . '</td>
                <td><img class="estLogo" id="estImg" src="' . $row['photo'] . '"  height="60" width="62" alt="img"></td>
                 <td>' . $row['nom'] . '</td>
                <td>' . $row['prenom'] . '</td>
                <td>' . $row['cne'] . '</td>
                <td>' . $row['cin'] . '</td>
                <td><a href="admin/afficher_candidat.php?id=' . $row['id'] . '"><button class="btn btn-success">Afficher</button></a></td>
            </tr>';
            } ?>

        </tbody>
        <tfoot>
            <tr>
                <th>N° </th>
                <th>photo</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>CNE</th>
                <th>CIN</th>
                <th>Infos</th>
            </tr>
        </tfoot>

    </table>

</div>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            /*     paging: false,
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
        max-width: 90% !important;
        border: 2px dashed black;
        padding: 20px;
        margin-bottom: 70px;
    }
</style>
<?php } ?>