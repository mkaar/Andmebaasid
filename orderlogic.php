<?php
    include("database_connect.php");

    if($_GET["action"] == "pay"){
        $result = pg_query_params($con, "SELECT tellimus_id FROM tellimus WHERE isik_id=$1 AND tellimuse_seisundi_liik_kood = 1;", array($_SESSION["userId"]));
        $tellimuseId = 0;
        while ($row = pg_fetch_row($result)) {
            $tellimuseId = $row[0];
        }
        pg_query($con, "SELECT f_taida_tellimus({$tellimuseId})");
        //header("Location: ordered.php?added=true");
    } elseif ($_GET["action"] == "cancel"){
        $result = pg_query_params($con, "SELECT tellimus_id FROM tellimus WHERE isik_id=$1 AND tellimuse_seisundi_liik_kood = 1;", array($_SESSION["userId"]));
        while ($row = pg_fetch_row($result)) {
            pg_query_params($con, "SELECT f_tuhista_tellimus($1)", array($row[0]));
        }
        header("Location: index.php?canceled=true");
    } else {
        header("Location: ostukorv.php?error=t");
    }

?>