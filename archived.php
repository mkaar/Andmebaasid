<div class="container">
    <?php
    include("navigation.php");

    include("messages.php");

    if($_SESSION['mode'] != 'admin'){
        echo("<script>location.href='index.php'</script>");
    }

    $result = pg_query($con, "SELECT * FROM tellimus WHERE tellimuse_seisundi_liik_kood=5");
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
        <li><a href="archive.php">Arhiveeri tellimusi</a></li>
        <li class="active"><a href="archived.php">Arhiveeritud tellimused</a></li>
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