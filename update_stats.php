<?php

$income = 2 * $unit['worker'];
$farming = 5 * pow($unit['farmer'],0.5);

$var_one = min($weapon['sword'],$unit['warrior']);
if($var_one == $weapon['sword'])
{
	$attack = 10 * $weapon['sword'] + 5 * ($unit['warrior']-$weapon['sword']);
}
else
{
	$attack = 10 * $unit['warrior'];
}

$var_two = min($weapon['shield'],$unit['defender']);
if($var_two == $weapon['shield'])
{
	$defense = 10 * $weapon['shield'] + 5 * ($unit['defender']-$weapon['shield']);
}
else
{
	$defense = 10 * $unit['defender'];
}


$final_upatde = mysql_query("UPDATE `stats` SET
								`income` = '".$income."',
								`farming` = '".$farming."',
								`attack` = '".$attack."',
								`defense` = '".$defense."'
								WHERE `id` = '".$_SESSION['uid']."'") or die(mysql_error());


?>