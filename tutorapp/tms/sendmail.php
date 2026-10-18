<?php
include "dbConnection.php";
$fromname=$_SESSION['user_name'];

if (!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
function getlearnernames($ids)
{

	$strnames = '';
	if($ids)
	{	
		$strids = explode(',',$ids);
		
		for($i=0;$i<count($strids);$i++)
		{
			$sqlselect = "select vUserName from cpo_usermaster where iUserId=".$strids[$i];
			//echo $sqlselect.'<br>';
			$rssqlselect = runquery($sqlselect);
			if(isset($rssqlselect))
			{
				$rssqlselect1 = mysqli_fetch_array($rssqlselect);
				$strnames = $strnames.$rssqlselect1[0].' , ';
			}
		}
		$strnames = substr($strnames,0,strlen($strnames)-2);
	}
	return $strnames;
}
function getIcon($filename)
{
	switch(substr($filename,strlen($filename)-3,strlen($filename)))
	{
		case "swf" : 
			return "images/swf.gif";
			break;
		case "doc" : 
			return "images/doc.gif";
			break;			
		case "jpg" : 
			return "images/jpg.gif";
			break;			
		case "peg" : 
			return "images/jpg.gif";
			break;			
		case "gif" : 
			return "images/gif.gif";
			break;			
		case "pdf" : 
			return "images/pdf.gif";								
			break;
		default : 
			return "NONE";				
			break;			
	}
}
?>
<html>
<head>
<title><?php echo sitename;?>Upload files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="tms.css" rel="stylesheet" type="text/css">
<script language="JavaScript">

function validation()
{
  
	if(document.FRMUPLOADFILE.txtsubject.value == "")
	{
		alert("Please write messege Subject !");
		document.FRMUPLOADFILE.txtsubject.focus();
		return false;
	}

	if (document.FRMUPLOADFILE.txtcontents.value == "")
	{
		alert("Please write messege Contents !");
		document.FRMUPLOADFILE.txtcontents.focus();
		return false;
	}
	
	
	return true;
}
</script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
  <tr> 
    <td colspan="2" valign="top"><?php include "includetop.php";?></td>
  </tr>
  <tr> 
    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
      <?php include "includeleft.php";?>
    </td>
    <td valign="top"> 
      <?php include "includewelcome.php";?>
    </td>
  </tr>
  <tr> 
    <td valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td> 
            <form name="FRMUPLOADFILE" method="post" onSubmit="return validation();" action="sendmail.php?next=1"  enctype="multipart/form-data">			
			 
					  		<?php
								if(isset($_GET['next']) && $_GET['next'] == 1)
								{
// 								     var_dump($_POST);
//   exit;
								
								    $learner_id = "";	
                		foreach($_POST['CMBLEARNER'] as $value)
                		{
                			$learner_id.= $value. ",";
                		}
                		$learner_id = substr($learner_id,0,strlen($learner_id)-1);
                		if ($learner_id <> "-")
                		{
								
      								    $fromname=$_SESSION['user_name'];
      								    $to=$_POST['email'];
      								    $subject=$_POST['txtsubject'];
      										$message=$_POST['txtcontents'];
      								
      								  //  foreach($_POST['CMBLEARNER'] as $value)
      										// {
      											$idname =explode(',',$value);								  
      											
      											$toname=$idname[1];
      											$toaddress=$idname[0];
      											 $header = "From:hello@right2thrive.org \r\n";
        //  $header .= "Cc:afgh@somedomain.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
      											$mailflg=mail($to, $subject, $message,$header);
      										
      										// 	$mailflg=SendingMail($fromname, admin_email,$toname ,$toaddress, $subject, $message);
      										
      						// 			$a=mail("masud.rana3836@gmail.com",$subject,$message);
      						// 				if($a){
      						// 				    echo("success");
      						// 				}	 		
      										// }
      											$msg = "Mail Sent to Learner Successfully.";
      							}
      							else
      							{
      							       $msg = "First Select Learner.";
                    }
					
					             $color = "black";
								      
								?>
								        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                      <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="welcome">Send Mail to Learner</td>
                      <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
					<table class="" width="90%" align="center">
						<tr>
							<td colspan="2" align="center" class="bodytext"><font color="<?php echo $color;?>"><b><?php echo $msg?></b></font></td>
						</tr>
						<tr><td colspan="2">&nbsp;</td></tr>					
					</table>
				</td>
              </tr>
              <tr> 
                <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right"><img style="cursor:hand" src="images/closebutton.gif" alt="Close" width="67" height="17" onClick="javascript:document.location='./'"></div></td>
                <td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
								    
                 <?php	
								}
								else
								{
								?>
								 <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          				  <tr> 
          					<td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
          					<td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          						<tr> 
          						  <td class="welcome">Send Mail to Learner</td>
          						  <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
          						</tr>
          					  </table></td>
          					<td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
          				  </tr>
          				  <tr> 
					
                  <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp; 
					       <table class="" width="90%" align="center">
					  <?php
								
                
								$sqllearner = "select vUserEmailId,iUserId,vUserName from cpo_usermaster";
								$rslearner = runquery($sqllearner);
								$num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; 
																									
							?>
							<tr>
								<td class="bodytext">&nbsp;Select Learner</td>
								<td class="bodytext">
									<select name="email" class="textbox">
									  <option  selected>Select Learner</option>
										<?php
											while ($rsdata = mysqli_fetch_array($rslearner))
											{ ?>
												 <option value="<?php echo $rsdata['vUserEmailId'] ?>"><?php echo $rsdata['vUserName'];?></option>
											<?php }
										?>
									</select>
								</td>
							</tr>
								<tr>
								<td class="bodytext">&nbsp;Messege Subject</td>
								<td class="bodytext"><input name="txtsubject" type="text" class="textbox" size="50"></td>
							</tr>	
					  	<tr>
								<td class="bodytext">&nbsp;Messege Contents</td>
								<td class="bodytext"><textarea name="txtcontents" class="textbox" rows="8" cols="50"></textarea></td>
							</tr>		
							
					  </table>
                  </td>
				  </tr>
				  <tr> 
					<td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
					<td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                      <input name="image" type="image" src="images/submitbttn.jpg" alt="Submit" width="67" height="17">
                    </div></td>
					<td width="11" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
				  </tr>
				  <tr><td>&nbsp;</td></tr>
				</table>
				<?php
        }
        ?>
				
				</form>				
		  	</td>
		</tr>

		
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
 <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>

</html>
