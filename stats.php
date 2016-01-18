<?php

	session_start();
	include ("functions.php");
	connect();
	include ("inc/header.php");
	if(!isset($_SESSION['uid']))
	{
		output("You have Log In to see this page.!");
	}
	else
	{
		if(!isset($_GET['id']))
		{
			output("You have visited this page incorrectly.!");
		}
		else
		{
			$id = protect($_GET['id']);
			$get_user = mysql_query("SELECT * FROM `user` WHERE `id` = '".$id."'") or die(mysql_error());
			$get_gold = mysql_query("SELECT * FROM `stats` WHERE `id` = '".$id."'") or die(mysql_error());
			$get_rank = mysql_query("SELECT * FROM `ranking` WHERE `id` = '".$id."'") or die(mysql_error());
			if(mysql_num_rows($get_user) == 0)
			{
				output("There is no user with that ID.!");
			}
			else
			{
				$detail = mysql_fetch_assoc($get_user);
				$detail_gold = mysql_fetch_assoc($get_gold);
				$rank = mysql_fetch_assoc($get_rank);
				?>

				<center><h2><?php echo strtoupper($detail['username']);  ?>'s Stats</h2></center><br>
				<table class="table">
					<tbody>
						<tr>
							<th>Username :</th>
							<td><?php echo " ".$detail['username'] ?></td>
						</tr>
						<tr>
							<th></th> 
							<td></td>
						</tr>
						<tr>
							<th>Rank :</th> 
							<td><?php echo " ".$rank['overall'] ?></td>
						</tr>
						<tr>
							<th>Total Gold :</th> 
							<td><?php echo " ".$detail_gold['gold'] ?></td>
						</tr>
					</tbody>
				</table>
				<br>
				<br>


				<form action="battle.php" method="POST">
				<?php
					$attack_check = mysql_query("SELECT `id` FROM `logs` WHERE `attacker` = '".$_SESSION['uid']."' AND `defender` = '".$id."' AND `time` > '".(time() - 86400)."' ") or die(mysql_error());
				?>
					<p>Attacks on <?php echo strtoupper($detail['username']); ?> in the last 24 Hours : (<?php echo mysql_num_rows($attack_check); ?>/5) </p>
					
					<?php
					if(mysql_num_rows($attack_check)<5)
					{
					?>

					<p>Number of turns (1-10) : <input type="text" name="turns">
					<input type="submit" name="gold" value="Raid for Gold">
					<input type="submit" name="food" value="Raid for Food">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<?php } else { ?>

					<!-- <?php echo "You can attack after ".number_format(((time()+86400)/60))." minutes"; ;?> -->

					 <?php  } ?> 
				</form>
				





				<?php
			}
		}
	}
	include ("inc/footer.php");
?>