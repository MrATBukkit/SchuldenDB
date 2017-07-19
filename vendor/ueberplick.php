<?php
    $sql = "SELECT schulden.betrag FROM schuldner, schulden_schuldner, schulden WHERE schuldner.id = schulden_schuldner.schuldnerId AND schulden.id = schulden_schuldner.schuldenId AND schuldner.id = 72";
    $sql = "SELECT schulden.betrag FROM schuldner, schulden_schuldner, schulden WHERE schuldner.id = schulden_schuldner.schuldnerId AND schulden.id = schulden_schuldner.schuldenId AND schuldner.id = SELECT id FROM schuldner";
    //SELECT id FROM schuldner
?>