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
if(isset($_POST['photoupload']))
{
//echo $user_id;
$pic=$_REQUEST['pic'];
 $target_path="images/";
				$user1=$_FILES['picture']['name'];
				$target_path=$target_path.basename($_FILES['picture']['name']); 
				if(move_uploaded_file($_FILES['picture']['tmp_name'],$target_path))
				 {
				    //echo "The file ".  basename( $_FILES['image']['name'])." has been uploaded";
				 }
			   else
				{
				    echo "There was an error uploading the file, please try again!";
				}
 $q="select * from cpo_usermaster where iUserId='$user_id'";
			$r=mysqli_query($q);
			$f=mysqli_fetch_array($r);
			$a1[]=$f['picture'];
			  $picture=$f['picture'];
	          $pic1=explode(",",$picture);
			//print_r($pic1);
			$key1 = array_search($pic, $pic1); // $key = 2;
			 // echo $key1;
						$a=$pic1[$key1];
						//echo $a;
						$a3=str_replace($a,$user1,$a1);
	$arr=implode(",",$a3);
	$q1="update cpo_usermaster set picture='$arr' where iUserId='$user_id'";
		mysqli_query($q1);
			 header("location:edit.php?edit=1&pic=$user1");

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
<? $pic=$_REQUEST['pic'];
$edit=$_REQUEST['edit'];
?>
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
        <th align="center" valign="top" scope="col">
		<form name="form1" enctype="multipart/form-data" method="post" action="">
		<p>&nbsp;</p>
		<? if($edit==1){
		echo " You Have Successfully Updated Photo";
		} 
		else{?>
		<table width="500" border="0">
          <tr>
            <td><img src="images/<? echo $pic; ?>" width="450" height="350" /></td>
		 </tr>
        </table>
		<p>&nbsp;</p>
		<table width="94%" border="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF">
        <br />  
        <tr>
            <td height="22" colspan="3" background="images/changep_center_cor.jpg"><strong>Upload Photo : </strong></td>
            </tr>
          <tr>
            <td width="31%"><div align="right"><strong>Picture</strong></div></td>
            <td width="1%"><strong>:</strong></td>
            <td width="68%">
              <input type="file" name="picture">            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="photoupload" type="submit" id="photoupload" value="Update" />
              <input type="reset" name="Submit2" value="Cancel" />
			  <input type="hidden" name="picture" value="<? echo $pic; ?>" />
			  </td>
          </tr>
          <tr>
            <td colspan="3" background="images/changebttm_center_cor.jpg">&nbsp;</td>
            </tr>
        </table>
		
	  

		</form>
		<? } ?>
		 </th>
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
<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map></body>
</html>
