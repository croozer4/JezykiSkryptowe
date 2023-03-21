<?php
    $zaszyfrowane_haslo = "6d2e5c94f358640abb41892220c100f93ef12574";
    $login = $_POST['login'];
    $haslo = $_POST['password'];

    if(hash_equals(sha1($haslo), $zaszyfrowane_haslo)){
        session_start();
        $_SESSION('login') = $login;
        header("Location: index.php");
    }
    else{
        header("Location: logowanie.php");
        
    }
?>