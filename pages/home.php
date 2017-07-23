<div class="col-md-6">
    <label for="personen">Personen wählen an die geld geschuldet wird</label>
    <select class="form-control" id="personenPicker">
        <option value="all">Alle</option>
        <?php
            require_once("../vendor/db.php");
            $sql = "SELECT personen.id, personen.Name FROM `personen`, `schulden` WHERE personen.id = schulden.zahler GROUP BY personen.id;";
            $db_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
            while ($zeile = mysqli_fetch_array( $db_erg)) {
                echo "<option ";
                if (isset($_GET['p']) && (string)$_GET['p'] == (string)$zeile['id']) {
                    echo "selected ";
                }
                echo "value='".$zeile['id']."'>".$zeile['Name']."</option>";
            }
        ?>
    </select>
</div><br><br><br>
<div id="chart">

</div>
<?php
    if (isset($_GET['p'])) {
        $sql = "SELECT schulden.id, schulden.betrag, personen.Name, schulden.intervalTime, schulden.endDate, schulden.startDate, schulden.datum FROM `personen`, `schulden` WHERE personen.id = schulden.zahler AND personen.id = ".$_GET['p'].";";
    } else {
        $sql = "SELECT * FROM `schulden` WHERE 1";
    }
    $db_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
    $personSum = [];
    while ($zeile = mysqli_fetch_array($db_erg))
    {
        $sql = "SELECT Personen.Name FROM schulden_Personen, Personen WHERE (schulden_Personen.PersonenId = Personen.id) AND (schulden_Personen.schuldenId = ".$zeile['id']." )";
        $Namen_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
        $betragPerson = round($zeile['betrag']/ mysqli_num_rows($Namen_erg), 2);
        while ($name = mysqli_fetch_array( $Namen_erg)){
            if (!isset($personSum[$name['Name']])) {
                $personSum[$name['Name']] = 0;
            }
            if ($zeile['intervalTime']) {
                $endDate = "";
                if ($zeile['endDate']) {
                    $endDate = $zeile['endDate'];
                    $endDate = new DateTime($endDate);
                } else {
                    $endDate = new DateTime(Date("Y-m-d"));
                }
                $start = new DateTime($zeile['startDate']);
                $interval = date_diff($start, $endDate);
                $interval = $interval->m + ($interval->y * 12);
           
                $interval = ($interval+1)/$zeile['intervalTime'];
                $personSum[$name['Name']] +=  ($betragPerson * $interval);
            } else {
                $personSum[$name['Name']] += $betragPerson;
            }
        }
    }
?>
<script>
    $('#personenPicker').change(function() {
        if ($('#personenPicker option:selected').val() == "all") {
            $.ajax({
                url: "./pages/home.php",
                type: 'get',
                success: function(data){ 
                    $("div#site").html(data);
                },
                error: function(){
                    alert('error!');
                }
            });
            return;
        }
        $.ajax({
            url: "./pages/home.php?p="+$('#personenPicker option:selected').val(),
            type: 'get',
            success: function(data){ 
                $("div#site").html(data);
            },
            error: function(){
                alert('error!');
            }
        });
    });
    var chartC3 = c3.generate({
        data: {
            columns: <?php
                    echo "[";
                    $count = 0;
                    foreach ($personSum as $key => $value) {
                        if ($count != 0) {
                            echo ", ";
                        } else {
                            $count++;
                        }
                        echo '["' . $key . '", '. $value . "]";
                    }
                    echo "]";
            ?>,
            type: 'bar'
        },
        bar: {
            width: {
                ratio: 0.5 // this makes bar width 50% of length between ticks
            }
            // or
            //width: 100 // this makes bar width 100px
        }
    });
</script>