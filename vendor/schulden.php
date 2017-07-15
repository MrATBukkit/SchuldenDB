<?php
    require_once("db.php");
    if (isset($_POST['interval'])) {
        $sql = "INSERT INTO `schulden` 
            (`bezeichnung`, `betrag`, `intervalTime`, `startDate`)
                VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."', '".$_POST['interval']."', '".$_POST['start']."')";
            //VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."', '".$_POST['interval']."', '".$_POST['start']."';";
        print $sql;
        mysqli_query($db_link, $sql) or die("false" . mysqli_error($db_link));
        exit();
    }
    if (isset($_POST['bezeichnung'])) {
        $sql = "INSERT INTO `schulden` 
            (`bezeichnung`, `betrag`) 
            VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."')";
        mysqli_query($db_link, $sql) or die("false" . mysqli_error($db_link));
        exit();
    }
    $sql = "";
    $db_erg = mysqli_query($db_link, $sql) or die("false" . mysqli_error($db_link));
    while ($zeile = mysqli_fetch_array( $db_erg))
    {
        echo "<tr>";
        echo "<td>". $zeile['Name'] . "</td>";
        echo "<td><button class='btn btn-danger removeSchuldner' data-db='".$zeile['id']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
        echo "</tr>";
    }
?>
<!--
<table>
<?php 


    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }


?>
</table>
-->