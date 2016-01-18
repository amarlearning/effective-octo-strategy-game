<?php
	session_start();
	include ("functions.php");
	connect();
	include ("inc/header.php");
	if(!isset($_SESSION['uid']))
	{
		output("You are visiting this page incorrectly.!");
	}
	else
	{
?>
	<center><h2><?php echo strtoupper($user['username'])."'s"; ?> Stats</h2></center>
	<table>
		<tbody>
			<tr>
				<th>Username : </th>
				<td><i><?php echo $user['username']; ?></i></td>
			</tr>
			<tr>
				<th></th>
				<td></td>
			</tr>
			<tr>
				<th class="unbold">Number of Attacks left : </th>
				<td ><?php echo $stats['attack']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Number of Defense left : </th>
				<td><?php echo $stats['defense']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Total Gold : </th>
				<td><?php echo $stats['gold']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Total Food : </th>
				<td><?php echo $stats['food']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Total Income : </th>
				<td><?php echo $stats['income']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Total Farming : </th>
				<td><?php echo $stats['farming']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Total Turns : </th>
				<td><?php echo $stats['turns']; ?></td>
			</tr>
			<tr>
				<th></th>
				<td></td>
			</tr>
			<tr>
				<th class="unbold">Number of Worker : </th>
				<td><?php echo $unit['worker']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Number of Farmer : </th>
				<td><?php echo $unit['farmer']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Number of Warrior : </th>
				<td><?php echo $unit['warrior']; ?></td>
			</tr>
			<tr>
				<th class="unbold">Number of Defender : </th>
				<td><?php echo $unit['defender']; ?></td>
			</tr>
			<tr>
				<th></th>
				<td></td>
			</tr>
			<tr>
				<th class="unbold">Total Number of Swords : </th>
				<td><?php echo $weapon['sword']?></td>
			</tr><tr>
				<th class="unbold">Total Number of Shields : </th>
				<td><?php echo $weapon['shield']?></td>
			</tr>
		</tbody>
	</table>
<?php
	}
	include ("inc/footer.php");
?>