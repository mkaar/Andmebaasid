<div class="container">
<?php
    include("navigation.php");

    include("messages.php");

    $result = pg_query($con, "SELECT * FROM toote_eelvaade");
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

    for($i = 0; $i < $itemCount/$itemsPerPage; $i++){
        ?>
        <div class="row">
            <?php
                for($j = $i * $itemsPerPage; $j < $i * $itemsPerPage + $itemsPerPage; $j++) {
                    if($j == $itemCount)
                        break;
                        include("item.php");
                }
            ?>
        </div>
    <?php
    }



    ?>

</div>