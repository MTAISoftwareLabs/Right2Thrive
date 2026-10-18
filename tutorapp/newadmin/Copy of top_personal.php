<?php
 $main_tab =$_GET['rid'];
?>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<table  border="0" width="95%" align="center" cellpadding="0" cellspacing="0" class="personallayout" >
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td><h3><b>Personal Development Admin</b></h3></td>
  </tr>
  <tr> 
  	<td>
		<?php 
		if($main_tab == 'report') { ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
					<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=personal">Overview</a></div></td>
					<td width="1%" valign="top" background="images/middle.jpg"><div align="center"><img src="images/active_middle.jpg" width="11" height="23"></div></td>
					<td width="25%" background="images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Monthly Progress Report</font></div></td>
					<td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
					<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="de_main.php?rid=det">Detention</a></div></td>
					<td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
					<td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="ex_main.php?rid=exc">Exclusion</a></div></td>
					<td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
					<td width="27%" background="images/middle_last.jpg"><div align="right"></div></td>
				</tr>
			</table>
	  <?php } 
	  	else if($main_tab == 'det') { ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=personal">Overview</a></div></td>
            <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></div></td>
            <td width="25%" background="images/middle.jpg"><div align="center"><font color="#000099"><a class="tablink" href="mon_main.php?rid=report">Monthly Progress Report</a></font></div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Detention</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="ex_main.php?rid=exc">Exclusion</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="27%" background="images/middle_last.jpg"></td>
          </tr>
        </table>
	   <?php } 
	  	else if($main_tab == 'exc') { ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
					<td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=personal">Overview</a></div></td>
                  <td width="1%" valign="top" background="images/middle.jpg"><div align="center"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" 
                  width=11></div></td>
                  <td width="25%" background="images/middle.jpg"><div align="center"><a class="tablink" href="mon_main.php?rid=report">Monthly Progress Report 
                      </a></div></td>
                  <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
                  <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="de_main.php?rid=det"><font color="#000099">Detention</font><font color="#000099"></font></a><a class="tablink" href="viewcategory.asp"></a></div></td>
                  <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
                  <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Exclusion </div></td>
                  <td width="1%"><div align="right"><img src="images/active_last.jpg" width="11" height="23"></div></td>
                  <td width="27%" background="images/middle_last.jpg"><div align="right"></div></td>
				</tr>
						</table>
		<?php }
		else
		{  ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	       	<tr> 
			<td width="1%" height="23" background="images/middle_middle.jpg"><img src="images/start.jpg" width="6" height="23"></td>
          <td width="17%" class="bodytext" background="images/middle_middle.jpg"><div align="center"><strong><font color="#000099">Overview</font></strong></div></td>
          <td width="1%" background="images/middle.jpg"><div align="center"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></div></td>
          <td width="25%" background="images/middle.jpg"><div align="center"><a class="tablink" href="mon_main.php?rid=report"><font color="#000099">Monthly Progress Report</font></a></div></td>
          <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
          <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="de_main.php?rid=det"><font color="#000099">Detention</font><font color="#000099"></font></a></div></td>
          <td width="1%" background="images/middle.jpg"><IMG height=23 src="images/bg_bodytab_crnr2.jpg" width=11></td>
	      <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="ex_main.php?rid=exc"><font color="#000099">Exclusion</font></a></div></td>
          <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
          <td width="27%" background="images/middle_last.jpg"><div align="right"></div></td>
  
	     </tr>
      </table>
		<?php } ?>
	  </td>
  </tr>
</table>