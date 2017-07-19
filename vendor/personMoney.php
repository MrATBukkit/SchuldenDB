<?php
    require_once("db.php");
    $sql = "SELECT * FROM `schulden` WHERE 1";
    $db_erg = mysqli_query($db_link, $sql) or die("Error: " . mysqli_error($db_link));
    $personSum = [];
    while ($zeile = mysqli_fetch_array( $db_erg))
    {
        $sql = "SELECT schuldner.Name FROM schulden_schuldner, schuldner WHERE (schulden_schuldner.schuldnerId = schuldner.id) AND (schulden_schuldner.schuldenId = ".$zeile['id']." )";
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
    //array_slice($personSum, "Hermann", 1);
    echo json_encode($personSum);
?>