<?php
@ob_start();
include_once 'dbConnection.php';
if(isset($_GET['active']))
{
for($count=1;$count<=$_POST['txtcnt']-1;$count++)
{
	
	$str="chk".$count;

	if(isset($_POST[$str]))
	{
		$abc="hb".$count;
		$query="update cpo_usermaster set iUserStatus=1 where iUserId=".$_GET[$abc];

	}
	else
	{
		$abc="hb".$count;
		
		$query="update cpo_usermaster set iUserStatus=0 where iUserId=".$_GET[$abc];
	}
			
	$rscheck=runquery1($query) or die('error'.mysqli_error());

}
}


//	$sql="SELECT * FROM cpo_CourseMaster order by vCourseName";
	$sql="SELECT * FROM cpo_usermaster where iUserType=2 order by dUserRegDate";
    $rID=runquery1( $sql);
	$count = mysqli_num_rows($rID);
	/*Paging Code*/
									  $page=Ceil($count/page_size);
									  if(isset($_GET['curpage']))
									  {
									  	$curpage = $_GET['curpage'];
									  	if($curpage==0)
										{
											 $sql.=" Limit 0,".page_size;
											 $lmt =" Limit 0,".page_size;
										}
										else
										{
											$current=page_size*($curpage);
											$sql.=" Limit " .$current. ",".page_size;
											$lmt=" Limit " .$current. ",".page_size;
										}
									  }
									  else
									  {
									   $sql.=" Limit 0,".page_size;
									   $lmt=" Limit 0,".page_size;
									   $curpage=0;
									  }
									  $rID=runquery1( $sql);
									 /* $count=mysqli_num_rows($rID);
									  if($count==0)
									  		{
											?>
												
												echo "<script language=JavaScript>";
												echo "window.locatin.href("viewcourse.php?curpage=")";
												echo "</script>"
											<?php
											}*/
									  
?>

<HTML>
<HEAD>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
<title></title>
<script language="JavaScript">

function openwin(obj)
{
	window.open("user.php?id="+obj,"","height=600,width=850,scrollbars=1");
}

function sub1(ob)
{
	document.frmuser.method = "post";
	document.frmuser.action="deleteuser.php?active=1&curpage="+ob;
	document.frmuser.submit();
}
function checkall()
{
	var len=document.all.length;
		var chkname;
		for(i=0;i<len;i++)
		{
			if(document.all(i).type=="checkbox")
			{
				chkname=document.all(i).name;
					if(document.getElementById("visibility").checked)
					{
						if(document.all(i).name=="visibility")
						{
							document.all(i).checked=true;
						}
						else
						{
							document.all(i).checked=true;

						}
						
					}
					else
					{
						if(document.all(i).name=="visibility")
						{
							document.all(i).checked=false;
						}
						else
						{
							document.all(i).checked=false;
						
						}
						
					}
				}
	}	
}

