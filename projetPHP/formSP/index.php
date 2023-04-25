<?php
session_start();
if (!isset($_SESSION['email']))
header('location: ../logout.php');
else {
    
include('../includes/functions.php');
?>
<!DOCTYPE html>
<html>

<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <link rel="shortcut icon" href="../est.png">
    <meta charset="utf-8">
    <title>les informations de condidat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.css">

    <!-- DATE-PICKER -->
    <link rel="stylesheet" href="vendor/date-picker/css/datepicker.min.css">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <button class="btn btn-warning logout" data-toggle="modal" data-target="#exampleModal" onclick="window.location.href='../logout.php'">déconnectez-vous</button>

    <div class="wrapper">
        <form action="../new_candidat.php" id="wizard" method="POST" enctype="multipart/form-data">
            <!-- SECTION 1 -->
            <h4></h4>
            <section>
                <h3>étape 1</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            nom
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account-o"></i>
                            <input type="text" class="form-control" <?php if (isset($_SESSION['nom'])) {
                                                                        echo 'value="' . $_SESSION['nom'] . '"';
                                                                        unset($_SESSION['nom']);
                                                                    } ?> name="nom">
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            prenom
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-edit"></i>
                            <input type="text" class="form-control" <?php if (isset($_SESSION['prenom'])) {
                                                                        echo 'value="' . $_SESSION['prenom'] . '"';
                                                                        unset($_SESSION['prenom']);
                                                                    } ?> name="prenom">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            Adresse de résidence
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-email"></i>
                            <input type="text" class="form-control" <?php if (isset($_SESSION['residence'])) {
                                                                        echo 'value="' . $_SESSION['residence'] . '"';
                                                                        unset($_SESSION['residence']);
                                                                    } ?> name="residence">
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            numéro de telephone
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-smartphone-android"></i>
                            <input type="phone" class="form-control" <?php if (isset($_SESSION['phone'])) {
                                                                            echo 'value="' . $_SESSION['phone'] . '"';
                                                                            unset($_SESSION['phone']);
                                                                        } ?> name="phone" placeholder="Ex : 06XXXXXXXX">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            votre CIN
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-spellcheck"></i>
                            <input type="text" class="form-control" <?php if (isset($_SESSION['cin'])) {
                                                                        echo 'value="' . $_SESSION['cin'] . '"';
                                                                        unset($_SESSION['cin']);
                                                                    } ?> name="cin">
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            Date de naissance
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-calendar"></i>
                            <input type="text" class="form-control datepicker-here" <?php if (isset($_SESSION['dateN'])) {
                                                                                        echo 'value="' . $_SESSION['dateN'] . '"';
                                                                                        unset($_SESSION['dateN']);
                                                                                    } ?> data-language='en' data-date-format="dd - mm - yyyy" id="dp1" name="dateN">
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 2 -->
            <h4></h4>
            <section>
                <h3>étape 2</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            Sexe
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-male-female"></i>
                            <select class="form-control" name="sexe">
                                <?php if (isset($_SESSION['sexe']) && $_SESSION['sexe'] == 'femme') {
                                    echo '<option value="femme" class="option">femme</option>
                                          <option value="homme" class="option">homme</option>';
                                    unset($_SESSION['sexe']);
                                } else {
                                    echo '<option value="homme" class="option">homme</option>
                                              <option value="femme" class="option">femme</option>';
                                } ?>
                            </select>
                            <i class="zmdi zmdi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            votre filière de baccalauréat
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-book"></i>
                            <select id="" class="form-control" name="bac_filiere">
                                <!-- it will display 'les filieres' from our database  -->
                                <?php
                                $res = select_query('filiere', 'title', 0);
                                //
                                if (isset($_SESSION['bac_filiere'])) {
                                    echo '<option value="' . $_SESSION['bac_filiere'] . '">' . $_SESSION['bac_filiere'] . '</option>';
                                    while ($row = mysqli_fetch_array($res)) {
                                        if ($row['title'] != $_SESSION['bac_filiere'])
                                            echo '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';
                                    }
                                    unset($_SESSION['bac_filiere']);
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';
                                    }
                                }
                                //
                                ?>
                            </select>
                            <i class="zmdi zmdi-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            votre CNE
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-spellcheck"></i>
                            <input type="text" class="form-control" <?php if (isset($_SESSION['cne_code'])) {
                                                                        echo 'value="' . $_SESSION['cne_code'] . '"';
                                                                        unset($_SESSION['cne_code']);
                                                                    } ?> name="cne_code">
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            ville
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-pin-drop"></i>
                            <select id="" class="form-control" name="ville">
                                <!-- it will display 'les villes' from our database  -->
                                <?php
                                $res = select_query('villes', 'ville', 0);
                                //
                                if (isset($_SESSION['ville'])) {
                                    echo '<option value="' . $_SESSION['ville'] . '">' . $_SESSION['ville'] . '</option>';
                                    while ($row = mysqli_fetch_array($res)) {
                                        if ($row['ville'] != $_SESSION['ville'])
                                            echo '<option value="' . $row['ville'] . '">' . $row['ville'] . '</option>';
                                    }
                                    unset($_SESSION['ville']);
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo '<option value="' . $row['ville'] . '">' . $row['ville'] . '</option>';
                                    }
                                }
                                //
                                ?>
                            </select>
                            <i class="zmdi zmdi-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            année de baccalauréat
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-calendar-alt"></i>
                            <select id="" class="form-control" name="bac_annee">
                                <?php
                                $date = date("Y");
                                //
                                if (isset($_SESSION['bac_annee']) && $_SESSION['bac_annee'] == $date - 1) {
                                    echo '<option value="' . $date - 1 . '">' . $date - 1 . '</option>';
                                    echo '<option value="' . $date . '">' . $date . '</option>';
                                    unset($_SESSION['bac_annee']);
                                } else {
                                    echo '<option value="' . $date . '">' . $date . '</option>';
                                    echo '<option value="' . $date - 1 . '">' . $date - 1 . '</option>';
                                }
                                //
                                ?>
                            </select>
                            <i class="zmdi zmdi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            photo
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-account-circle"></i>
                            <input type="file" accept="image/jpg,image/jpeg,image/png" class="form-control" name="photo">
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION 3 -->
            <h4></h4>
            <section>
                <h3>étape 3</h3>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            note de régional
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-spellcheck"></i>
                            <input type="number" class="form-control" <?php if (isset($_SESSION['regional'])) {
                                                                            echo 'value="' . $_SESSION['regional'] . '"';
                                                                            unset($_SESSION['regional']);
                                                                        } ?> name="regional" step="0.01" min="0" max="20">
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            note de national
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-spellcheck"></i>
                            <input type="number" class="form-control" name="national" <?php if (isset($_SESSION['national'])) {
                                                                                            echo 'value="' . $_SESSION['national'] . '"';
                                                                                            unset($_SESSION['national']);
                                                                                        } ?> step="0.01" min="0" max="20">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            une copie de baccaluréat (.PDF)
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-file-text"></i>
                            <input type="file" accept="application/pdf" class="form-control" name="bac_scan">
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            un relevé de baccaluréat (.PDF)
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-file-text"></i>
                            <input type="file" accept="application/pdf" class="form-control" name="releve_scan">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="">
                            première choix :
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-plus-circle"></i>
                            <select id="first_select" class="form-control" name="choix1">
                                <!-- it will display 'les choix' from our database  -->
                                <?php
                                $res = select_query('departements', 'filiere', 0);
                                //
                                if (isset($_SESSION['choix1'])) {
                                    echo '<option value="' . $_SESSION['choix1'] . '">' . $_SESSION['choix1'] . '</option>';
                                    while ($row = mysqli_fetch_array($res)) {
                                        if ($row['filiere'] != $_SESSION['choix1'])
                                            echo '<option value="' . $row['filiere'] . '">' . $row['filiere'] . '</option>';
                                    }
                                    unset($_SESSION['choix1']);
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo '<option value="' . $row['filiere'] . '">' . $row['filiere'] . '</option>';
                                    }
                                }
                                //
                                ?>
                            </select>
                            <i class="zmdi zmdi-chevron-down"></i>
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="">
                            deuxième choix :
                        </label>
                        <div class="form-holder">
                            <i class="zmdi zmdi-plus-circle"></i>
                            <select id="second_select" class="form-control" name="choix2">
                                <!-- it will display 'les choix' from our database  -->
                                <?php
                                $res = select_query('departements', 'filiere', 0);
                                // 
                                if (isset($_SESSION['choix2'])) {
                                    echo '<option value="' . $_SESSION['choix2'] . '">' . $_SESSION['choix2'] . '</option>';
                                    while ($row = mysqli_fetch_array($res)) {
                                        if ($row['filiere'] != $_SESSION['choix2'])
                                            echo '<option value="' . $row['filiere'] . '">' . $row['filiere'] . '</option>';
                                    }
                                    unset($_SESSION['choix2']);
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo '<option value="' . $row['filiere'] . '">' . $row['filiere'] . '</option>';
                                    }
                                }
                                //
                                ?>
                            </select>
                            <i class="zmdi zmdi-chevron-down"></i>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary terminer" type="submit" name="terminer">terminer</button>
            </section>


            <script>
            </script>



        </form>
    </div>
    <style>
        /* the logout button */
        .logout {
            position: fixed;
            top: 20px;
            left: 85%;
            z-index: 9999;
            height: 50px;
            font-weight: bold;
        }

        /* the button to close the error alert */
        .close_alert:hover {
            cursor: pointer;

        }

        .alert-danger {
            left: 21%;
            top: 130px;
            width: fit-content;
            position: fixed;
            z-index: 1;
        }

        .terminer {
            width: 100%;
        }

        .hdd {
            display: none !important;
        }
    </style>
    <script defer>
        var v = document.getElementsByClassName('form-holder')
        for (let i = 0; i < v.length; i++) {
            document.getElementsByClassName('form-holder')[i].children[1].required = true
        }
    </script>

    <script src="js/jquery-3.3.1.min.js"></script>

    <!-- JQUERY STEP -->
    <script src="js/jquery.steps.js"></script>

    <!-- DATE-PICKER -->
    <script src="vendor/date-picker/js/datepicker.js"></script>
    <script src="vendor/date-picker/js/datepicker.en.js"></script>

    <script src="js/main.js"></script>

    <!-- Template created and distributed by Colorlib -->
</body>
<script>
    function hide() {
        document.getElementById("target").style.display = "none";
    }
    //prevent the form from resubmition*******
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>
<?php } ?>