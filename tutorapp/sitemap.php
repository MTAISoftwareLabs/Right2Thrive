<?php
include('head.php');
?>

<body>
<table width="800" height="900" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
include('header.php');  
?>
      <tr>
        <td height="622" valign="top">
        	<table width="800" border="0" cellspacing="0" cellpadding="0">
          		<tr>
                  <td width="205" height="200" valign="top" bgcolor="#f5f5f5">
                    <?php include('left.php');?>
                  </td>
                  <td width="580" valign="top">
                    <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr><td colspan="3">&nbsp;</td></tr>
                     	<tr>
                        <td width="75%" class="intheading"><img src="images/layout_33.jpg" width="14" height="14" /> Site Map</td>
                        <td width="8%"><div align="right"><a href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0" /></a></div></td>
                        <td width="17%" class="bodytext"><div align="right"><a  class="links" href="javascript:print()">Print 
                          this page</a></div></td>
                      </tr>
            		</table>
                    
              		<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
                	<tr>
                <td height="20" colspan="2" ><div align="justify" ></div></td>
              </tr >
              <tr>
                <td width="3%" height="23" rowspan="5" valign="top">&nbsp;</td>
                <td height="22"><div align="center"><img src="images/sitemap.jpg" border="0" usemap="#Map" href="course.php" /></div></td>
              </tr>
              <tr>
                <td height="19" colspan="2" valign="top"><font size="1">&nbsp;</font></td>
              </tr>
              		</table>
                    <map name="Map" id="Map">
                <area shape="rect" coords="55,10,92,25" href="index.php" />
                <area shape="rect" coords="51,90,89,106" href="user_login.php" />
                <area shape="rect" coords="46,167,138,179" href="apprenticeships.php" />
                <area shape="rect" coords="47,183,120,196" href="bskills.php" />
                <area shape="rect" coords="45,201,169,216" href="e2e.php" />
                <area shape="rect" coords="45,218,177,234" href="college.php" />
                <area shape="rect" coords="47,238,154,251" href="christmas_work.php" />
                <area shape="rect" coords="47,255,146,270" href="gsce_retakes.php" />
                <area shape="rect" coords="48,273,149,286" href="decide.php" />
                <area shape="rect" coords="49,291,100,304" href="respect.php" />
                <area shape="rect" coords="361,176,432,196" href="products.php" />
                <area shape="rect" coords="363,217,431,236" href="services.php" />
                <area shape="rect" coords="362,260,400,278" href="faq.php" />
                <area shape="rect" coords="363,300,440,317" href="contact.php" />
                <area shape="rect" coords="50,307,154,323" href="w3c_accessibility.php" />
                <area shape="rect" coords="363,136,436,153" href="company.php" />
                <area shape="rect" coords="54,49,129,64" href="morenews.php" />
                <area shape="rect" coords="53,388,119,402" href="jobs.php" />
                <area shape="rect" coords="363,96,489,111" href="/forum" />
                <area shape="rect" coords="363,9,471,24" href="course.php" />
                <area shape="rect" coords="58,348,179,362" href="careerprofile.php" />
                <?
										if(!isset($HTTP_SESSION_VARS['user_id']))
										{
											$str = 'user_login.php';
										}
										else
										{
											$str = 'javascript:chatnow();';
										}
										?>
                <area shape="rect" coords="367,53,497,67" href="<? echo $str;?>" />
              </map>
              		<table width="380" height="272" border="0" align="center" cellpadding="0" cellspacing="0">
                		
              		</table>
              		<table width="380" border="0" align="center" cellpadding="0" cellspacing="0">
                		
                		
              		</table>
                </td>
          	</tr>
        </table>
       </td>
      </tr>
      <?php include('footer.php'); ?>
    </table>
    </td>
  </tr>
</table>

<map name="Map" id="Map"><area shape="rect" coords="4,5,47,28" href="#" /></map>
<map name="Map2" id="Map2"><area shape="rect" coords="5,3,88,28" href="<?php echo $chatstr;?>" /></map>

<map name="Map10" id="Map10">
<area shape="rect" coords="-4,2,157,61" href="#" />
</map>
<map name="Map11" id="Map11">
<area shape="rect" coords="2,1,181,46" href="#" />
</map>
</body>
</html>
