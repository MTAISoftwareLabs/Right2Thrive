<script language="JavaScript">
function logout()
{
	if(<? echo $_SESSION['log_fill'];?>==0)
	{
		var con = confirm('Please fill up your log book entry');
	}
	if(con)
	{
		window.location="StudentLogBook.php";
	}
	else
	{
		window.location="../index.php";
	}
}
</script>

<link href="../newadmin/css/adminstyle.css" rel="stylesheet" type="text/css" />
<link href="../newadmin/css/style.css" rel="stylesheet" type="text/css" />
<link href="../newadmin/css/tracking.css" rel="stylesheet" type="text/css" />
<table width="911" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>

    <td colspan="2" valign="top" class="banner"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="logo" width="65%"><img src="../newadmin/images/logo.gif" /></td>
    <td width="35%" class="greenfont" valign="top"></td>
  </tr>
</table>
</td>
</tr>
<tr><td colspan="2" class="topbor"><img src="../newadmin/images/spacer.gif" /></td></tr>
<tr><td colspan="2" class="graybg"></td></tr>
<tr><td class="purple" width="899px;">&nbsp;</td>
  <td class="signoutbg" align="center" valign="middle"><a href="javascript:logout();" class="textlink">Sign Out</a></td>
</tr>
</table>
