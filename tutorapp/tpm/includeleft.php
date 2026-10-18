<table width="98%" border="0" cellspacing="0" cellpadding="0" >
  <tr> 
    <td height="21" colspan="3" background="images/logo_bg.jpg" class="career"><div align="center">Career 
        Paths Online</div></td>
  </tr>
  <tr> 
    <td width="4%" height="22" background="images/navig_left_bg.jpg" >&nbsp;</td>
    <td width="88%" height="22" background="images/navig_center_bg.jpg"  >&nbsp;<a class="sidemainlink" href="index.php">Home</a></td>
    <td width="4%" height="22" background="images/navig_right_bg.jpg">&nbsp;</td>
  </tr>
  
  
  <tr >
    <td height="36" colspan="3" background="images/personalinfo_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="19%" height="20">&nbsp;</td>
          <td width="81%" height="20" class="personal">Comments</td>
        </tr>
      </table></td>
  </tr>
  <!--<tr>
    <td height="22" colspan="3"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;" class="normaltext"><b>Personal Development</b></td>
        </tr>
		<tr>
          <td width="17%" style="border-bottom : 1px solid  #D6D6D6;"></td>
          <td width="83%" height="20"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;<a class="sidelink" href="progress.php">Monthly Report</a></td>
        </tr>
        <tr>
          <td width="17%" style="border-bottom : 1px solid  #D6D6D6;"></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;">&nbsp;<a class="sidelink" href="detreport.php">Detention</a></td>
        </tr>
		<tr>
          <td width="17%" style="border-bottom : 1px solid  #D6D6D6;"></td>
          <td width="83%" height="20"  style="border-bottom : 1px solid  #D6D6D6;">&nbsp;<a class="sidelink" href="exreport.php">Exclusion</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>-->
  <tr>
    <td height="22" colspan="3"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td height="20" style="border-bottom : 1px solid  #D6D6D6;" class="normaltext"><b>Personal Development</b></td>
        </tr>
	<? 
	$page = substr(strrchr($_SERVER['PHP_SELF'],'/'),1);
	if($page == 'progress.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Monthly Report</b></font></td>
        </tr>
	<? } else
	{?>
	 <tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="progress.php"><b>Monthly Report</b></a></td>
        </tr>
	
	<? }
	if($page == 'detreport.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Detention</b></font></td>
        </tr>
	<? } else
	{?>
	<tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="detreport.php"><b>Detention</b></a></td>
        </tr>
	
	<? }
	if($page == 'exreport.php')
	{?>
	<tr>
          <td width="17%" class="sidelinkac"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" class="sidelinkac" style="border-bottom : 1px solid  #D6D6D6;"><font class="normaltext"><b>Exclusion</b></font></td>
        </tr>
	<? } else
	{?>
	<tr>
          <td width="17%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="83%" height="20" style="border-bottom : 1px solid  #D6D6D6;"><a class="sidelink" href="exreport.php"><b>Exclusion</b></a></td>
        </tr>
	
	<? } ?>
		
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  
  <tr > 
    <td height="36" colspan="3" background="images/personalinfo_bg.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="18%" height="20">&nbsp;</td>
          <td width="82%" height="20" class="personal">Student Log Book</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td height="22" colspan="3"><table width="90%" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr> 
          <td width="9%"  style="border-bottom : 1px solid  #D6D6D6;"><div align="center"><img src="images/arrow.jpg" width="6" height="6"></div></td>
          <td width="91%" height="20" style="border-bottom : 1px solid  #D6D6D6;"> 
            <a class="sidelink" href="viewlog.php">View Log Book</a></td>
        </tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
      </table></td>
  </tr>
  
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2"  style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="induction_pack.php">Induction 
      Pack</a></td>
  </tr>
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="disability_policy.php">Disability Policy</a> </td>
  </tr>
  <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="equal_opportunity.php">Equal 
      Opportunity</a></td>
  </tr>
    <tr> 
    <td height="22" colspan="3" bgcolor="#DEF2D2" style="border-bottom : 1px solid  #ffffff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="sidemainlink" href="terms_conditions.php">Terms & Conditions</a></td>
  </tr>
  <tr> 
    <td colspan="3" class="personal" style="border-bottom : 1px solid  #ffffff;"><font size="1">&nbsp;</font></td>
  </tr>
  <tr> 
    <td height="22" colspan="3" class="personal" style="border-bottom : 1px solid  #ffffff;"><img src="images/shareyorth_img.jpg" width="198" height="68"></td>
  </tr>
</table>
