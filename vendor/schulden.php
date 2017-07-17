<?php
    require_once("db.php");
    if (isset($_POST['interval'])) {
        $sql = "INSERT INTO `schulden` 
            (`bezeichnung`, `betrag`, `intervalTime`, `startDate`)
                VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."', '".$_POST['interval']."', '".$_POST['start']."')";
            //VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."', '".$_POST['interval']."', '".$_POST['start']."';";
        mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
        print mysqli_insert_id($db_link);
        exit();
    }
    if (isset($_POST['bezeichnung'])) {
        $sql = "INSERT INTO `schulden` 
            (`bezeichnung`, `betrag`) 
            VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."')";
        mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
        print mysqli_insert_id($db_link);
        exit();
    }
    //$sql = "SELECT * FROM `schulden`, schulden_schuldner, schuldner WHERE (schulden_schuldner.schuldenId = schulden.id) AND (schulden_schuldner.schuldnerId = schuldner.id)";
    $sql = "SELECT * FROM `schulden` WHERE 1";
    $db_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
    while ($zeile = mysqli_fetch_array( $db_erg))
    {
        echo "<tr>";
        echo "<td>" .$zeile['bezeichnung']. "</td>";
        echo "<td>" .$zeile['betrag']. "</td>";
        if ($zeile['intervalTime']) {
            echo "<td></td>";
            echo "<td>" .$zeile['intervalTime']. "</td>";
            echo "<td>" .$zeile['startDate']. "</td>";
            echo "<td>" .$zeile['endDate']. "</td>";
        } else {
            echo "<td>---</td>";
            echo "<td>---</td>";
            echo "<td>" .$zeile['datum']. "</td>";
            echo "<td></td>";
        }
        echo "</tr>";
    }
?>