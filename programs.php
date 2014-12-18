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
    include("database_connect.php");

    $result = pg_query($con, "SELECT * FROM toode WHERE toote_seisundi_liik_kood = 1 AND toote_kategooria_kood = 3");
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
</body>
</html>