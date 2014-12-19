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
           <div class="panel">
                <div class="panel-body form-group">
                        <a href="orderlogic.php?action=pay" class="btn btn-primary">Maksa tellimuse eest</a>
                        <a href="orderlogic.php?action=cancel" class="btn btn-success">Tühista tellimus</a>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>