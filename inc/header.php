<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($_SESSION['uid'])){ include ("safe.php"); echo strtoupper($user['username'])." |"; } ?> Clash Of Thanos</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="header"><b><i>Clash Of Thanos</i></b></div>
<div class="container">
	<div class="navigation">
		<div class="navigation_div">
			<?php
				if(isset($_SESSION['uid']))
					{
			?>

				&raquo; <a href="main.php">Your Stats</a><br><br>
				&raquo; <a href="ranking.php">Battle Players</a><br><br>
				&raquo; <a href="units.php">Your Units</a><br><br>
				&raquo; <a href="weapons.php">Your Weapons</a><br><br>
				&raquo; <a href="logout.php">Logout</a>
			<?php
					}
				else
					{ 
			?>
				<form action="login.php" method="POST">
					Username : <input type="text" name="username"><br><br>
					Password : <input type="password" name="password"><br><br>
					<input type="submit" name="login" value="Log In">
				</form>
			<?php
				}
			?>			
		</div>
	</div>
	
	<div class="content"><div class="content_div">