<div class="col-md-4">
    <ul class="list-group">
        <li class="list-group-item">
                <span class="label label-success pull-right">
                    <?php
                    echo "€".$array[$j][4];
                    ?>
                </span>
            <?php
            echo "<h3>".$array[$j][5]."</h3>";
            ?>
        </li>
        <li class="list-group-item">
            <?php
            $creator = pg_query_params($con, "SELECT kasutajanimi FROM isik WHERE isik_id = $1", array($array[$j][3]));
            while($row = pg_fetch_row($creator)){
                echo $row[0];
            }
            ?>
        </li>
        <li class="list-group-item">
            <?php
            echo $array[$j][6];
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

            if(isset($_SESSION["username"])){
                ?>
                <a href="osta.php?action=remove&itemId=<?php echo $array[$j][0];?>" class="btn btn-success pull-right" role="button">Eemalda ostukorvist</a>
            <?php
            }
            $result = pg_query_params($con, 'SELECT toote_kategooria_nimetus FROM toote_kategooria WHERE toote_kategooria_kood = $1', array($array[$j][1]));
            while ($row = pg_fetch_row($result)) {
                echo "<h5>".$row[0]."</h5>";
            }
            ?>
        </li>
    </ul>
</div>