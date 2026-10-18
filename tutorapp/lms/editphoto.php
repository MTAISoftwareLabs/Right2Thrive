<?
session_cache_expire(time()-1);
session_cache_limiter('nocache');
@ob_start();	
include "dbConnection.php";
//echo $_SESSION['user_id'];
$user_name=$_SESSION['user_name'];

//exit;
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		document.location ="../user_login.php";
	</script> 
<?
}
else
{
		$user_id = $_SESSION['user_id'];
		//echo $user_id;
}
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "../lms/images/swf.gif";
			break;
		case "doc" : 
			return "../lms/images/doc.gif";
			break;			
		case "jpg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "peg" : 
			return "../lms/images/jpg.gif";
			break;			
		case "gif" : 
			return "../lms/images/gif.gif";
			break;			
		case "pdf" : 
			return "../lms/images/pdf.gif";								
			break;
		default : 
			return "NONE";				
			break;			
	}
}
if(isset($_POST['sendphoto'])){

$pic=$_REQUEST['pic'];
$email=$_POST['email'];
$q="select * from cpo_usermaster where vUserEmailId='$email'";
$r=mysqli_query($q);
$f=mysqli_fetch_array($r);
$picture=$f['picture'];
if($picture==""){
$query="update cpo_usermaster set picture='$pic' where vUserEmailId='$email'";
mysqli_query($query);
}
else{
$picture=$f['picture'].','.$pic;
$q1="update cpo_usermaster set picture='$picture' where vUserEmailId='$email'";
//echo $q1;
mysqli_query($q1);
header("location:editphoto.php?send=1");
}


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="lms.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><? echo sitename;?>Learner Home</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>

<body >
<form action="" method="post" name="editphoto">

<br /><br />
<table width="900"  cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>

<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <th height="353"  align="center"><table width="905" border="0" align="center"  cellpadding="0" cellspacing="0">
      <tr>
        <th width="199" rowspan="3" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><? include "leftpanel.php"; ?></th>
        <th height="10" align="left" valign="top" scope="col"><? include "includewelcome.php";?></th>
        </tr>
      <tr>
        <th align="center" valign="top" scope="col"><table width="100%" border="0">
          
		  <? $act=$_REQUEST['act'];
		  $pic=$_REQUEST['pic'];
		  $del=$_REQUEST['del'];
		  if($act=="delete"){
		    $q="select * from cpo_usermaster where iUserId='$user_id'";
			$r=mysqli_query($q);
			$f=mysqli_fetch_array($r);
			  $picture=$f['picture'];
	          $pic1=explode(",",$picture);
			//print_r($pic1);
			$key1 = array_search($pic, $pic1); // $key = 2;
			 // echo $key1;
						  unset($pic1[$key1]);
		
		$a2=implode(",",$pic1);
		$q1="update cpo_usermaster set picture='$a2' where iUserId='$user_id'";
		mysqli_query($q1);
			 header("location:editphoto.php?del=1");
		  }
		  if($del==1){
		  ?>
		    <table><tr><td> <strong>You Have Successfully Deleted</strong> </td></tr></table>
			<? }
			$send=$_REQUEST['send'];
			//echo $send;
			if($send==1){
			?>
			 <table><tr><td> <strong>You Have Successfully Sended..</strong> </td></tr></table>
			<? }
			if($act=="send"){
			 ?>
			 
			<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table width="500" border="0" align="center" bgcolor="#FFFFFF">
<br />  
<tr>
    <td colspan="3" background="images/changep_center_cor.jpg"><strong>Send To a Friend </strong></td>
  </tr>
  <tr>
    <td width="123"><strong>Friend Email </strong></td>
    <td width="7"><strong>:</strong></td>
    <td width="356">
      <input type="text" name="email" />    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="sendphoto" value="Submit" />
      <input type="reset" name="Submit2" value="Cancel" />
	  <input type="hidden" name="pic" value="<? echo $pic; ?>" /></td>
  </tr>
  <tr>
    <td colspan="3" background="images/changebttm_center_cor.jpg">&nbsp;</td>
    </tr>
</table>
</form>

			 
		  <? }
					 ?>
			 <tr>
            <td colspan="3" align="center"><strong><a href="edit.php?pic=<? echo $picture; ?>&act=edit">Edit</a> |<a href="editphoto.php?pic=<? echo $picture; ?>&act=delete">Delete</a> | <a href="editphoto.php?pic=<? echo $picture; ?>&act=send">Send to a Friend </a></strong></td>
          </tr>
		 <?php       $p=$_REQUEST['p'];
if($pic[$p-1]!=''){ 
?>
<tr><td>&nbsp;</td><td>
<a href="editphoto.php?p=<? echo $p-1;?>" >Prev</a></td><? }?><td><?php if($pic[$p+1]!=''){ ?><a href="editphoto.php?p=<? echo $p+1;?>" >Next</a></td><? }?></tr>
<?php 
echo "<tr><td>&nbsp;</td><td><div align=center><img src=images/".$pic[$p]." width=500 height=500 border=0 align=center></div></td></tr>";
?>   

          <tr>
		  <?
		  	  
		 $page_name="photo.php";
         $start=$_GET['start'];	
        if(!($start > 0)) {                         // This variable is set to zero for the first page
         $start = 0;
        }
        $eu = ($start -0);                
         $limit = 1;                                 // No of records to be shown per page.
         $this1 = $eu + $limit; 
         $back = $eu - $limit; 
         $next = $eu + $limit; 
         $query1 = "select * from cpo_usermaster where iUserId='$user_id'";
         $result1= mysqli_query($query1);
        $nume=mysqli_num_rows($result1);
		   $query="select * from cpo_usermaster where iUserId='$user_id' limit $eu, $limit";
			 $result=mysqli_query($query);
			 $row=mysqli_num_rows($result);
			$fetch=mysqli_fetch_array($result);
			  $picture=$fetch['picture'];
	          $pic=explode(",",$picture);
			 
		 		 
		  ?>
		 <?php       $p=$_REQUEST['p'];
if($pic[$p-1]!=''){ 
?>
<tr><td>&nbsp;</td><td>
<a href="editphoto.php?p=<? echo $p-1;?>" >Prev</a></td><? }?><td><?php if($pic[$p+1]!=''){ ?><a href="editphoto.php?p=<? echo $p+1;?>" >Next</a></td><? }?></tr>
<?php 
echo "<tr><td>&nbsp;</td><td><div align=center><img src=images/".$pic[$p]." width=500 height=500 border=0 align=center></div></td></tr>";
?>         		  		  
		   <tr>
		     <td>&nbsp;</td>
		     <td>&nbsp;</td>
		     <td>&nbsp;</td>
		     </tr>
		   <tr>
		
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td></td>
          </tr>
        </table></th>
      </tr>
      <tr>
        <th align="center" valign="top" scope="col"><div align="right"><a href="javascript:history.back();" class="textlink">Back</a></div></th>
      </tr>
      <tr>
        <th colspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><div align="center">
          <? include "includebottom.php";?>
        </div></th>
        </tr>
      
      
      
    </table>      
    </th>
  </tr>
</table>
<p class="table">&nbsp;</p>

<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map>
</form>
</body>
</html>
