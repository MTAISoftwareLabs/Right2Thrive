<?php
include_once 'dbConnection.php';
if(isset($_REQUEST['type']))
{
	if($_REQUEST['type'] == 'E')
	{	$t = 'Exclusion';}
	else
	{ $t ='Detention';}
}

	 $sql="SELECT * FROM cpo_detention where I_detentionid=".$_GET['id'];
	$rID=runquery1($sql);
	if(isset($rID))
	{
		$result_info = mysqli_fetch_array($rID);
	}
if(isset($_POST['hdn_submit']) && $_POST['hdn_submit'] == 1)
{

	$comment	= $_POST['txttcomments'];
	$insql = "update cpo_detention set T_tcomments  ='".$comment."' where I_detentionid =".$_GET['id'];
	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		window.close();
	</script>;
	<?php  }
	else
	{
		$msg = "Sorry comment cannot be inserted";
		$flg = "red";
	}
}

?>
<style>
.bothfeatured3
{
	border-left:1px solid #88B4F9;
	border-right:1px solid #88B4F9;	
}
.flipv {
	FILTER: FlipV();
}
</style>
<script type="text/javascript" language="javascript">
function validate()
{
	if(document.frmhw.txttcomments.value == '')
	{
		alert('Please enter your comments');
		document.frmhw.txttcomments.focus();
		return false;
	}
}
</script>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/css_styles.css" rel="stylesheet" type="text/css">
<title><?php echo sitename;?><?php echo $t;?>- Detail View</title>
<body topmargin="0">
<form name="frmhw" method="post" action="" onSubmit="return validate()">
	<input type="hidden" name="hdn_submit" value="1">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top"> 
    <td height="10" colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr valign="top"> 
    <td height="35" colspan="4"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>CareerPaths 
      Online</strong></font></td>
  </tr>
  <tr> 
    <td colspan="4"><img src="../images/whiteimage.jpg" width="6" height="5"></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg" class="flipv"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg" class="flipv"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
  <tr> 
    <td colspan="4" class="bothfeatured3"><table width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr> 
			<td></td>
          <td width="63%" valign="top"><font size="4" face="Verdana, Arial, Helvetica, sans-serif"><b></b></font></td>
          <td width="2%" valign="top"><div align="right"><a href="javascript:print();"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
          <td width="20%" valign="top"><div align="center"><a href="javascript:print();">Print this Page</a>&nbsp;&nbsp;</div></td>
        </tr>
        <tr> 
          <td colspan="4">
<table width="97%" border="0" align="center" cellpadding="4" cellspacing="1" bgcolor="DFEAF2" class="">
          
            
			    <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Learner Name</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php
				 $sqlstu = "select vUserName from cpo_usermaster where iUserId=".$result_info['I_userid'];
						$rsstu = runquery($sqlstu);
						$num1 = $rsstu ? mysqli_num_rows($rsstu) : 0 ;
						if ($num1 > 0 )
						{
							$rsdata = mysqli_fetch_array($rsstu);
							 $stuname = $rsdata['vUserName'];
							 echo ucfirst($stuname);
						}
						
				  ?> </td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong><?php echo $t;?> Date</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php  $date = explode('-', $result_info['D_detention']); echo $date[2]."/".$date[1]."/".$date[0];?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext">&nbsp;<strong><?php echo $t;?> Reason</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php if( $result_info['V_reason'] != '') { echo ucfirst($result_info['V_reason']);} else { echo "-";}?></td>
              </tr>
			    <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext">&nbsp;<strong>Improvement</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php  if( $result_info['T_improve'] != '') {  echo ucfirst($result_info['T_improve']); } else { echo "-";}?></td>
              </tr>
			      <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Tutor  Comments</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php   if( $result_info['T_tcomments'] != '') {  echo ucfirst($result_info['T_tcomments']);  } else { ?><textarea name="txttcomments" cols="60" rows="3"></textarea>   <?php }?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Student Comments</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php if($result_info['T_scomments'] != ''){echo $result_info['T_scomments'];}else { echo "-"; }?></td>
              </tr>
			  <tr bgcolor="#FFFFFF"> 
                <td width="27%" height="22" class="bodytext"><strong>Parent Comments</strong></td>
                <td width="73%" height="22" class="bodytext">&nbsp;<?php if($result_info['T_pcomments'] != ''){echo $result_info['T_pcomments'];}else { echo "-"; }?></td>
              </tr>
             
            
            </table></td>
        </tr>
        <tr> 
          <td colspan="4"><div align="right"><?php if($result_info['T_tcomments'] !=''){  }else {?>
				<input type="image" src="../admin/images/submitbttn.jpg"><?php }?>&nbsp;&nbsp;<img src="images/closebutton.gif" onClick="javascript:window.close();" style="cursor:hand">&nbsp;&nbsp;</div></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td background="../images/coupons3.jpg"><img src="../images/coupons2.jpg" width="5" height="5"></td>
    <td colspan="2" background="../images/coupons3.jpg"><img src="../images/coupons3.jpg" width="5" height="5"></td>
    <td background="../images/coupons3.jpg"><div align="right"><img src="../images/coupons4.jpg" width="5" height="5"></div></td>
  </tr>
</table>
</form>
</body>
<?php

?>