<?php
session_start();
include('includes/functions.php');
include('included_index.php');
if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $res = select_query('admin', '*', "email='$email' and password='$password'");
    if (mysqli_num_rows($res) != 0) {
        $row = mysqli_fetch_array($res);
        $_SESSION['email'] = $row['email'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['nom'] = $row['nom'];
        $_SESSION['prenom'] = $row['prenom'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['admin'] = true;
        $res = select_query('inscription', 'MAX(id)', 0);
         $rwo = mysqli_fetch_array($res);
         $_SESSION['inscription_id'] = $rwo[0];
        header('location: admin/admin-candidats.php');
    } else {
        /* unset($_GET['status']); */
        echo '<div class="alert alert-danger" id="target" role="alert">
 vérifiez votre email ou votre mot de passe et réessayez ! <img width="22" class="close_alert" src="img/not.png" alt="" onclick="hide()">
</div>';
    }
} ?>

<html>

<div class="l">
    <div class="lf ">
        <form class="form-container" action="" method="post">
            <h5>------- réservé au admin -------</h5>
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
                        <input class="btn btn-secondary log" type="submit" name="login" value="se connecter">
                    </div>
                    <div class="pwdFG"><a href="http://www.ests.uca.ma/">
                            <u>EST safi site web</u>
                        </a>
                    </div>
        </form>


    </div>
</div>


<style>
    .form-container h5 {
        color: red;
        font-weight: bolder;
        font-size: 125%;
        text-align: center;
    }

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

        margin-top: 8px;


    }

    .lf {
        padding: 30px;
        padding-bottom: 10px;
        width: max-content;
        /* position: fixed; */
        margin: 80px auto;
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
        margin: 50px 33%;
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
    let elem = document.getElementsByClassName('n2');
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