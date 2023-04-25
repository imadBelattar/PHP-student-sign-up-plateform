<?php
session_start();
include('includes/functions.php');

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $res = select_query('candidat', 'id,email,first_login,password', "email='$email' and password='$password'");
    //on verifier si on a le condidat entre les condidats du base de donnée
    if (mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_array($res);
        // this below variable is the main variable to test the session!!!
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['first_login'] = $row['first_login'];
        $_SESSION['id'] = $row['id'];
        //si l'etudiant va connecter la premiere fois tester l'attribut first_login :::
        if ($_SESSION['first_login'] == 'yes')
            header('location: formSP/steps.php');
        else {
            header('location: old_candidat.php');
        }
    } else {
        /* unset($_GET['status']); */
        echo '<div class="alert alert-danger" id="target" role="alert">
 vérifiez votre email ou votre mot de passe et réessayez ! <img width="22" class="close_alert" src="img/not.png" alt="" onclick="hide()">
</div>';
    }
} ?>


<html>
<?php include('included_index.php');

if (isset($_SESSION['registered'])) echo '<div class="alert alert-success" id="target" role="alert">
 Votre compte a été créé avec succès <img width="22" class="close_alert" src="img/valid.png" alt="" onclick="hide()">
</div>';
unset($_SESSION['registered']);

?>
<div class="scroll-left">
    <?php
    // select the end date of the pre-inscription ****
    $res = select_query('inscription', 'MAX(id)', 0);
    $row = mysqli_fetch_array($res);
    $last_id = $row[0];
    $res = select_query('inscription', 'endDate', "id=$last_id");
    $row = mysqli_fetch_array($res);
    $_SESSION['endDate'] = $row['endDate'];
    ?>
    <h5>Avis aux candidats : le dernier délai pour terminer le pré-inscription est le <b><u><?= $row['endDate'] ?></u></b> !! </h5>
</div>
<div class="l">
    <div class="lf ">
        <form class="form-container" action="" method="post">
            <h5>------- réservé aux candidats -------</h5>
            <div>
                <input class="in" type="text" name="email" placeholder="email" required>
            </div>
            <div>
                <input class="in" type="password" name="password" id="mypassword" placeholder="password" required>
                <div class="form-group">
                    <div class=check>
                        <input type="checkbox" onclick="myFunction()">
                        <h6>show password</h6>
                    </div>



                    <div class="btndiv">
                        <input class="btn btn-primary log" type="submit" name="login" value="se connecter">
                    </div>
                    <div class="acc"><a href="create_acc.php">
                            <u>créer un compte</u>
                        </a>
                    </div>
                    <div class="pwdFG"><a href="http://www.ests.uca.ma/">
                            <u>EST safi site web</u>
                        </a>
                    </div>
        </form>


    </div>
</div>


<style>
    .close_alert:hover {
        cursor: pointer;

    }

    /* form styling */
    .acc {
        margin-left: 63%;
        margin-top: 10px;
        font-weight: bold;
    }

    .pwdFG {
        /* margin-left: 63%; */
        margin-top: -23px;
        /* font-weight: bold; */

    }

    .lf {
        padding: 30px;
        padding-bottom: 10px;
        width: max-content;
        /* position: fixed; */
        margin: 30px auto;
        height: fit-content;
        display: block;
        background-color: rgb(255, 255, 255);
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);


    }

    .lf .in {
        padding: 10px;
        margin: 15px auto;
        background-color: transparent;
        width: 100%;
        height: 55px;
        outline: none;
        border: 1px solid black;
        border-radius: 4px;

    }

    .in::placeholder {
        color: rgb(45, 46, 51);
        font-size: 0.9rem;
        font-weight: bold;


    }

    .l {
        /* padding-top: 18vh; */
        /* background-color: rgba(0, 112, 43,0.6); */
        /* width: 30%; */
        padding: 0;

    }

    .in:focus {
        /*  background: rgba(149, 134, 134, 0.212); */
        border: 1px solid #007bff;
    }

    .btn {
        padding: 9px;
        border-radius: 5px;
        width: 54vh;
        cursor: pointer;
        display: inline-block;
        position: relative;
        margin-top: 15px;
    }

    /*  .log{
    width: 100%;
     } */

    .check h5 {
        margin: 0;
        font-family: cursive;
        color: #000000;
        width: 222px;
    }

    .check {
        display: flex;
        justify-content: space-between;
        width: 38%;
    }

    /*    .n1 {
        border: 1px solid white;
        border-radius: 5px;
    }
 */
    .scroll-left {
        height: 50px;
        overflow: hidden;
        position: relative;
        background: #F0F0F0;
        color: red;
        border: 1px solid green;
    }

    .scroll-left h5 {
        position: absolute;
        width: 100%;
        height: 100%;
        margin: 0;
        line-height: 50px;
        text-align: center;
        /* Starting position */
        transform: translateX(100%);
        /* Apply animation to this element */
        animation: scroll-left 14s linear infinite;
    }

    /* designing the alerts ******* */
    .alert-success {
        margin: 60px 15%;
        width: fit-content;
        position: fixed;
        z-index: 1;
    }

    .alert-danger {
        margin: 120px 33%;
        width: fit-content;
        position: fixed;
        z-index: 1;
    }


    /* Move it (define the animation) */
    @keyframes scroll-left {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>
<script>
    function hide() {
        document.getElementById("target").style.display = "none";
    }
    let elem = document.getElementsByClassName('n1');
    elem[0].classList.add('active')

    function myFunction() {
        var x = document.getElementById("mypassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    //prevent the form from resubmition*******
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>