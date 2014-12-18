<?php
include("navigation.php");
include("database_connect.php");

if(isset($_GET["itemId"]) && isset($_SESSION["username"]) && isset($_GET["action"]) && $_GET["action"] == 'add'){

    $result = pg_query_params($con, "SELECT tellimus_id FROM tellimus WHERE isik_id = $1 AND tellimuse_seisundi_liik_kood = 1", array($_SESSION["userId"]));
    $hinnaResult = pg_query_params($con, "SELECT hind FROM toode WHERE toode_id = $1", array($_GET["itemId"]));

    if(pg_num_rows($result) > 0){
        $tellimusId = 0;
        $hind = 0;

        while ($row = pg_fetch_row($result)) {
            $tellimusId = $row[0];
        }
        while ($row = pg_fetch_row($result)) {
            $hind = $row[0];
        }
        pg_query($con, "INSERT INTO ostutellimuse_rida ('tellimus_id', 'toode_id', 'kogus', 'uhiku_hind') VALUES ({$tellimusId}, {$_GET["itemId"]}, 1, {$hind})");


    } else {
        pg_query($con, "INSERT INTO tellimus ('tellimuse_seisundi_liik_kood', 'isik_id') VALUES (1, {$_SESSION["userId"]})");
        $result = pg_query_params($con, "SELECT tellimus_id FROM tellimus WHERE isik_id = $1 AND tellimuse_seisundi_liik_kood = 1", array($_SESSION["userId"]));
        $hinnaResult = pg_query_params($con, "SELECT hind FROM toode WHERE toode_id = $1", array($_GET["itemId"]));
        if (pg_num_rows($result) > 0) {
            $tellimusId = 0;
            $hind = 0;

            while ($row = pg_fetch_row($result)) {
                $tellimusId = $row[0];
            }
            while ($row = pg_fetch_row($result)) {
                $hind = $row[0];
            }
            pg_query($con, "INSERT INTO ostutellimuse_rida ('tellimus_id', 'toode_id', 'kogus', 'uhiku_hind') VALUES ({$tellimusId}, {$_GET["itemId"]}, 1, {$hind})");

        }

    }
    //header("Location: index.php?added=".itemId);
} elseif (isset($_GET["itemId"]) && isset($_SESSION["username"]) && isset($_GET["action"]) && $_GET["action"] == 'remove'){
    $result = pg_query_params($con, "SELECT tellimus_id FROM tellimus WHERE isik_id = $1", array($_SESSION["userId"]));
    while ($row = pg_fetch_row($result)) {
        $tellimusId = $row[0];
    }
    pg_query_params($con, "DELETE FROM ostutellimuse_rida WHERE tellimus_id = $1 AND toode_id = $2", array($tellimusId, $_GET["itemId"]));
    //header("Location: index.php?removed=".itemId);
} else {
    //header("Location: index.php?error=true");
}

?>

