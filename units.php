<?php
	session_start();
	include ("functions.php");
	connect();
	include ("inc/header.php");
	if(!isset($_SESSION['uid']))
	{
		output("You must Log In to see this Page.!");
	}
	else
	{ 
		if(isset($_POST['train']))
		{
			$worker = protect($_POST['worker']);
			$farmer = protect($_POST['farmer']);
			$warrior = protect($_POST['warrior']);
			$defender = protect($_POST['defender']);


			$food_needed = (10*$worker)+(10*$farmer)+(10*$warrior)+(10*$defender);
			if($worker == "" && $farmer == "" && $warrior == "" && $defender == "")
			{
				output("Please supply feilds with some input.!");
			}
			elseif($worker < 0 || $farmer < 0 || $warrior < 0 || $defender < 0)
			{
				output("Please supply feilds in Positive Number.!");
			}
			elseif($stats['food'] < $food_needed)
			{
				output("You don't have enough food to train them.!");
			}
			else
			{
				$unit['worker'] += $worker;
				$unit['farmer'] += $farmer;
				$unit['warrior'] += $warrior;
				$unit['defender'] += $defender;

				$update_unit = mysql_query("UPDATE `unit` SET 
												`worker` = 	'".$unit['worker']."',
												`farmer` =  '".$unit['farmer']."',
												`warrior` = '".$unit['warrior']."',
												`defender` = '".$unit['defender']."'
												WHERE `id` = '".$_SESSION['uid']."' ") or die( mysql_error()); 	
				$stats['food'] -= $food_needed;
				$update_stats = mysql_query("UPDATE `stats` SET 
												`food` = '".$stats['food']."' 
												WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());	 
				include ("update_stats.php");
				output("You have successfully trained your units.!");
			}
		}
		elseif(isset($_POST['untrain'])) 
		{	

			$worker = protect($_POST['worker']);
			$farmer = protect($_POST['farmer']);
			$warrior = protect($_POST['warrior']);
			$defender = protect($_POST['defender']);

			$food_gained = (8*$worker)+(8*$farmer)+(8*$warrior)+(8*$defender);
			if($warrior == "" && $farmer == "" && $warrior == "" && $defender == "")
			{
				output("Please supply feilds with some input.!");
			}
			elseif($worker > $unit['worker'] || $farmer > $unit['farmer'] || $warrior > $unit['warrior'] || $defender > $unit['defender'])
			{
				output("You don't have that many units to untrain them.!");
			}
			else
			{
				$unit['worker'] -= $worker;
				$unit['farmer'] -= $farmer;
				$unit['warrior'] -= $warrior;
				$unit['defender'] -= $defender;

				$update_unit = mysql_query("UPDATE `unit` SET 
												`worker` = 	'".$unit['worker']."',
												`farmer` =  '".$unit['farmer']."',
												`warrior` = '".$unit['warrior']."',
												`defender` = '".$unit['defender']."'
												WHERE `id` = '".$_SESSION['uid']."' ") or die( mysql_error()); 	
				$stats['food'] += $food_gained;
				$update_stats = mysql_query("UPDATE `stats` SET 
												`food` = '".$stats['food']."' 
												WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());	 
				include ("update_stats.php");
				output("You have successfully Untrained your units.!");
			}
	}

?>
	<center><h2><?php echo strtoupper($user['username'])."'s"; ?> Units</h2></center><br>
	<p style="padding-left:25px">You can train and untrain your units here.!</p><br>
	<form action="units.php" method="POST">
		<table class="table">
			<tbody>
				<tr>
					<th class="th">Unit Type</th>
					<th class="th">Number Of Units</th>
					<th class="th">Unit Cost</th>
					<th class="th">Train More</th>
				</tr>
				<tr>
					<td class="th">Worker</td>
					<td class="th"><?php echo number_format($unit['worker']); ?></td>
					<td class="th">10 Food</td>
					<td class="th"><input type="text" name="worker" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th">Farmer</td>
					<td class="th"><?php echo number_format($unit['farmer']); ?></td>
					<td class="th">10 Food</td>
					<td class="th"><input type="text" name="farmer" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th">Warrior</td>
					<td class="th"><?php echo number_format($unit['warrior']); ?></td>
					<td class="th">10 Food</td>
					<td class="th"><input type="text" name="warrior" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th">Defender</td>
					<td class="th"><?php echo number_format($unit['defender']); ?></td>
					<td class="th">10 Food</td>
					<td class="th"><input type="text" name="defender" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"><input type="submit" name="train" value="Train"></td>
				</tr>
			</tbody>
		</table>
	</form>
	<hr style="width:88%;margin:20px">
	<form action="units.php" method="POST">
		<table class="table">
			<tbody>
				<tr>
					<th class="th">Unit Type</th>
					<th class="th">Number Of Units</th>
					<th class="th">Food Gained</th>
					<th class="th">Untrain More</th>
				</tr>
				<tr>
					<td class="th">Worker</td>
					<td class="th"><?php echo number_format($unit['worker']); ?></td>
					<td class="th">8 Food</td>
					<td class="th"><input type="text" name="worker" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th">Farmer</td>
					<td class="th"><?php echo number_format($unit['farmer']); ?></td>
					<td class="th">8 Food</td>
					<td class="th"><input type="text" name="farmer" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th">Warrior</td>
					<td class="th"><?php echo number_format($unit['warrior']); ?></td>
					<td class="th">8 Food</td>
					<td class="th"><input type="text" name="warrior" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th">Defender</td>
					<td class="th"><?php echo number_format($unit['defender']); ?></td>
					<td class="th">8 Food</td>
					<td class="th"><input type="text" name="defender" placeholder="0"></td>
				</tr>
				<tr>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"></td>
					<td class="th"><input type="submit" name="untrain" value="Untrain"></td>
				</tr>
			</tbody>
		</table>
	</form>
<?php	

	}
	include ("inc/footer.php");

?>