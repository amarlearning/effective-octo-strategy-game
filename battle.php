<?php
session_start();
include ("functions.php");
connect();
include ("inc/header.php");
if(!isset($_SESSION['uid']))
{
	output("Please Log In to see this page.!");
}
else
{
	if(isset($_POST['gold']))
	{
		$turns = protect($_POST['turns']);
		 $id = protect($_POST['id']);
		 $user_check = mysql_query("SELECT * FROM `stats` WHERE `id` = '".$id."'") or die(mysql_error());
		 if($id == $_SESSION['uid'])
		 {
		 	output("You cannot attack yourself.!");
		 }
		 elseif(mysql_num_rows($user_check) == 0)
		 {
		 	output("There is no user with such ID.!");
		 }
		 elseif($turns < 1 || $turns > 10)
		 {
		 	output("Please enter a valid number of turns between 0 to 10.!");
		 }
		 elseif($turns > $stats['turns'])
		 {
		 	output("You don't have enough turns to attack.!");
		 } 
		 else
		 {
		 	 $enemy_stats = mysql_fetch_assoc($user_check);
		 	 $attack_effect = $turns * 0.1 * $stats['attack'];
		 	 $defense_effect = $enemy_stats['defense'];

		 	 echo "Your send your warriors into battle.!<br><br>";
		 	 echo "Your warrior dealt ".number_format($attack_effect). " damage.!<br>";
		 	 echo "The enemy's defender dealt ".number_format($defense_effect). " damage.!<br><br>";

		 	 if($attack_effect>$defense_effect)
		 	 {
		 	 	$ratio = ($attack_effect-$defense_effect)/$attack_effect * $turns;
		 	 	$ratio = min($ratio,1);
		 	 	$gold_stolen = $ratio * $enemy_stats['gold'];
		 	 	echo "You won the battle.! You stole ". number_format($gold_stolen)." gold!";
		 	 	$battle_1 = mysql_query("UPDATE `stats` SET `gold` = `gold` - '".$gold_stolen."' WHERE `id` = '".$id."'") or die(mysql_error());
		 	 	$battle_2 = mysql_query("UPDATE `stats` SET `gold` = `gold` + '".$gold_stolen."', `turns` = `turns` - '".$turns."' WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());
		 	 	$battle_3 = mysql_query("INSERT INTO `logs` (`attacker`,`defender`,`attacker_damage`,`defender_damage`,`gold`,`food`,`time`) VALUES ('".$_SESSION['uid']."','".$id."','".$attack_effect."','".$defense_effect."','".$gold_stolen."','0','".time()."')") or die(mysql_error()); 
				$stats['gold'] += $gold_stolen;
				$stats['turns'] -= $turns;		 	 	
		 	 }
		 	 else
		 	 {
		 	 	echo "You lost the battle.!";
		 	 }
		 }
	}
	elseif(isset($_POST['food']))
	{
		 $turns = protect($_POST['turns']);
		 $id = protect($_POST['id']);
		 $user_check = mysql_query("SELECT * FROM `stats` WHERE `id` = '".$id."'") or die(mysql_error());
		 if($id == $_SESSION['uid'])
		 {
		 	output("You cannot attack yourself.!");
		 }
		 elseif(mysql_num_rows($user_check) == 0)
		 {
		 	output("There is no user with such ID.!");
		 }
		 elseif($turns < 1 || $turns > 10)
		 {
		 	output("Please enter a valid number of turns between 0 to 10.!");
		 }
		 elseif($turns > $stats['turns'])
		 {
		 	output("You don't have enough turns to attack.!");
		 } 
		 else
		 {
		 	 $enemy_stats = mysql_fetch_assoc($user_check);
		 	 $attack_effect = $turns * 0.1 * $stats['attack'];
		 	 $defense_effect = $enemy_stats['defense'];

		 	 echo "Your send your warriors into battle.!<br><br>";
		 	 echo "Your warrior dealt ".number_format($attack_effect). " damage.!<br>";
		 	 echo "The enemy's defender dealt ".number_format($defense_effect). " damage.!<br><br>";

		 	 if($attack_effect>$defense_effect)
		 	 {
		 	 	$ratio = ($attack_effect-$defense_effect)/$attack_effect * $turns;
		 	 	$ratio = min($ratio,1);
		 	 	$food_stolen = $ratio * $enemy_stats['food'];
		 	 	echo "You won the battle.! You stole ". number_format($food_stolen)." food!";
		 	 	$battle_1 = mysql_query("UPDATE `stats` SET `food` = `food` - '".$food_stolen."' WHERE `id` = '".$id."'") or die(mysql_error());
		 	 	$battle_2 = mysql_query("UPDATE `stats` SET `food` = `food` + '".$food_stolen."' , `turns` = `turns` - '".$turns."' WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());
		 	 	$battle_3 = mysql_query("INSERT INTO `logs` (`attacker`,`defender`,`attacker_damage`,`defender_damage`,`gold`,`food`,`time`) VALUES ('".$_SESSION['uid']."','".$id."','".$attack_effect."','".$defense_effect."','0','".$food_stolen."','".time()."')") or die(mysql_error()); 
				$stats['food'] += $food_stolen;
				$stats['turns'] -= $turns;		 	 	
		 	 }
		 	 else
		 	 {
		 	 	echo "You lost the battle.!";
		 	 }
		 }
	}
	else
	{
		output("You have visited this page incorrectly.!");
	}
}
include ("inc/footer.php");
?>