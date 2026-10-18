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
MM_preloadImages('images/aboutelearningover.jpg');
</script>
<tr>
   <td><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="168" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="394" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="212" height="1" border="0" alt=""></td>
   <td><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
    <td colspan="4" rowspan="2" align="left" style="border-right : 1px solid #759FBA; border-left : 1px solid #759FBA; border-top : 1px solid #759FBA;"><table width="775" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="107" height="20" align="left" valign="top">&nbsp;</td>
        <td width="32" align="left" valign="top">&nbsp;</td>
        <td width="54" align="left" valign="bottom"><div align="center"><a href="index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image31','','images/home_over.jpg',1)"><img src="images/home_nor.jpg" name="Image31" width="50" height="17" border="0" alt=""></a></div></td>
        <? if(!isset($_SESSION['user_id']) || $_SESSION['user_id']=="") 
		  {?>
        <td width="45" align="left" valign="bottom"><div align="center"><a href="user_login.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image32','','images/login_over.jpg',1)"><img src="images/login_nor.jpg" name="Image32" width="41" height="17" border="0" alt=""></a></div></td>
        <?
		  }else{
		  	if(isset($_SESSION['module']) && $_SESSION['module']<>"")
			{
				if($_SESSION['module']==1)
				{
		  			$navlink = "./tms/index.php";
				}
				if($_SESSION['module']==2)
				{
					$navlink = "./lms/index.php";
				}
				if($_SESSION['module']==4)
				{
					$navlink = "./tpm/index.php";
				}
			}
			else
			{
				$navlink = "user_login.php";
			}				
		  ?>
        <td width="83" align="left" valign="bottom"><div align="center"><a href="<? echo $navlink;?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image32','','images/myacount_over.jpg',1)"><img src="images/myacount_nor.jpg" name="Image32" width="79" height="17" border="0" alt=""></a></div></td>
        <?
		  }
		  ?>
        <td width="110" align="left" valign="bottom"><div align="center"><a href="e-learning.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image20','','images/aboutelearningover.jpg',1)"><img src="images/aboutelearning.jpg" name="Image20" width="106" height="17" border="0" alt=""></a></div></td>
        <td width="69" align="left" valign="bottom"><a href="company.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image59','','images/company_over.jpg',1)"><img src="images/company_nor.jpg" name="Image59" width="66" height="17" border="0" alt=""></a></td>
        <td width="66" align="left" valign="bottom"><div align="center"><a href="products.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image60','','images/products_over.jpg',1)"><img src="images/products_nor.jpg" name="Image60" width="64" height="17" border="0" alt=""></a></div></td>
        <td width="64" align="left" valign="bottom"><div align="center"><a href="services.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image61','','images/services_over.jpg',1)"><img src="images/services_nor.jpg" name="Image61" width="61" height="17" border="0" alt=""></a></div></td>
        <td width="40" align="left" valign="bottom"><div align="center"><a href="faq.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image58','','images/faqs_over.jpg',1)"><img src="images/faqs_nor.jpg" name="Image58" width="33" height="17" border="0" alt=""></a></div></td>
        <td width="57" align="left" valign="bottom"><div align="center"><a href="contact.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image63','','images/contact_over.jpg',1)"><img src="images/contact_nor.jpg" name="Image63" width="56" height="17" border="0" alt=""></a></div></td>
        <td width="18" align="left">&nbsp;</td>
      </tr>
    </table></td>
   <td align="left"><img src="images/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
   <td><img src="images/spacer.gif" width="1" height="20" border="0" alt=""></td>
  </tr>
  <tr><td colspan="4" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="1%"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="165" height="117">
                  <param name="movie" value="images/flash%20logo.swf">
                  <param name="quality" value="high">
                  <embed src="images/flash%20logo.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="165" height="117"></embed></object></td>
              <td width="99%"><img src="images/headerimg.jpg" width="611" height="117" alt=""></td>
            </tr>
          </table></td></tr>
  <tr>
    <td colspan="4" align="left" background="images/blueline.jpg" style="border-right : 1px solid #759FBA;border-left : 1px solid #759FBA"><img src="images/blueline.jpg" width="13" height="6" alt=""></td>
   <td align="left"><img src="images/spacer.gif" width="1" height="6" border="0" alt=""></td>
  </tr>