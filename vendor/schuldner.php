<?php
    require_once("db.php");
    if (isset($_POST['name'])) {
        //TODO: SQL Befehl
        $sql = "INSERT INTO `schuldner` (`Name`) VALUES ('" . $_POST['name'] . "');";
        $db_erg = mysqli_query($db_link, $sql) or die("false" . mysqli_error());
    }
?>