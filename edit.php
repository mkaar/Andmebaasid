<div class="container">
<?php
    include("navigation.php");
    include("database_connect.php");
    if($_SESSION['mode'] != "admin"){
        echo("<script>location.href='index.php'</script>");
    }
    $result = pg_query_params($con, "SELECT * FROM toode WHERE toode_id = $1", array($_GET['itemId']));
    $array = array();
    while($row = pg_fetch_row($result)){
        array_push($array, $row);
    }

    if(isset($_POST['name']) || isset($_POST['price']) || isset($_POST['description']) || isset($_POST['genre']) || isset($_POST['active']) || isset($_POST['link'])){
        pg_query($con, "UPDATE toode SET toote_kategooria_kood={$_POST['genre']}, toote_seisundi_liik_kood={$_POST['active']}, hind={$_POST['price']}, nimi='{$_POST['name']}', kirjeldus='{$_POST['description']}', allalaadimise_link='{$_POST['link']}' WHERE toode_id={$_GET['itemId']}");
        echo("<script>location.href='edit.php?itemId=".$_GET['itemId']."'</script>");
    }
?>
    <div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-body">
        <form id="edit" action="edit.php?itemId=<?php echo $_GET['itemId'];?>" method="post">
            <div class="col-xs-8">
                <label for="name">Nimi</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $array[0][5]?>"/><br>
            </div>
            <div class="col-xs-4">
                <label for="price">Hind</label>
                <input type="text" name="price" id="price" class="form-control" value="<?php echo $array[0][4]?>"/><br>
            </div>
            <div class="col-xs-8">
                <label for="description">Kirjeldus</label>
                <textarea type="text" name="description" id="description" class="form-control"><?php echo $array[0][6]?></textarea><br>
            </div>
            <div class="col-xs-4">
                <label for="genre">Kategooria</label>
                <select id="genre" name="genre" class="form-control">
                    <option value="1" <?php if($array[0][1] == 1) echo "selected"; ?>>Film</option>
                    <option value="2" <?php if($array[0][1] == 2) echo "selected"; ?>>Mäng</option>
                    <option value="3" <?php if($array[0][1] == 3) echo "selected"; ?>>Programm</option>
                </select>
            </div>
            <div class="col-xs-8">
                <label for="link">Allalaadimise link</label>
                <input type="text" name="link" id="link" class="form-control" value="<?php echo $array[0][7]?>"/><br>
            </div>
            <div class="col-xs-4">
                <label for="active">Aktiivne</label>
                <select id="active" name="active" class="form-control">
                    <option value="1" <?php if($array[0][2] == 1) echo "selected"; ?>>Aktiivne</option>
                    <option value="2" <?php if($array[0][2] == 2) echo "selected"; ?>>Mitteaktiivne</option>
                </select>
            </div>
            <div class="col-xs-12">
                <button type="submit" class="btn btn-success">Muuda toodet</button>
            </div>
        </form>
    </div>
    </div>
    </div>
    <div class="col-md-offset-2 col-md-8">
        <ul class="list-group">
            <li class="list-group-item">
                    <span class="label label-success pull-right">
                        <?php
                        echo "€".$array[0][4];
                        ?>
                    </span>

                <?php
                echo "<h3>".$array[0][5]."</h3>";
                ?>
            </li>
            <li class="list-group-item">
                <?php
                echo $array[0][6];
                ?>
            </li>
            <li class="list-group-item
                    <?php
            if($array[0][1] == 1)
                echo " list-group-item-success";
            elseif($array[0][1] == 2)
                echo " list-group-item-info";
            else
                echo " list-group-item-warning";
            ?>
                ">
                <?php
                $result = pg_query_params($con, 'SELECT toote_kategooria_nimetus FROM toote_kategooria WHERE toote_kategooria_kood = $1', array($array[0][1]));
                while ($row = pg_fetch_row($result)) {
                    echo "<h5>".$row[0]."</h5>";
                }
                ?>
            </li>
        </ul>
    </div>
</div>