</script>
</HEAD>
<BODY topmargin="0" leftmargin="0">
<form name="frmuser" method="post" action="deleteuser.php?curpage=<?php echo $curpage; ?>">		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr> 
		<td>&nbsp;</td>
	</tr>
	<tr> 
		<td><h3><b> Approve/Disapprove Learner Admin</b></h3></td>
	</tr>
	<tr> 
		
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="1%" height="23" background="images/middle.jpg"><img src="images/start1.jpg" width="6" height="23"></td>
            <td width="10%" background="images/middle.jpg"><div align="center"><a class="tablink" href="overview.php?id=approve">Overview</a></div></td>
            
            <td width="1%" background="images/middle.jpg"><img src="images/active_middle.jpg" width="11" height="23"></td>
            <td width="17%" background="images/middle_middle.jpg" class="activelink"><div align="center">Edit 
                / Delete</div></td>
            <td width="1%" background="images/middle.jpg"><img src="images/bg_bodytab_crnr1.jpg" height=23 width=11></td>
            <td width="17%" background="images/middle.jpg"><div align="center"><a class="tablink" href="listuser.php">List</a></div></td>
            <td width="1%"><div align="right"><IMG height=23 src="images/bg_bodytab_crnr3.jpg" width=11></div></td>
            <td width="34%" background="images/middle_last.jpg"></td>
          </tr>
        </table></td>
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
            <td bgcolor="#FFFFFF"><table width="85%" cellSpacing=0 cellPadding=0 border=0 class="table" align="center">
                <tr> 
                  <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="3"><img src="images/round_corner.gif" width="3" height="20"></td>
                        <td width="517" class="headingtd">Edit / Delete User</td>
                        <td width="346" class="headingtd"><div align="right"><img height=20 src="images/img_header_gradient.jpg" width=147></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td width="7%" height="15" align="center"  class="lighttd2"><!--<input type="checkbox" name="visibility" id="visibility" value="checkbox" onClick="checkall(this)">--></td>
                  <td height="25"  class="lighttd2"><b>User Name</b> </td>
				 
                 
                  <td width="10%"  class="lighttd2"><div align="center"><b>Active</b></div></td>
                  <td width="35%"  class="lighttd2"><div align="center"><strong>Delete</strong></div></td>
                </tr>
                <tr bgcolor="#FFFFFF" > 
                  <td colspan="5"> <div align="center"></div></td>
                </tr>
                <?php if($rID)
                  {
                    $cnt=1;
                    while ($rs = mysqli_fetch_row($rID))
                    {
                    	?>
                <tr class="whittd"> 
                  <td align="center"> <input type="checkbox" name=cbo<?phpecho $cnt;?>> 
                    <input type="hidden" name=hb<?phpecho $cnt;?> value=<?phpecho $rs[0];?>> 
                  </td>
                  <td width="48%" height="30" align=left ><a href="javascript:openwin(<?php echo $rs[0] ?>);"><?php echo $rs[1]; ?></a> 
                  </td>
                  
                  <td width="10%" align=left ><div align="center"> 
                      <?php
				   if($rs[9]==0)
				   {
				   ?>
                      <input type="checkbox" name="chk<?php echo $cnt; ?>" value="0">
                      <?php
					 }
					 else
					 {
					 ?>
                      <input type="checkbox" name="chk<?php echo $cnt; ?>" value="1" checked>
                      <?php
					   }
					   ?>
                    </div></td>
                  <td width="35%" align=left ><div align="center"><a href="deleteuser.php?id=<?phpecho $rs[0];?>&curpage=<?phpecho $curpage;?>"><img src="images/delete.gif" width="14" height="13" border="0"></a></div></td>
                </tr>
                <?php
			            $cnt=$cnt+1;
					}
					?>
                
                
                <tr > 
                  <td height="30" colspan="2" align=left><input name="image" type="image" src="images/delete1.gif" width="73" height="22"> 
                    <input name="txtcnt" value="<?php echo $cnt; ?>" type="hidden"></td>
                  
                  <td align=left><div align="center"><img src="images/submit.gif" width="73" height="22" onClick="sub1(<?php echo $curpage; ?>)" style="cursor:hand"></div></td>
                  <td align=left>&nbsp;</td>
                </tr>
                <tr align="right" bgcolor="#FFFFFF" >
                  <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="148" class="headingtd"><img height=20 src="./images/img_header_gradient1.jpg" width=147></td>
                        <td width="772" class="headingtd">&nbsp;</td>
                        <td width="1" ><div align="right"><img src="./images/round_corner1.gif" width="3" height="20"></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="5">&nbsp;</td>
                </tr>
                <tr align="right" bgcolor="#FFFFFF" > 
                  <td height="30" colspan="5"> 
                    <?php	if($page>1){ 
												echo "Page : ";
											 for($i=1;$i<=$page;$i++)
											 {
												if($i==($curpage+1))
												{
											 ?>
                    <b><?php echo $i?></b> 
                    <?php
												}
												else
												{
													$str="";
											?>
                    <a href="viewuser.php?curpage=<?php echo $i-1;?>"><b><?php echo $i;?></b></a> 
                    <?php
												}									
											 }}?>
                    &nbsp;&nbsp;</td>
                </tr>
                <?php
				  }
				  else
				  {
				      echo "No User found";
				  }
			?>
              </table> </td>
          </tr>
          <tr> 
            <td bgcolor="#FFFFFF">&nbsp;</td>
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
</form>
</BODY>
</HTML>

