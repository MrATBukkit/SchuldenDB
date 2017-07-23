<?php
    require_once("db.php");
    if (isset($_POST['interval'])) {
        $sql = "INSERT INTO `schulden` 
            (`bezeichnung`, `betrag`, `intervalTime`, `startDate`, `zahler`)
                VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."', '".$_POST['interval']."', '".$_POST['start']."', '".$_POST['zahler']."')";
            //VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."', '".$_POST['interval']."', '".$_POST['start']."';";
        mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
        print mysqli_insert_id($db_link);
        exit();
    }
    if (isset($_POST['bezeichnung'])) {
        $sql = "INSERT INTO `schulden` (`bezeichnung`, `betrag`, `zahler`) VALUES ('".$_POST['bezeichnung']."', '".$_POST['betrag']."', '".$_POST['zahler']."')";
        mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
        print mysqli_insert_id($db_link);
        exit();
    }
    if (isset($_POST['endeId'])) {
        $sql = "UPDATE `schulden` SET `endDate` = CURRENT_TIMESTAMP WHERE `schulden`.`id` = ".$_POST['endeId'].";";
        mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
        exit();
    }
    //$sql = "SELECT * FROM `schulden`, schulden_Personen, Personen WHERE (schulden_Personen.schuldenId = schulden.id) AND (schulden_Personen.PersonenId = Personen.id)";
    $sql = "SELECT * FROM `schulden` WHERE 1";
    $db_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
    while ($zeile = mysqli_fetch_array( $db_erg))
    {
        echo "<tr>";
            echo "<td>" .$zeile['bezeichnung']. "</td>";
            echo "<td>" .$zeile['betrag']. "</td>";
            $sql = "SELECT Personen.Name FROM schulden_Personen, Personen WHERE (schulden_Personen.PersonenId = Personen.id) AND (schulden_Personen.schuldenId = ".$zeile['id']." )";
            $Namen_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
            $betragPerson = round($zeile['betrag']/ mysqli_num_rows($Namen_erg), 2);
            echo "<td>";
                while ($name = mysqli_fetch_array( $Namen_erg)){
                    echo $name['Name'].": ".$betragPerson." € <br>";
                }
            echo "</td>";
            if ($zeile['intervalTime']) {
                echo "<td>" .$zeile['intervalTime']. "</td>";
                echo "<td>" .$zeile['startDate']. "</td>";
                if (isset($zeile['endDate'])) {
                    echo "<td>" .$zeile['endDate']. "</td>";
                } else {
                    echo "<td><button class='btn btn-danger ende' data-db-id='".$zeile['id']."'>Stoppen</button></td>";
                }
            } else {
                echo "<td>---</td>";
                echo "<td>---</td>";
                echo "<td>" .$zeile['datum']. "</td>";
            }
        echo "</tr>";
    }
?>
<script>
    $('button.btn.ende').click(function() {
        var id = $(this).attr('data-db-id');
        var url = "./vendor/schulden.php";
        $.post( url, { endeId: id }, function(data) {bezeichnungPost(data);});
        var currentDate = new Date();
        var DateIsoString = currentDate.toISOString();
        DateIsoString = DateIsoString.substr(0, DateIsoString.indexOf("T"));
        $(this).closest("td").html(DateIsoString);
    });
</script>