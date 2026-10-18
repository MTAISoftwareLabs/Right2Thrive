<?php
ob_start();
include_once 'dbConnection.php';
?>

<html>
<head>
<title>CareerPaths Online :: Job Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>

</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="MM_preloadImages('images/products_over.jpg','images/services_over.jpg','images/faqs_over.jpg','images/contact_over.jpg','images/company_over.jpg','images/home_over.jpg','images/login_over.jpg')">
<table width="775" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- fwtable fwsrc="Untitled" fwbase="index.jpg" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
  <tr><td colspan="4">
  <? include "includetop.php";?>
  </td></tr>
  <tr> 
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA;border-left : 1px solid #759FBA"><? include "includeleft.php";?></td>
    <td colspan="2" valign="top" style="border-right : 1px solid #759FBA"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="4%" >&nbsp;</td>
          <td width="94%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td   class="blacktxt"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr> 
          <td height="23"><div align="right" class="t_bottom_border"> <table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr> 
                            <td class="intheading">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="bodytext">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14">Welcome to Job Search</td>
                            <td width="8%"><div align="right"><a href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0"></a></div></td>
                            <td width="17%" class="bodytext"><div align="right"><a  class="print" href="javascript:print()">Print this page</a></div></td>
                          </tr>
                        </table></div></td>
        </tr>
		<tr> 
                <td height="10">&nbsp;</td>
                <td colspan="3" nowrap class="intsubheading">&nbsp;</td>
              </tr>
        <Tr> 
          <td>
<?
$sql="select * from cpo_categorymaster where iStatus=1 order by iCategoryId";
$rID1=runquery($sql);
if($rID1)
{
$num = mysqli_num_rows($rID1);
}
else
{
$num=0;
}
		if($rID1 > 0)
        {
?>	  
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                <td width="96%" background="images/changep_center_cor.jpg"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="49%" class="welcome">Current Opening Jobs 
                        <div align="right"><font color="#FFFFFF"></font></div></td>
                      <td width="50%" class="welcome"><div align="right"><strong>::</strong></div></td>
                    </tr>
                  </table></td>
                <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
              </tr>
              <tr> 
                <td  colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">
				<table width="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="DFEAF2">
<?
 while ($rs1 = mysqli_fetch_array($rID1))
{
	$sql1="select * from cpo_jobmaster where iCategoryId=".$rs1['iCategoryId']." and dDate>=curdate() and iStatus=1";
	$result=runquery($sql1);
	$num = mysqli_num_rows($result);
	
?>
				<tr><td height="20" class="bodytext">&nbsp;<strong><a href="jobslist.php?catid=<? echo $rs1['iCategoryId'];?>"><? echo $rs1['vCategoryName']?></a><? echo"(".$num.")";?></strong> 
                </td>
              </tr>
			<tr bgcolor="#FFFFFF"> 
<? 			$desc=substr($rs1['tCategoryDesc'],0,500); ?>
             <td height="20" class="bodytext">&nbsp;<? echo $desc;?>...&nbsp;<br>
             <div align="right">
                                      <a href="jobslist.php?catid=<? echo $rs1['iCategoryId'];?>"> 
                                        More..</a>&nbsp;&nbsp; 
                                    </div></td>
           </tr>
<?
	}
?>
		</table></td></tr>
              <tr> 
                <td width="2%" ><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                <td width="96%" height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>
                <td width="2%" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
              </tr>
            </table>
<?
}
?>
 </td>
        </Tr>
		<Tr><td>&nbsp;&nbsp;</td></Tr>
		<!--<tr><td align="center">No News Found!!</td></tr>-->
        <Tr>
          <td>&nbsp;</td>
        </Tr>
      </table>&nbsp;</td>
              </tr>
            </table></td>
          <td width="2%">&nbsp;</td>
        </tr>
      </table></td>
   
  </tr>
  <Tr><td colspan="4" >
  <? include "includebottom.php";?></td></Tr>
</table>
</body>
</html>
