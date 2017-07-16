<?php
    if (isset($_GET['q'])) {
        $term = trim($_GET['q']);
        $sql = "SELECT id, Name FROM `schuldner` WHERE Name LIKE '%".$term."%'";
        if (isset($_GET['not'])) {
            //$json = json_decode($_GET['not']);
            $json = $_GET['not']['data'];
            if (count($json) > 0) {
                $sql .= " AND id NOT IN (";
                foreach ($json as $key => $value) {
                    $sql .= " '" .$value . "',";
                }
                $sql = substr($sql, 0, -1) ." );";
            }
        }
    } else {
        $sql = "SELECT id, Name FROM `schuldner`";
        if (isset($_GET['not'])) {
            //$json = json_decode($_GET['not']);
            $json = $_GET['not']['data'];
            if (count($json) > 0) {
                $sql .= " AND id NOT IN (";
                foreach ($json as $key => $value) {
                    $sql .= " '" .$value . "',";
                }
                $sql = substr($sql, 0, -1) ." );";
            }
        }
    }
    require_once("db.php");
    $db_erg = mysqli_query($db_link, $sql) or die("false" . mysqli_error($db_link));
    $rows = array();
    $i = 0;
    while($r = mysqli_fetch_assoc($db_erg)) {
        $rows[$i]['label'] = $r['Name'];
        $rows[$i]['value'] = $r['id'];
        $i++;
    }
    print json_encode($rows);
    //print '[{"label":"My fancy name","value":"229"}]';
?>