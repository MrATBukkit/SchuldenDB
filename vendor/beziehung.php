<?php
    if ((!isset($_POST['schuldenId'])) || (!isset($_POST['PersonenIds']))) {
        exit(0);
    }
    require_once("db.php");
    $sql = "";
    foreach ($_POST['PersonenIds'] as $key => $value) {
        $sql .= "INSERT INTO `schulden_Personen` (`schuldenId`, `PersonenId`) VALUES ('".$_POST['schuldenId']."', '".$value."'); ";
        
    }
    mysqli_multi_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
?>