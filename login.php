<?php
session_start();
include ("functions.php");
connect();
include ("inc/header.php");

if(isset($_POST['login']))
{
	if(isset($_SESSION['uid']))
	{
		output("You have Logged In");
	}
	else
	{
		$username = protect($_POST['username']);
		$password = protect($_POST['password']);
		$login_query = mysql_query("SELECT `id` FROM `user` WHERE `username` = '$username' AND `password` = '".md5($password)."'") or die (mysql_error());
		if($username == "" || $password == "")
		{
			output("Blank coloum's are left. Please fill them.!");
		}
		elseif(mysql_num_rows($login_query) == 0)
		{
			output("Invalid Username and Password.!");
		}
		else
		{
			$get_id = mysql_fetch_assoc($login_query);
			$_SESSION['uid'] = $get_id['id'];
			header("Location: main.php");
		}
	}
}
else
{
	output("You have visited this page incorrectly.!");
}

include ("inc/footer.php");
?>