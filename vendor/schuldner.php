<?php
    require_once("db.php");
    if (isset($_POST['name'])) {
        $sql = "INSERT INTO `schuldner` (`Name`) VALUES ('" . $_POST['name'] . "');";
        mysqli_query($db_link, $sql) or die("false" . mysqli_error());
        exit();
    }
    if (isset($_POST['dataid'])) {
        $sql = "DELETE FROM `schuldner` WHERE `schuldner`.`id` = ". $_POST['dataid'] ;
        mysqli_query($db_link, $sql) or die("false" . mysqli_error());
        exit();
    }
    $sql = "SELECT * FROM `schuldner`;";
    $db_erg = mysqli_query($db_link, $sql) or die("false" . mysqli_error());
    while ($zeile = mysqli_fetch_array( $db_erg))
    {
        echo "<tr>";
        echo "<td>". $zeile['Name'] . "</td>";
        echo "<td><button class='btn btn-danger removeSchuldner' data-db='".$zeile['id']."'><span class='glyphicon glyphicon-trash'></span></button></td>";
        echo "</tr>";
    }
?><
<script>
    $(".removeSchuldner").click(function() {
        var dataid = $(this).attr("data-db");
        dataid = {"dataid": dataid};
        var element = $(this);
        $.ajax({
            type: 'POST',
            url: "./vendor/schuldner.php",
            data: dataid,
            dataType: "text",
            success: function(data) { 
                if (data == "") {
                    console.log("Remove Row");
                    console.log($(this));
                    element.closest("tr").remove();
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    });
</script>