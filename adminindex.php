<div class="container">
    <?php
    include("navigation.php");

    include("messages.php");

    if($_SESSION['mode'] != 'admin'){
        echo("<script>location.href='index.php'</script>");
    }

    $result = pg_query($con, "SELECT * FROM toode");
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
                include("adminitem.php");
            }
            ?>
        </div>
    <?php
    }



    ?>

</div>