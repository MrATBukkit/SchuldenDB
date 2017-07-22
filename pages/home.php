<div id="chart">

</div>
<?php
    require_once("../vendor/db.php");
    $sql = "SELECT * FROM `schulden` WHERE 1";
    $db_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
    $personSum = [];
    while ($zeile = mysqli_fetch_array( $db_erg))
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
    $result = [];
?>
<script>
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