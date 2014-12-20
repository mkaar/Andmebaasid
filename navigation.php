<?php
include("database_connect.php");
if(!isset($_SESSION)){
	session_start();
}
?>
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
<nav class="navbar navbar-default" role="navigation" style="background-color: #dff0d8;">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.php">GreenSoft</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse navbar-ex1-collapse">
		<form class="navbar-form navbar-left" action="search.php" method="post" role="search">
			<div class="form-group">
				<input name="toode" type="text" class="form-control" placeholder="Otsi tooteid...">
			</div>
			<button type="submit" class="btn btn-default">Otsi</button>
		</form>
		<ul class="nav navbar-nav navbar-right">
			<?php
				if(isset($_SESSION["username"]) && $_SESSION['mode'] != "admin") {
			?>
				<li class="navbar-text">
					<?php
						echo "<li class='navbar-text'>Tere ".$_SESSION["username"]."!</li>";
						$result = pg_query_params($con, "SELECT o.toode_id FROM ostutellimuse_rida AS o WHERE o.tellimus_id = (SELECT t.tellimus_id FROM tellimus AS t WHERE isik_id=$1 AND tellimuse_seisundi_liik_kood = 1);", array($_SESSION["userId"]));
						$ostukorv = pg_num_rows($result);
						$result = pg_query_params($con, "SELECT o.toode_id FROM ostutellimuse_rida AS o WHERE o.tellimus_id = (SELECT t.tellimus_id FROM tellimus AS t WHERE isik_id=$1 AND (tellimuse_seisundi_liik_kood = 4 OR tellimuse_seisundi_liik_kood = 5));", array($_SESSION["userId"]));
						$tooted = pg_num_rows($result);

					?>
				</li>
				<li>
					<a href="ostukorv.php">Ostukorv <span class="badge"><?php echo $ostukorv?></span></a>
				</li>
				<li>
					<a href="ordered.php">Ostetud tooted <span class="badge"><?php echo $tooted?></span></a>
				</li>
			<?php
				}
				if(isset($_SESSION['mode'])) {
					$mode = $_SESSION['mode'];
				} else {
					$mode = "";
				}
				if($mode  == "admin"){
			?>
				<li>
					<a href="adminindex.php">Kõik tooted</a>
				</li>
				<li>
					<a href="index.php">Kasutaja vaade</a>
				</li>
				<li>
					<a href="archive.php">Arhiveeri(tud) tellimus(ed)</a>
				</li>
			<?php
				}
				if(!isset($_SESSION["username"])) {
			?>
				<li><a href="signin.php">Logi Sisse</a></li>
			<?php
				} else {
					echo"<li><a href='signout.php'>Logi Välja</a></li>";
				}
			?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sirvi ainult... <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="index.php">Kõike</a></li>
					<li><a href="films.php">Filme</a></li>
					<li><a href="games.php">Mänge</a></li>
					<li><a href="programs.php">Programme</a></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav>