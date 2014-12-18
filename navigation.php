<?php
/**
 * Created by IntelliJ IDEA.
 * User: markoka
 * Date: 17.12.2014
 * Time: 22:07
 */
include("database_connect.php");
if(!isset($_SESSION)){
	session_start();
}
?>
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
				if(isset($_SESSION["username"])) {
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