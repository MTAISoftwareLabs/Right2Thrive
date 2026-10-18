<?php
@ob_start();
include_once 'dbConnection.php';
require "../include/globals.php";

?>

<html>
<head>
<title>Delete Course</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/adminstyle.css" type="text/css" rel="stylesheet">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="seffect">
<?php
			$courseid = $_GET['aid'];
			$catfid="";
			$flg ="aa";
			$msg="";
			$flag=0;
			
//  when user delete thrue X image of delete ( only one )

			if($courseid  != 0)
			{
				
				$sql="delete from newsinfo where news_id=" .$courseid;
				$rscheck=mysqli_query($sql,$_SESSION['conn']);
				$msg = "News  Deleted Successfully";
				$flg = "green";
			}
//  when user delete thrue [] image of delete (i.e.  Multy selection for delete )
			else
			{
				$sqlcat="select * from newsinfo";
				$del_more = mysqli_query($sqlcat);
				if ($del_more)
				{
					$num = mysqli_num_rows($del_more);
				}
				else
				{
					$num = 0;
				}
				
				if($num > 0)
				{
					
					while($rslist = mysqli_fetch_array($del_more))
					{
						if(isset($_POST[$rslist["news_id"]]))
						{
							$rowval = $_POST[$rslist["news_id"]];
							if($rowval="on")
							{
								$id = $rslist["Course_id"];
								$sql="delete from newsinfo where news_id=" .$id ;
								mysqli_query($sql);
								
							}
						}
					}
									
								
			}
			$msg = "News  Deleted Successfully";
				$flg = "green";
			}
?>
			<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  				<tr> 
    				<td>&nbsp;</td>
  				</tr>
  				<tr> 
    				<td><h3><b>Admin - News</b></h3></td>
  				</tr>
  				<tr> 
    				<td> 
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
            					<td width="1%" height="23" background="./images/middle.jpg"><img src="./images/start1.jpg" width="6" height="23"></td>
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./AddAreas.php">Add</a></div></td>
            					<td width="1%" background="./images/middle.jpg"><IMG height=23 src="./images/bg_bodytab_crnr2.jpg" width=11></td>																
            					<td width="17%" background="./images/middle.jpg"><div align="center"><a class="tablink" href="./EditAreasView.php">Edit</a></div></td>
            					<td width="1%" valign="top" background="./images/middle.jpg"><div align="center"><img src="./images/active_middle.jpg" width="11" height="23"></div></td>
            					<td width="17%" background="./images/middle_middle.jpg" class="activelink"><div align="center"><font color="#000099">Delete</font></div></td>
            					<td width="1%" background="./images/middle.jpg"><img src="./images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
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
          					<td bgcolor="F5F8FF">&nbsp;</td>
        				</tr>
        				<tr> 
          					<td bgcolor="#FFFFFF">&nbsp;</td>
        				</tr>
        				<tr> 
          					<td> 
								<table align="center" width="70%" class="table" border="0" cellspacing="0" cellpadding="0">
              						<tr> 
                						<td> 
											<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    							<tr> 
                      								<td width="3"><img src="./images/round_corner.gif" width="3" height="20"></td>
                      								<td width="100%" class="headingtd">&nbsp;<font color="#FFFFFF"><strong>Delete Area(s)</strong></font></td>
                    							</tr>
                  							</table>
										</td>
              						</tr>
              						<tr> 
									<?php if ($flg == "red") 
									{
									?>
										<td height="30" align="center" class="Error"><img src="./images/alert.gif"></td>
									</tr>
									<tr>
                						<td height="30" align="center" class="Error"><?php echo $msg ;?> </td>
									<?php
									}
									else
									{
									?>
                						<td height="30" align="center" class="Comment"><?php echo $msg ;}?> </td>									
              						</tr>
              						<tr> 
				                      <td align="right">
										  <a href="./Deletenews2.php?curpage=<?php echo $_GET['curpage'];?>"><img src="./images/go_back.gif"  alt="Go Back" border="0"></a>&nbsp;
				                      </td>
              						</tr>
              						<tr bgcolor="#FFFFFF" > 
                						<td height="28" colspan="3" class="flipv" background="./images/line.jpg">&nbsp;</td>
              						</tr>
            					</table>
							</td>
        				</tr>
        				<tr> 
          					<td>&nbsp;</td>
        				</tr>
        				<tr> 
          					<td>&nbsp;</td>
        				</tr>
     	 			</table>
				</td>
  			</tr>
		</table>
</body>
</html>
