<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtuaaltoodete E-pood</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <![endif]-->
</head>
<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/vendor/jquery-1.10.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
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

<a href="orderlogic.php" class="btn btn-success">Esita tellimus</a>
</div>
</body>
</html>