<?php
    session_start();
    // require "../components/database.php";

    if (!isset($_SESSION['numero'])) {
        header('Location: ./pages/login.php');    
    }
?>