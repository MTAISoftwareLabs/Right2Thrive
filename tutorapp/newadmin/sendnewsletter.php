<?php
include_once "../include/dbConnection.php";
$langid = PSLang_Id();
$langname = PSLang_Name();

// check whether user is admin or not ( logined or not )
if (!isset($_SESSION['user_id']))
{ 
?>
	<script language="JavaScript">
		window.parent.location = '.';
	</script> 
<?php
}
	$message = "";
	$msg_flag = "";
	$mailcontent = "";
	$email_flag = "error";
	$email_from_id = "kalpesh@concept.com";
	$email_from_name = "Neptune Software PLC Admin";
	$fcontent="";
	
	$subscribe_id = trim($_POST['hiddenid']);
	$mailsubject=trim($_POST['txtmailsubject']);

	$file_name="newsletter.htm";
	$file_path="newsletter.htm";
	$fp_write=fopen($file_path,"w+");
	if ( version_compare(phpversion(), '4.1.0' ) == -1 )
	{
		$postArray = &$_POST ;	
	}
	else
	{
		$postArray = &$_POST;
	}
	foreach ( $postArray as $sForm => $value )
	{
		if($sForm=='FCKeditor1')
		{
			$value = stripslashes( $value );
			fputs($fp_write,$value);
		}
	}
	fclose($fp_write);
	$fp_read = fopen($file_path,'r');
	if(filesize($file_path) > 0)
	{
		$fcontent = fread ($fp_read, filesize ($file_path));
	}
	fclose ($fp_read);
	if ( $fcontent != "" )
	{
		$mailcontent = $fcontent;
		$select_qry = "select * from tbl_subscriber where iSub_id in (".$subscribe_id.")";
		$result = runquery($select_qry) or die('Error in Database '.mysqli_error());
		$numberofrecord = mysqli_num_rows($result);
		if ( $numberofrecord > 0 )
		{
			while( $rsemail = mysqli_fetch_array($result))
			{
				$email_to_id = $rsemail['vSub_email'];
				$email_to_name = $rsemail['vSub_name'];
				if ( $email_to_id != "" )
				{
					SendingMail($email_from_name, $email_from_id, $email_to_name, $email_to_id, $mailsubject, $mailcontent);
					$email_flag = "send";
				}
			}
		}
	}
	else
	{
		$email_flag = "nocontent";	
	}
	if ( $email_flag == "send" )
	{
		$message = "News Letter Posted Successfully.";
		$msg_flag = "green";
	}
	if ( $email_flag == "nocontent" )
	{
		$message = "Mail Content is Blank.";
		$msg_flag = "red";
	}
	if ( $email_flag == "error" )
	{
		$message = "Error in News Letter Post.";
		$msg_flag = "red";
	}
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>VYMAN Newsletter</title>
</HEAD>
<BODY leftmargin="0" topmargin="0" class="seffect">
	<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr> 
			<td>&nbsp;</td>
		</tr>
		<tr> 
			<td><h3><b>Send Newsletter Admin</b></h3></td>
		</tr>
		<tr> 
      		<td> 
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr> 
						<td width="1%"  height="23"><img src="./images/start.jpg" width="6" height="23"></td>
						<td width="18%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Message</font></div></td>
						<td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_last.jpg" width="11" height="23"></div></td>
						<td width="80%" background="./images/middle_last.jpg"><div align="right"></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr> 
			<td> 
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
          			<tr> 
            			<td bgcolor="F5F8FF">&nbsp;</td>
          			</tr>
          			<tr>
            			<td bgcolor="#FFFFFF">&nbsp;</td>
          			</tr>
          			<tr> 
            			<td bgcolor="#FFFFFF">
							<table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
                				<tr> 
                  					<td colspan="2">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      						<tr> 
												<td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
												<td width="700" class="headingtd">Information</td>
												<td width="300" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      						</tr>
                    					</table>
									</td>
                				</tr>
                				<tr>
                  					<td class="bodytext" colspan="2" height="22">&nbsp;</td>
                				</tr>
						<?php if($msg_flag == "red") { ?>
								<tr>
									<td height="36" colspan="2" class="error" align="center"><img src="images/alert.gif" border="0"></td>
								</tr>
								<tr>
									<td height="36" colspan="2" class="error" align="center"><?php echo $message; ?></td>
								</tr>
						<?php }	else {	?>
								<tr>
									<td height="36" colspan="2" class="comment" align="center"><?php echo $message; ?></td>
								</tr>
						<?php }	?>
								<tr> 
									<td colspan="2" align="right" height="32">
										<a href="selectgroup.php"><img src="images/go_back.gif" border="0" alt="Go Back"></a>&nbsp;&nbsp;
									</td>
								</tr>
              				</table>
						</td>
          			</tr>
          			<tr> 
            			<td bgcolor="#FFFFFF">&nbsp;</td>
          			</tr>
	        	</table>
			</td>
		</tr>
	</table>
</BODY>
</HTML>
