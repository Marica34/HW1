<?php 
    /*******************************************************
        Controlla che l'username sia unico
    ********************************************************/
    require_once 'dbconfigurazione.php';

    if (!isset($_GET["q"])) {
        echo "Non dovresti essere qui";
        exit;
    }

    header('Content-Type: application/json');
    
    $conn = mysqli_connect($dbconfigurazione['host'], $dbconfigurazione['user'], $dbconfigurazione['password'], $dbconfigurazione['name']);

    $cf = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "SELECT cf FROM persona WHERE cf = '$cf'";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode(array('exists' => mysqli_num_rows($res) > 0 ? true : false));

    mysqli_close($conn);
?>