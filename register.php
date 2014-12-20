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
    if(isset($_SESSION["username"]))
        echo("<script>location.href='index.php'</script>")
    ?>

    <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-center">
            <?php
            if(isset($_GET["error"])){
                ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                </div>
            <?php
            }
            ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    Registreeri
                </div>
                <div class="panel-body form-group">
                    <form id="register" action="register.php" method="post">
                        <input class="form-control" type="text" name="username" id="username" placeholder="Kasutajanimi" <?php if(isset($_POST["username"])){echo 'value="'.$_POST["username"].'"';} ?> /><br>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Parool" /><br>
                        <input class="form-control" type="password" name="password2" id="password2" placeholder="Korda parooli" /><br>
                        <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Eesnimi" <?php if(isset($_POST["firstname"])){echo 'value="'.$_POST["firstname"].'"';} ?>/><br>
                        <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Perenimi" <?php if(isset($_POST["lastname"])){echo 'value="'.$_POST["lastname"].'"';} ?>/><br>
                        <input class="form-control" type="email" name="email" id="email" placeholder="E-mail" <?php if(isset($_POST["email"])){echo 'value="'.$_POST["email"].'"';} ?>/><br>
                        <button type="submit" class="btn btn-primary">Registreeri</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    // REGISTRATION LOGIC
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"])) {
        if($_POST["password"] != $_POST["password2"]){
            echo("<script>location.href='register.php?error=passwordmismatch'</script>");
        }
        pg_query($con, "INSERT INTO isik (kasutajanimi, eesnimi, perenimi, e_mail, parool) VALUES ('{$_POST["username"]}', '{$_POST["firstname"]}','{$_POST["lastname"]}','{$_POST["email"]}','{$_POST["password"]}')");
        $result = pg_query($con, "SELECT isik_id FROM isik WHERE kasutajanimi = '{$_POST["username"]}'");
        while($row = pg_fetch_row($result)){
            pg_query($con, "INSERT INTO klient (isik_id, kliendi_seisundi_liik_kood) VALUES ('{$row[0]}', 1)");
        }

        echo("<script>location.href='signin.php?registration=successful'</script>");
    }

    ?>

</div>
</body>
</html>