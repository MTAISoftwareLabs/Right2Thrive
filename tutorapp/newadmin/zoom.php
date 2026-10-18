<?php
//@session_start();
@ob_start();
include_once 'dbConnection.php';
//$getct = isset($_GET['ct'])?$_GET['ct']:'';
?>
<?php
if (!isset($_SESSION['user_id']))
{ ?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php
} 


?>
<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title>Learning Resources</title>

</HEAD>
<BODY topmargin="0" leftmargin="0">
<?php include_once('top.php')?>
<table width="999" border="0"  align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="208" valign="top"><?php include_once('add.php')?></td>
	<td width="791" align="center" valign="top">
	
	

	<table width="97%" border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td height="10"></td>
  </tr>
  <tr>
    <td align="left" class="schoolfont">Zoom Class </td>
  </tr>
  <tr><td class="graydotline">&nbsp;</td></tr>
  <tr><td height="30px;"></td></tr>
  <tr>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table width="71%" border="0" cellspacing="0" cellpadding="0">
		<?php
		$act = isset($_REQUEST['act']) ? (string) $_REQUEST['act'] : '';
	if ($act === 'add') { ?>
	  <tr>
   	 <td width="0%" align="right"><img src="images/left-corn-de.gif" /></td>
    <td width="25%" align="center" class="graymid"><a href="learninglinks.php" class="greendeactfont">Zoom Class</a></td>
    <td width="0%" align="left"><img src="images/rigtht-corn-de.gif" /></td>
	 <td width="0%" align="right"><img src="images/left-corn-ac.gif" /></td>
    <!--<td width="25%" align="center" class="midtabgreen">Add Resource Link</td>-->
    <td width="0%" align="left"><img src="images/rigtht-corn-ac.gif" /></td>
	</tr>	
	<?php }else{?>

<?php }?>
</table>
</td>
  </tr>
  <tr><td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr ><td colspan="3" class="greenborder" align="left" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
        
        
        <tr > 
				  		<td > 
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
																			<tr> 
						  						<td bgcolor="#FFFFFF" align="center">
														 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="table">
																<tr> 
								  										<td colspan="2">
																				<table width="100%" border="0" cellspacing="0" cellpadding="0">
									  													<tr> 
																								
										<br>										<br>																																																		
                            <h2 class="toheaderbg"><span class="schoolfont"><a href="index_zoom.php">Create a New Class</a></span></h2>
																								
									  													</tr> 
									  													
																						
																				</table>
																		</td></tr>
																		
																		

  														</table>
  												
          								</tr>
          								<tr> 
            								 	<td align="center" >

												
				
				  					
</body>
</html>
