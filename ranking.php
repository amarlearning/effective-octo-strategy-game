<?php
	session_start();
	include ("functions.php");
	connect();
	include ("inc/header.php");
	if(!isset($_SESSION['uid']))
	{
	output("You must Log In to see this page correctly.!");
	}
	else
	{
?>
	<center><h2><?php echo "Battle Player's" ?></h2></center>
	<table class="table">
		<tbody>
			<tr>
				<th class="th-rank">Rank</th>
				<th class="th-rank">Username</th>
				<th class="th-rank">Gold ($)</th>
			</tr>
			<?php
				$get_user = mysql_query("SELECT `id`,`overall` FROM `ranking` WHERE `overall` > 0 ORDER BY `overall` ASC") or die(mysql_error());
				while (($row = mysql_fetch_assoc($get_user))>0) 
				{
						echo "<tr ";?><?php if($row['id']==$_SESSION['uid']){echo "class=\"user-coloum\"";}?><?php echo ">";
						echo "<td class=\"td-rank\">".$row['overall']."</td>";
						$rank_name = mysql_query("SELECT `username` FROM `user` WHERE `id` = '".$row['id']."' ") or die(mysql_error());
						$rank_name_username = mysql_fetch_assoc($rank_name);


						echo "<td class=\"td-rank\"><a class=\"username\" href=\"stats.php?id=".$row['id']."\">".$rank_name_username['username']."</a></td>"; 
						



						$rank_gold = mysql_query("SELECT `gold` FROM `stats` WHERE `id` = '".$row['id']."'") or die(mysql_error());
						$rank_gold_count = mysql_fetch_assoc($rank_gold);
						echo "<td class=\"td-rank\">".$rank_gold_count['gold']."</td>"; 
						echo "</tr>";
				}
			?>
		</tbody>
	</table>
<?php
	}
	include ("inc/footer.php");
?>