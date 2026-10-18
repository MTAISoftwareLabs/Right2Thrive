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
} ?>
<HTML>
<HEAD>
<link href="adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
</HEAD>

<form name=MailFormat method=GET action=deletecourse.php>		
<?php
	$sql="SELECT * FROM course_master";
    $rID=mysqli_query( $sql,$_SESSION['conn']);
?>
  <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">

<table width="100%" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td>
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr> 
					<td><h3><b>Admin - Course</b></h3></td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
            					<td width="1%" height="23" background="./images/middle.jpg"><img src="./images/start1.jpg" width="6" height="23"></td>
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./AddAreas.php">Add</a></div></td>
            					<td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_middle.jpg" width="11" height="23"></div></td>
            					<td width="17%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Edit</font></div></td>
            					<td width="1%" background="./images/middle.jpg"><img src="./images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./DeleteAreasView.php">Delete</a></div></td>
            					<td width="1%" background="./images/middle.jpg"><IMG height=23 src="./images/bg_bodytab_crnr2.jpg" width=11></td>
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./ViewAreas.php">View</a></div></td>
            					<td width="1%"><div align="right"><IMG height=23 src="./images/bg_bodytab_crnr3.jpg" width=11></div></td>
            					<td width="28%" background="./images/middle_last.jpg"><div align="right"></div></td>
          					</tr>
						</table> 
					</td>
				</tr>
				<tr> 
					<td> 
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="microsoftlayout">
							<tr> 
								<td colspan="2" bgcolor="F5F8FF">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr> 
								<td width="85%" align="right"><a href="javascript:print()"><img src="./images/print.jpg" width="16" height="16" border="0"></a></td>
								<td width="13%" bgcolor="#FFFFFF"><a href="javascript:print()">Print this page</a></td>
							</tr>
							<tr> 
								<td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
							</tr>
							<tr> 
								<td colspan="2">    		

  <table width="100%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
     <tr> 
      <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
            <td width="517" class="headingtd">Edit / Delete Course </td>
            <td width="425" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=250></div></td>
          </tr>
        </table></td>
    </tr>  
    <tr > 
      <td height="12" colspan="4"> 
        <div align="center"></div>
      </td>
    </tr>
    <tr> 
      <td width="7%" height="15" align="center"  class="lighttd2">#
      </td>
      <td  class="lighttd2"><b>Course Name </b>
        </td>
      <td  class="lighttd2"><b>Description</b>
        </td>
		<td  class="lighttd2"><b>Institute Name</b>
        </td>
		<td  class="lighttd2"><b>Status</b>
        </td>
     
    </tr>
	<tr > 
      <td colspan="4"> 
        <div align="center"></div>
      </td>
    </tr>
    <?php if($rID)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_row($rID))
                    {
                    	?> 
    <tr> 
      <td align="center" > 
        <input type="checkbox" name=cbo<?phpecho $cnt;?>>
        <input type="hidden" name=hb<?phpecho $cnt;?> value=<?phpecho $rs[0];?>>
      </td>
      <td width="26%" align=left > <a href=update_course.php?id=<?phpecho $rs[0];?> ><?phpecho $rs[1];?></a> 
      </td>
      <td width="25%" align=left > <?phpecho $rs[2];?> </td>
      <td width="25%" align=left > <?php $fetch="select * from institute_master";
							$result=mysqli_query($fetch);
							$count=mysqli_num_rows($result);
							
							while($row=mysqli_fetch_array($result))
							{
								if($row["institute_id"]==$rs[3])
										echo $row["institute_name"];
							}
							?> </td>
	   <td width="16%" align=left > <?php if($rs[4]=='y') 
	   									 echo "OPEN";
										else
										echo "CLOSE";
										?> </td>
    </tr>
    <?php
			            $cnt=$cnt+1;
					}
					?> 
    <input type=hidden name=count value=<?phpecho $cnt-1;?>>
	<tr > 
      <td height="12" colspan="4"> 
        <div align="center"></div>
      </td>
    </tr>
    <tr > 
      <td colspan="4" align=left> 
        <input name="image" type="image" src="images/delete1.gif" width="73" height="22">
      </td>
    </tr>
	<tr > 
      <td height="12" colspan="4"> 
        <div align="center"></div>
      </td>
    </tr>
    <?php
				  }
				  else
				  {
				      echo "No Course found";
				  }
			?> 
  </table>
</form>
</BODY>
</HTML>

