<?php
if(!isset($_SESSION['email']))
header('location: logout.php');
else{
?>
<!-- modal 1 -->
<div class="modal fade" id="change_infos_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modifier infos</h5>

            </div>
            <div class="modal-body">
                <form action="main/update-candidat-infos.php" method="post">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>nom :</label>
                            <input type="text" class="form-control js-name" name="nom" value="<?= $row['nom'] ?>" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>prenom :</label>
                            <input type="text" class="form-control js-name" name="prenom" value="<?= $row['prenom'] ?>" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>email :</label>
                            <input type="text" class="form-control js-name" name="email" value="<?= $_SESSION['email'] ?>" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>phone :</label>
                            <input type="text" class="form-control js-name" name="phone" value="<?= $row['phone'] ?>" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>cin :</label>
                            <input type="text" class="form-control js-name" name="cin" value="<?= $row['cin'] ?>" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>date de naissance :</label>
                            <input type="text" class="form-control js-name" name="date_n" value="<?= $row['date_N'] ?>">
                        </div>
                        <div class="form-group col-lg-6">
                            <label>résidence :</label>
                            <input type="text" class="form-control js-name" name="addresse" value="<?= $row['addresse'] ?>" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>sexe :</label>
                            <select class="form-control" name="sexe">
                                <?php if ($row['sexe'] == 'femme') {
                                    echo '<option value="femme" class="option">femme</option>
                                          <option value="homme" class="option">homme</option>';
                                } else {
                                    echo '<option value="homme" class="option">homme</option>
                                              <option value="femme" class="option">femme</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>ville :</label>
                            <select class="form-control" name="ville">
                                <!-- it will display 'les villes' from our database  -->
                                <?php
                                $ress = select_query('villes', 'id,ville', 0);
                                echo '<option value="' . $v_id . '">' . $ville['ville'] . '</option>';
                                while ($roww = mysqli_fetch_array($ress)) {
                                    if ($roww['ville'] != $ville['ville'])
                                        echo '<option value="' . $roww['id'] . '">' . $roww['ville'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class=" modal-footer modal-footerx">
                        <button type="submit" class="btn btn-success" name="personal">Modifier</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end of modal 1 -->

<!-- modal 2 -->
<div class="modal fade" id="change_academic_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modifier infos</h5>
            </div>
            <div class="modal-body">
                <form action="main/update-candidat-infos.php" method="post">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>cne :</label>
                            <input type="text" class="form-control js-name" name="cne" value="<?= $row['cne'] ?>" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Filière de bac :</label>
                            <select id="first_select" class="form-control" name="bac_filiere">
                                <!-- it will display 'les filieres de bac' from our database  -->
                                <?php
                                $ress = select_query('filiere', 'id,title', 0);
                                echo '<option value="' . $row['filiere_bac_id'] . '">' . $bac_filiere['title'] . '</option>';
                                while ($roww = mysqli_fetch_array($ress)) {
                                    if ($roww['title'] != $bac_filiere['title'])
                                        echo '<option value="' . $roww['id'] . '">' . $roww['title'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Année de baccalauréat :</label>
                            
                            <select class="form-control js-name" name="bac_annee">
                                <?php
                                $date = date("Y");
                                //
                                if ( $row['annee_bac'] == $date - 1) {
                                    echo '<option value="' . $date - 1 . '">' . $date - 1 . '</option>';
                                    echo '<option value="' . $date . '">' . $date . '</option>';
                                } else {
                                    echo '<option value="' . $date . '">' . $date . '</option>';
                                    echo '<option value="' . $date - 1 . '">' . $date - 1 . '</option>';
                                }
                                //
                                ?>
                            </select>
                        

                        </div>
                        <div class="form-group col-lg-6">
                            <label>Note de national :</label>
                            <input type="number" class="form-control js-name" name="national_note" value="<?= $row['national_note'] ?>" min="1" max="20" step="0.01" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Note de régional :</label>
                            <input type="number" class="form-control js-name" name="regio_note" value="<?= $row['regio_note'] ?>" step="0.01" min="1" max="20" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Choix1 :</label>
                            <select id="first_select" class="form-control" name="choix1">
                                <!-- it will display 'les choix' from our database  -->
                                <?php
                                $ress = select_query('departements', 'id,filiere', 0);
                                echo '<option value="' . $row['choix1'] . '">' . $choix1['filiere'] . '</option>';
                                while ($roww = mysqli_fetch_array($ress)) {
                                    if ($roww['filiere'] != $choix1['filiere'])
                                        echo '<option value="' . $roww['id'] . '">' . $roww['filiere'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Choix2 :</label>
                            <select id="first_select" class="form-control" name="choix2">
                                <!-- it will display 'les choix' from our database  -->
                                <?php
                                $ress = select_query('departements', 'id,filiere', 0);
                                echo '<option value="' . $row['choix2'] . '">' . $choix2['filiere'] . '</option>';
                                while ($roww = mysqli_fetch_array($ress)) {
                                    if ($roww['filiere'] != $choix2['filiere'])
                                        echo '<option value="' . $roww['id'] . '">' . $roww['filiere'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class=" modal-footer modal-footerx">
                        <button type="submit" class="btn btn-success" name="academic">Modifier</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end of modal 2 -->

<!-- modal 3 -->
<div class="modal fade" id="change_files_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modifier documents</h5>
            </div>
            <div class="modal-body">
                <form action="main/update-candidat-infos.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label>Bac diplôme (.pdf) :</label>
                            <input type="file" class="form-control js-name" name="bac" accept="application/pdf">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>Relevé de bac (.pdf) :</label>
                            <input type="file" class="form-control js-name" name="releve" accept="application/pdf">
                        </div>
                        <div class="form-group col-lg-12">
                            <label>photo :</label>
                            <input type="file" class="form-control js-name" name="photo" accept="image/jpg,image/jpeg,image/png">
                        </div>


                    </div>
                    <div class=" modal-footer modal-footerx">
                        <button type="submit" class="btn btn-success" name="document">Modifier</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end of modal 3 -->
<?php
}
?>
