<?
include_once 'dbConnection.php';

if(!isset($_SESSION['user_id']))
{
	header("Location:../user_login.php");
}
else
{
	$user_id = $_SESSION['user_id'];
}
if(isset($_GET['did']))
{
	$comment	= $_POST['txttcomments'];
	$insql = "update cpo_detention set T_tcomments  ='".$comment."' where I_detentionid =".$_GET['did'];
	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		window.location="personaldev.php";
	</script>
	<?  }
	else
	{
		$msg = "Sorry comment cannot be inserted";
		$flg = "red";
	}
}
if(isset($_GET['did']))
{
	$comment	= $_POST['txttcomments'];
	$insql = "update cpo_detention set T_scomments  ='".$comment."' where I_detentionid =".$_GET['did'];
	$ininfo=runquery($insql);
	if($ininfo)
	{?>
		<script language="javascript">
		window.location="personaldev.php";
	</script>
	<?  }
	else
	{
		$msg = "Sorry comment cannot be inserted";
		$flg = "red";
	}
}
?>
<html>
<head>
<title><? echo sitename;?>Personal Development</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="lms.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="calendar1.js"></script>
<script language="JavaScript">
function hidevreport()
{
	document.getElementById('report').style.display = 'none';
}
function openreport(obj)
{

	var new1=window.open("Detail_progress.php?id="+obj,"",'height=300,width=600,scrollbars=yes,top=50 left=150');
	return true;
}
function hide(f)
{
	if(f == 'D')
	{
		document.getElementById('show_det').style.display = 'none';
	}
	else
	{
		document.getElementById('show_exc').style.display = 'none';
	}
}
function get_report(id)
{
	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	if(id !='')
	{
	
		var query = "getreport.php?id="+id;
	}
	else
	{
		document.getElementById('id_report').style.display='none';
		document.getElementById('report').style.display='none';
		return false;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			document.getElementById('report').style.display = '';
			document.getElementById('id_report').style.display='';
			document.getElementById('id_report').innerHTML= number1;
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
function valid_deten()
{
	if(document.frmhw.txttcomments.value == '')
	{
		alert('Please enter your comments');
		document.frmhw.txttcomments.focus();
		return false;
	}
}
function get_deten(id,flag)
{
	var xmlHttp;
	try
	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	if(!isNaN(id) && id!='')
	{
		var query = "getdeten.php?id="+id+"&flag="+flag;
	}
	else
	{
		if(id=='' && flag == 'E')
		{
			document.getElementById('show_exc').style.display='none';
			return false;
		}
		else
		{
			document.getElementById('show_det').style.display='none';
			return false;
		}
		
	}
	if(!isNaN(id) && id!='')
	{
		var query = "getdeten.php?id="+id+"&flag="+flag;
	}
	else
	{
		document.getElementById('show_det').style.display='none';
		document.getElementById('show_exc').style.display='none';
		return false;
	}
	xmlHttp.onreadystatechange=function()
	{
		if(xmlHttp.readyState==4)
		{
			var number1 = xmlHttp.responseText;
			if(flag == 'D')
			{
				document.getElementById('show_det').style.display = '';
				document.getElementById('id_deten').style.display='';
				document.getElementById('id_deten').innerHTML= number1;
			}
			else
			{
				document.getElementById('show_exc').style.display = '';
				document.getElementById('id_exc').style.display='';
				document.getElementById('id_exc').innerHTML= number1;
			}
			
		}
	}
	xmlHttp.open("GET",query,true);
	xmlHttp.send(null);
}
</script>
<script language="JavaScript" src="calendar1.js"></script> 
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #AFE0FA;
}
-->
</style>
</head>
<body>
<table width="911"  cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="855">
    <div align="right"><? include "logout.php";?></div></td>
  </tr>
</table>
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
 
  <tr>
    <td rowspan="2" valign="top" width="25%" bgcolor="#FFFFFF"><? include "leftpanel.php";?>
    </td>
    <td valign="top"><? include "includewelcome.php";?>
    </td>
    <td><img src="images/spacer.gif" width="1" height="22" border="0" alt=""></td>
  </tr>
  <tr>
    <td valign="top"><table width="94%" border="0" cellspacing="0" cellpadding="0" align="center">
       
        <tr>
          <td>
              <table width="588" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                  <td width="11"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                  <td width="583" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="welcome"><b>Personal Development </b></td>
                        <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                      </tr>
                    </table></td>
                  <td width="12" background="images/changep_right_cor.jpg">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                    <table class="" width="90%" align="center">
						  <tr>
						  	<td colspan="2"><? if(isset($msg)) {echo "<span class='bodytext'><b><center>".$msg."<center></b></font>"; }?></td>
						  </tr>
					  <form name="frm_report" method="post" action="">
					  <tr>
                        <td width="40%" height="42" class="bodytext">Monthly Progress Report</td>
                        <td width="60%" >&nbsp;
                            <select name="cmbmonth" class="textbox" onChange="get_report(this.value)">
                               <option value="">Month</option>
							   <option value="1">January</option>
							   <option value="2">February</option>
							   <option value="3">March</option>
							   <option value="4">April</option>
							   <option value="5">May</option>
							   <option value="6">June</option>
							   <option value="7">July</option>
							   <option value="8">August</option>
							   <option value="9">September</option>
							   <option value="10">August</option>
							   <option value="11">November</option>
							   <option value="12">December</option>
                            </select> &nbsp;&nbsp;</td>
                      </tr>
							 </form>
					  <tr id="report"><td width="100%" colspan="2"><div id="id_report"></div></td></tr>
					   
					  <form name="frm_deten" method="post" action="">
					  <tr>
                        <td width="40%" height="42" class="bodytext">Detention</td>
                        <td width="60%" >&nbsp;
                            <select name="cmbdeten" class="textbox" onChange="get_deten(this.value,'D')">
                               <option value="">Detention Record</option>
										 <? $sqldet="SELECT * FROM cpo_detention where  C_flag='D' and I_userid  =".$_SESSION['user_id']." order by I_detentionid";
										 	$resdet=runquery1($sqldet);
											$countdet = mysqli_num_rows($resdet);
											for($i=0;$i<$countdet;$i++)
											{
												$rsdet = mysqli_fetch_array($resdet);
											?>
												<option value="<? echo $rsdet['I_detentionid']?>"><? echo $rsdet['V_reason']?></option>
											<? }
										 ?>
                            </select> &nbsp;</td>
                      </tr>
							 </form>
							 <tr id="show_det"><td width="100%" colspan="2"><div id="id_deten"></div></td></tr>
							 <form name="frm_exec" method="post" action="">
					  <tr>
                        <td width="40%" height="42" class="bodytext">Exclusion</td>
                        <td width="60%" >&nbsp;
                            <select name="cmbexec" class="textbox" onChange="get_deten(this.value,'E')">
                               <option value="">Exclusion Record</option>
										 <? $sqldet="SELECT * FROM cpo_detention where  C_flag='E' and I_userid  =".$_SESSION['user_id']." order by I_detentionid";
										 	$resdet=runquery1($sqldet);
											$countdet = mysqli_num_rows($resdet);
											for($i=0;$i<$countdet;$i++)
											{
												$rsdet = mysqli_fetch_array($resdet);
											?>
												<option value="<? echo $rsdet['I_detentionid']?>"><? echo $rsdet['V_reason']?></option>
											<? }
										 ?>
                            </select> &nbsp;</td>
                      </tr>
							 </form>
							   <tr id="show_exc"><td width="100%" colspan="2"><div id="id_exc"></div></td></tr>
							 
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td width="11" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                  <td height="22" background="images/changebttm_center_cor.jpg" ><div align="right">
                    </div></td>
                  <td width="12" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                </tr>
               
              </table>
              
            <table align="center">
                <tr>
                  <td width="596"><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>
                </tr>
              </table>
          <p>&nbsp;</p></td>
        </tr>
      </table></td>
    <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
  </tr>
  <? include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
  <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
