<?php
    /********************************************************
       Controlla che l'utente sia già autenticato, per non 
       dover chiedere il login ad ogni volta               
    *********************************************************/
    require_once 'dbconfigurazione.php';
    session_start();

    function checkAuth() {
        // Se esiste già una sessione, la ritorno, altrimenti ritorno 0
        if(isset($_SESSION['palaghiaccio_user_cf'])) {
            return $_SESSION['palaghiaccio_user_cf'];
        } else 
            return 0;
    }
?>