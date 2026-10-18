<?php

 $main_tab =$_GET['rid'];
?>
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
<link href="css/admin-layout.css" type="text/css" rel="stylesheet">
<table  border="0" width="100%" align="center" cellpadding="0" cellspacing="0" class="personallayout" >
  <tr> 
    <td>&nbsp;</td>
  </tr>
 
   <tr>
          <td class="schoolfont" align="left">Personal Development Admin</td>
        </tr>
        <tr>
          <td class="graydotline">&nbsp;</td>
        </tr>
		  <tr> 
    <td>&nbsp;</td>
  </tr>
		
  <tr> 
  	<td>
		<?php 
		if($main_tab == 'report') { ?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="overview.php?id=personal" class="greendeactfont">Overview</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
                      <td width="25%" align="center" class="midtabgreen"><a href="overview.php?id=report" class="greendeactfont">Monthly Progress Report</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="de_main.php?rid=det" class="greendeactfont">Detention</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                      <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
                      <td width="25%" align="center" class="graymid"><a href="ex_main.php" class="greendeactfont">Exclusion</a></td>
                      <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
                    </tr>
                  </table>
	  <?php } 
	  	else if($main_tab == 'det') { ?>
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=personal" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="mon_main.php?rid=report" class="greendeactfont">Monthly Progress Report</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Detention</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="ex_main.php?rid=exc" class="greendeactfont">Exclusion</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	
	</tr>
</table>
	   <?php } 
	  	else if($main_tab == 'exc') { ?>
		
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="overview.php?id=personal" class="greendeactfont">Overview</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>

    
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="mon_main.php?rid=report" class="greendeactfont">Monthly Progress Report</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="de_main.php?rid=det" class="greendeactfont">Detention</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Exclusion</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>	
	</tr>
</table>
		<?php }
		else
		{  ?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
	       	<tr> 
			<td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <td width="25%" align="center" class="midtabgreen">Overview</td>
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
    <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a  href="mon_main.php?rid=report" class="greendeactfont">Monthly Progress Report</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="de_main.php?rid=det" class="greendeactfont">Detention</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="ex_main.php?rid=exc" class="greendeactfont">Exclusion</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>	
  
	     </tr>
      </table>
		<?php } ?>
	  </td>
  </tr>
</table>