<?php
    $sql = "SELECT schulden.betrag FROM Personen, schulden_Personen, schulden WHERE Personen.id = schulden_Personen.PersonenId AND schulden.id = schulden_Personen.schuldenId AND Personen.id = 72";
    $sql = "SELECT schulden.betrag FROM Personen, schulden_Personen, schulden WHERE Personen.id = schulden_Personen.PersonenId AND schulden.id = schulden_Personen.schuldenId AND Personen.id = SELECT id FROM Personen";
    //SELECT id FROM Personen
?>