<div class="col-md-4">
    <ul class="list-group">
        <li class="list-group-item">
            <?php
            echo "<h3>Tellimuse ID: ".$array[$j][0]."</h3>";
            echo "<h3>Tellimuse esitamise kuupäev: ".$array[$j][1]."</h3>";
            echo "<h3>Tellimuse maksmise kuupäev: ".$array[$j][2]."</h3>";
            echo "<h3>Tellimuse makse tähtaeg: ".$array[$j][3]."</h3>";
            echo "<h3>Tellija kasutajanimi: ".$array[$j][4]."</h3>";
            echo "<h3>Tellija eesnimi: ".$array[$j][5]."</h3>";
            echo "<h3>Tellija perenimi: ".$array[$j][6]."</h3>";
            echo "<h3>Tellija e-mail: ".$array[$j][7]."</h3>";
            echo "<h3>Tellimuse seisund: ".$array[$j][8]."</h3>";
            echo "<h3>Tellimuse kogu hind: ".$array[$j][9]."</h3>";

            if(isset($_SESSION["username"]) && $_SESSION["mode"] == 'admin') {
                if ($array[$j][8] == "Täidetud") {
                    ?>
                    <a href="archive.php?tellimusId=<?php echo $array[$j][0]; ?>" class="btn btn-success"
                       role="button">Arhiveeri tellimus</a>
                <?php
                }
            } else {
                echo("<script>location.href='index.php'</script>");
            }
            ?>
        </li>
    </ul>
</div>