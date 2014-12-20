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

                if(isset($_SESSION["username"])) {
                    if ($_SESSION["mode"] == 'admin') {
                        ?>
                        <a href="edit.php?itemId=<?php echo $array[$j][0]; ?>" class="btn btn-success pull-right"
                           role="button">Redigeeri toodet</a>
                    <?php
                    } else {
                        $isInCart = pg_query_params($con, "SELECT * FROM ostutellimuse_rida WHERE toode_id=$1 AND tellimus_id = (SELECT tellimus_id FROM tellimus WHERE isik_id=$2 AND tellimuse_seisundi_liik_kood=1) ", array($array[$j][0], $_SESSION['userId']));
                        $searchResult = pg_num_rows($isInCart);
                        if($searchResult == 0) {
                            ?>
                            <a href="osta.php?action=add&itemId=<?php echo $array[$j][0];?>"
                               class="btn btn-success pull-right" role="button"><span
                                    class="glyphicon glyphicon-shopping-cart"></span></a>
                        <?php
                        } else {
                        ?>
                            <a href="osta.php?action=add&itemId=<?php echo $array[$j][0];?>"
                               class="btn btn-default disabled pull-right" role="button"><span
                                    class="glyphicon glyphicon-shopping-cart"></span></a>
                        <?php
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