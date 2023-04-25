<?php

include('index.php');

if (isset($_SESSION['infos'])) {
    echo '<div class="alert alert-danger indxalert" id="target" role="alert">
 verifiez vos informations, vos choix (les fichiers : la photo, la copie de bac ou relevé de bac....) et réessayer!!  <img width="22" class="close_alert" src="../img/not.png" alt="" onclick="hide()">
</div>';
unset($_SESSION['infos']);
}
if (isset($_SESSION['register'])) {
    echo '<div class="alert alert-danger indxalert" id="target" role="alert">
 une erreur est produite lors l\'enregistrement!!!<img width="22" class="close_alert" src="../img/not.png" alt="" onclick="hide()">
</div>';
    unset($_SESSION['register']);
}
