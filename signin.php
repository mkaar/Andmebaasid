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
    ?>

    <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-center">
            <?php
            if(isset($_GET["error"])){
            ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                Kasutaja või parool oli vale! Proovi uuesti!
            </div>
            <?php
            }
            ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    Logi sisse
                </div>
                <div class="panel-body form-group">
                    <form id="login" action="loginlogic.php" method="post">
                        <input class="form-control" type="text" name="username" id="username" placeholder="Kasutajanimi" /><br>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Parool" /><br>
                        <button type="submit" class="btn btn-primary">Sisene</button>
                    </form>
                </div>
            </div>
                Kasutaja puudub?<br>
                <a href="register.php" class="btn btn-success">Registreeri</a>
        </div>
    </div>

</div>
</body>
</html>