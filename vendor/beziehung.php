<?php
    if ((!isset($_POST['schuldenId'])) || (!isset($_POST['SchuldnerIds']))) {
        exit(0);
    }
    require_once("db.php");
    $sql = "";
    foreach ($_POST['SchuldnerIds'] as $key => $value) {
        $sql .= "INSERT INTO `schulden_schuldner` (`schuldenId`, `schuldnerId`) VALUES ('".$_POST['schuldenId']."', '".$value."'); ";
        
    }
    mysqli_multi_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
?>