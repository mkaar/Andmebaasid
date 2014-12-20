<div class="container">
    <?php
    include("navigation.php");

    include("messages.php");

    if($_SESSION['mode'] != 'admin'){
        header("Location: index.php");
    }

    if(isset($_GET['tellimusId'])){
        $result = pg_query($con, "UPDATE tellimus SET tellimuse_seisundi_liik_kood=5 WHERE tellimus_id={$_GET['tellimusId']}");
    }

    $result = pg_query($con, "SELECT * FROM Tellimuse_detailvaade");
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }

    $itemsPerPage = 3;

    $array = array();

    $itemCount = pg_num_rows($result);

    while ($row = pg_fetch_row($result)) {
        array_push($array, $row);
    }

    ?>

    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="archive.php">Arhiveeri tellimusi</a></li>
        <li><a href="archived.php">Arhiveeritud tellimused</a></li>
    </ul>

    <?php

    for($i = 0; $i < $itemCount/$itemsPerPage; $i++){
        ?>
        <div class="row">
            <?php
            for($j = $i * $itemsPerPage; $j < $i * $itemsPerPage + $itemsPerPage; $j++) {
                if($j == $itemCount)
                    break;
                include("archiveitem.php");
            }
            ?>
        </div>
    <?php
    }



    ?>

</div>