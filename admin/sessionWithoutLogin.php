<?php

session_start();
if ($_SESSION['islogin'] != true) {
    header("Location: index.php");
}
