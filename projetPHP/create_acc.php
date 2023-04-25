<?php
session_start();

include('includes/functions.php');
//include('includes/footer.php');
if (isset($_POST['save'])) {
    $candidat_email = $_POST['email'];
    $new_password = md5($_POST['passwordN']);
    $confirm_password = md5($_POST['passwordC']);
    if ($new_password == $confirm_password) {
        $password = $confirm_password;
        $success = 1;
        $res = insert_query('candidat', 'email,password', "'$candidat_email','$password'");
        if ($res) {
            $_SESSION['registered'] = $success;
            header('location:index.php');
        } else {
            echo '<div class="alert alert-danger" id="target" role="alert">
 error durant la création du compte !!!<img width="25" src="img/not.png" alt="" onclick="hide()">
</div> ';
        }
    } else {
        echo '<div class="alert alert-danger" id="target" role="alert">
 Vérifiez vos informations et réessayez ! <img width="25" src="img/not.png" alt="" onclick="hide()">
</div> ';
    }
}




?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <link rel="shortcut icon" href="est.png">
    <title>creation du compte de candidature</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body class="blue">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h2 style="color: #fff">Créer votre compte de candidature </h2>
                </div>
                <div class="login-form">
                    <form action="" method="post">

                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" placeholder="email" required="true" name="email">
                        </div>
                        <div class="form-group">
                            <label>Nouveau Mot de passe</label>
                            <input type="password" class="form-control" name="passwordN" placeholder="Mot de passe" required="true">
                        </div>
                        <div class="form-group">
                            <label>Confirmer le Mot de passe</label>
                            <input type="password" class="form-control" name="passwordC" placeholder="Mot de passe" required="true">
                        </div>
                        <button type="submit" name="save" class="btn btn-primary">enregistrer</button>

                        <div class="checkbox" style="padding-bottom: 0;padding-top: 20px;">
                            <label class="danger">
                                <a href="index.php"><button type="button" class="btn btn-danger">Retour</button></a>
                            </label>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <style>
        .blue {
            background-color: #007bff;
        }

        .login-logo {
            margin-bottom: 30px;
            margin-top: 60px;
        }

        .alert-danger {
            margin: 3px;
            z-index: 9999;
            position: fixed;
        }
    </style>
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