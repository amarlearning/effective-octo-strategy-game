<?php
session_start();
include ("functions.php");
connect();
include ("inc/header.php");
?>

<?php
if(isset($_POST['register']))
{

	$username = protect($_POST['username']);
	$password = protect($_POST['password']);
	$email = protect($_POST['email']);
	if($username == "" || $password == "" || $email == "")
	{
		output("Please supply all feilds.!");
	}
	elseif(strlen($username)>20 or strlen($username)<3)
	{
		output("Username Must be greater then 3 and less than 20 characters.!");
	}

	elseif(strlen($email)>100 or strlen($email)<6)
	{
		output("You entered an Invalid Email Address!");
	}
	else
	{
		$register_1 = mysql_query("SELECT `id` FROM `user` WHERE `username`='$username'") or die(mysql_error());
		$register_2 = mysql_query("SELECT `id` FROM `user` WHERE `email`='$email'") or die(mysql_error());
		if(mysql_num_rows($register_1)>0)
		{
			output("Username already in use! Pick onother one!");
		}
		elseif(mysql_num_rows($register_2)>0)
		{
			output("Email already in use! Use onother one!");
		}
		else
		{
			$insert_1 = mysql_query("INSERT INTO `stats` (`gold`,`attack`,`defense`,`food`,`income`,`farming`,`turns`) VALUES (100,10,10,100,10,11,100)");
			$insert_2 = mysql_query("INSERT INTO `unit` (`worker`,`farmer`,`warrior`,`defender`) VALUES (5,5,0,0)");
			$insert_3 = mysql_query("INSERT INTO `user` (`username`,`password`,`email`) VALUES ('$username','".md5($password)."','$email')") or die(mysql_error());
			$insert_4 = mysql_query("INSERT INTO `weapon` (`sword`,`shield`) VALUES (0,0)");
			$insert_5 = mysql_query("INSERT INTO `ranking` (`attack`,`defense`,`overall`) VALUES (0,0,0)") or die(mysql_error());
			echo "<div class='success-result'><ul><li>Successfully Registerd! Happy Playing!</li></ul></div>";
		}
	}

	// header('Location: register.php?status=check');
}
?>
<?php
	if(isset($_SESSION['uid']))
	{
		output("You have already registered.!");
	}
	else
	{
?>
<h2>Register Form</h2>
<br>
<div class="register">
<form method="POST" action="register.php?status=check">
	<label for="username">Username : </label><br>
		<input type="text" name="username" id="username"><br><br>
	<label for="password">Password : </label><br>
		<input type="password" name="password" id="password"><br><br>
	<label for="email">Email : </label><br>
		<input type="email" name="email" id="email"><br><br>
	<input type="submit" value="Register" name="register" class="register-button">
</form>
</div>
<?php
}
?>

<?php
include ("inc/footer.php");
?>