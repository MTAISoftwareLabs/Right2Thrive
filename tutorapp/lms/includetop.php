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
		window.location="logout.php";
	}
}
</script>
  <tr>
   <td colspan="2" width="100%"><img name="lms_1_r1_c1" src="images/lms_1_r1_c1.gif" width="775" height="5" border="0" alt=""></td>
  </tr>
  <tr>
    <td valign="top"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="202" height="102">
        <param name="movie" value="images/flash%20logo.swf">
        <param name="quality" value="high">
        <embed src="images/flash%20logo.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="202" height="102"></embed>
		</object></td>
   	<td><img src="images/lmshead.jpg" alt="" name="lms_1_r2_c2" width="573" height="102" border="0" usemap="#lms_1_r2_c2Map"><map name="lms_1_r2_c2Map"><area shape="rect" coords="491,88,551,100" href="javascript:logout();"></map></td>
  </tr>
  <tr><td><img src="images/spacer.gif" alt="" id="spacer"></td></tr>