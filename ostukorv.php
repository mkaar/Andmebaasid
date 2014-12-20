<div class="container">
    <?php
    include("navigation.php");

    $result = pg_query_params($con, "SELECT o.toode_id FROM ostutellimuse_rida AS o WHERE o.tellimus_id = (SELECT t.tellimus_id FROM tellimus AS t WHERE isik_id=$1 AND tellimuse_seisundi_liik_kood = 1);", array($_SESSION["userId"]));
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }

    $itemsPerPage = 3;

    $array = array();

    $itemCount = pg_num_rows($result);

    $totalPrice = 0;

    while($row = pg_fetch_row($result)){
        $result2 = pg_query_params($con,"SELECT * FROM toode WHERE toode_id = $1", $row);
        while ($row2 = pg_fetch_row($result2)) {
            array_push($array, $row2);
        }
    }

    for($i = 0; $i < $itemCount/$itemsPerPage; $i++){
        ?>
        <div class="row">
            <?php
            for($j = $i * $itemsPerPage; $j < $i * $itemsPerPage + $itemsPerPage; $j++) {
                if($j == $itemCount)
                    break;
                $totalPrice += $array[$j][4];
                include("addeditem.php");
            }
            ?>
        </div>
    <?php
    }



    ?>

<h2>Tellimuse kogu hind on: €<?php echo $totalPrice?></h2>

<a href="orderpage.php" class="btn btn-success">Esita tellimus</a>
</div>