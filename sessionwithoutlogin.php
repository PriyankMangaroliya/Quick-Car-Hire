<?php

if ($_SESSION['loggedin'] != true) {
    header("Location: login.php");
}
