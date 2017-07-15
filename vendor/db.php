<?php
    require_once ('konfig.php');
    $db_link = mysqli_connect (
                        MYSQL_HOST, 
                        MYSQL_BENUTZER, 
                        MYSQL_KENNWORT, 
                        MYSQL_DATENBANK
                        );
    if (! $db_link )
    {
        throw new Exception('Keine Verbindung zur Datenbank möglich');
    }
    mysqli_set_charset($db_link, 'utf8');
?>