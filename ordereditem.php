<div class="col-md-4">
    <ul class="list-group">
        <li class="list-group-item">
            <?php
            echo "<h3>".$array[$j][5]."</h3>";
            ?>
        </li>
        <li class="list-group-item">
            <?php
            echo $array[$j][6];
            ?>
        </li>
        <li class="list-group-item">
            <?php
            function startsWith($haystack, $needle)
            {
                $length = strlen($needle);
                return (substr($haystack, 0, $length) === $needle);
            }

            if(startsWith($array[$j][7], "http://")){
                echo "Link: <a href='".$array[$j][7]."' target='_blank'>".$array[$j][7]."</a>";
            } else {
                echo "Link: <a href='http://".$array[$j][7]."' target='_blank'>".$array[$j][7]."</a>";
            }
            ?>
        </li>
        <li class="list-group-item
                <?php
        if($array[$j][1] == 1)
            echo " list-group-item-success";
        elseif($array[$j][1] == 2)
            echo " list-group-item-info";
        else
            echo " list-group-item-warning";
        ?>
            ">
            <?php

            if(isset($_SESSION["username"])) {
                if ($_SESSION["mode"] == 'admin') {
                    ?>
                    <a href="edit.php?itemId=<?php echo $array[$j][0]; ?>" class="btn btn-success pull-right"
                       role="button">Redigeeri toodet</a>
                <?php
                } else {
                    $result = pg_query_params($con, "SELECT tellimus_id FROM tellimus WHERE isik_id=$1 AND tellimuse_seisundi_liik_kood <> 2", array($_SESSION['userId']));
                    $searchResult = 0;
                    while($row = pg_fetch_row($result)){
                        $isInCart = pg_query_params($con, "SELECT * FROM ostutellimuse_rida WHERE toode_id=$1 AND tellimus_id = $2", array($array[$j][0], $row[0]));
                        $searchResult += pg_num_rows($isInCart);
                    }
                }
            }
            $result = pg_query_params($con, 'SELECT toote_kategooria_nimetus FROM toote_kategooria WHERE toote_kategooria_kood = $1', array($array[$j][1]));
            while ($row = pg_fetch_row($result)) {
                echo "<h5>".$row[0]."</h5>";
            }
            ?>
        </li>
    </ul>
</div>