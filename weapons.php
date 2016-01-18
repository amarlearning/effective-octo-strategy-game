<?php
	session_start();
	include ("functions.php");
	connect();
	include ("inc/header.php");
	if(!isset($_SESSION['uid']))
	{
		output("You must Log In to see this page.!");
	}
	else
	{
		if(isset($_POST['buy']))
		{
			$sword = protect($_POST['sword']);
			$shield = protect($_POST['shield']);

			$gold_needed = (10*$sword)+(10*$shield);

			if($sword == "" && $shield == "")
			{
				output("Please supply feilds with some input.!");
			}
			elseif($sword < 0 || $shield < 0)
			{
				output("You must buy a positive number of weapons.!");
			}
			elseif($stats['gold'] < $gold_needed)
			{
				output("You don't have enough gold to buy.!");
			}
			else
			{
				$weapon['sword'] += $sword;
				$weapon['shield'] +=$shield;

				$weapon_update = mysql_query("UPDATE `weapon` SET 
												`sword` = '".$weapon['sword']."', 
												`shield` = '".$weapon['shield']."'
												WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());

				$stats['gold'] -= $gold_needed;

				$gold_update = mysql_query("UPDATE `stats` SET
											`gold` = '".$stats['gold']."'
											WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());
				include ("update_stats.php");
				output("You successfully buyed your weapons.!");
			}
		}
		elseif(isset($_POST['sell']))
		{
			$sword = protect($_POST['sword']);
			$shield = protect($_POST['shield']);

			$gold_gained = (8*$sword)+(8*$shield);

			if($sword == "" && $shield == "")
			{
				output("Please supply feilds with some input.!");
			}
			elseif($sword < 0 || $shield < 0)
			{
				output("You must buy a positive number of weapons.!");
			}
			elseif($weapon['sword'] < $sword || $weapon['shield'] < $shield)
			{
				output("You don't have enough weapons to sell.!");
			}
			else
			{
				$weapon['sword'] -= $sword;
				$weapon['shield'] -=$shield;

				$weapon_update = mysql_query("UPDATE `weapon` SET 
												`sword` = '".$weapon['sword']."', 
												`shield` = '".$weapon['shield']."'
												WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());

				$stats['gold'] += $gold_gained;

				$gold_update = mysql_query("UPDATE `stats` SET
											`gold` = '".$stats['gold']."'
											WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());
				include ("update_stats.php");
				output("You successfully Sell your weapons.!");
			}
		}
?>

	<center><h2><?php echo strtoupper($user['username'])."'s"; ?> Weapons</h2></center><br>
	<p>You can buy and sell your weapons here.</p><br>
	<form action="weapons.php" method="POST">
		<table class="table">
			<tbody>
				<tr>
					<th class="th">Weapon Type</th>
					<th class="th">Number of Weapons</th>
					<th class="th">Weapon Cost</th>
					<th class="th">Buy more</th>
				</tr>
				<tr>
					<td class="th">Sword</td>
					<td class="th"><?php echo $weapon['sword']; ?></td>
					<td class="th">10 Gold</td>
					<td class="th"><input type="text" name="sword"></td>
				</tr>
				<tr>
					<td class="th">Shield</td>
					<td class="th"><?php echo $weapon['shield']; ?></td>
					<td class="th">10 Gold</td>
					<td class="th"><input type="text" name="shield"></td>
				</tr>
				<tr>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"><input type="submit" name="buy" value="Buy"></td>
				</tr>
			</tbody>
		</table>
	</form>
	<hr style="width:88%;margin:20px">
	<br>
		<form action="weapons.php" method="POST">
		<table class="table">
			<tbody>
				<tr>
					<th class="th">Weapon Type</th>
					<th class="th">Number of Weapons</th>
					<th class="th">Gold Gain</th>
					<th class="th">Sell more</th>
				</tr>
				<tr>
					<td class="th">Sword</td>
					<td class="th"><?php echo $weapon['sword']; ?></td>
					<td class="th">8 Gold</td>
					<td class="th"><input type="text" name="sword"></td>
				</tr>
				<tr>
					<td class="th">Shield</td>
					<td class="th"><?php echo $weapon['shield']; ?></td>
					<td class="th">8 Gold</td>
					<td class="th"><input type="text" name="shield"></td>
				</tr>
				<tr>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"><input type="submit" name="sell" value="Sell"></td>
				</tr>
			</tbody>
		</table>
	</form>
<?php

	}
	include ("inc/footer.php");

?>