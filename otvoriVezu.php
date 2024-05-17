<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "vjezba06";

    $veza = mysqli_connect($servername, $username, $password, $database);

    if (mysqli_connect_errno()){
        echo "Pogreška kod spajanja na poslužitelj" . mysqli_connect_error();
        //exit();
    } else {
        //echo "Spojeni ste na poslužitelja!";
    }
    echo "<br/>";
?>