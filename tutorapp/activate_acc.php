<?php 

include_once 'dbConnection.php';
$id =$_GET['id'];

runquery("UPDATE cpo_usermaster SET iUserStatus='1' WHERE random ='$id'");

?>
<div style='width:100%;margin-top:100px;padding:10px;text-align:center;'>
<p style='font-size:20px;'>Your Account is activated Now! Please wait we are redirecting to you on login page</p>
</div>

 <meta http-equiv="refresh" content="5;URL=http://www.careerpathsonline.net/user_login.php">