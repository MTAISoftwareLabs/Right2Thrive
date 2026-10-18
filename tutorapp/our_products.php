<?php

ob_start();

include_once 'dbConnection.php';

include "session.php";


if(isset($_POST['contactus']))
{
extract($_POST);
$to='info@careerpathsonline.net'.',shailaja.mandadi@gmail.com';
 $subject='Application Details';
 $message='Dear Sir/Madam,<br><br>';
 $message.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This mail has been sent to you because the customer has made a request.<br>';
 $message.='<br><strong>Email : </strong>'.$email;
 $message.='<br><strong>Name : </strong>'.$name;
  $message.='<br><strong>Address : </strong>'.$address;
 $message.='<br><strong>Phone : </strong>'.$phone;
  $message.='<br><strong>Organisation : </strong>'.$organisation;
  $message .="\n\n<br>Thanks again for using our services.<br><br>";
  $message .="\nManagement Service<br>";
  $message .="\nCareerpathsonline.";
  $from="Careerpathsonline";
  $headers 	= "From: $from\n" ."MIME-Version: 1.0\n" .
               "Content-type: text/html; charset=iso-8859-1";

mail($to,$subject,$message,$headers);
header("Location:our_products.php?errmsg=1&#succ");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Products: <?php echo $u1;?></title>





<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>



<link href="css/style.css" rel="stylesheet" type="text/css" />



<!--

function openwin1(obj)

{

	new1=window.open("moredesc_course.php?id="+obj,"",'height=400,width=600,scrollbars=yes,top=50 left=150');

	return true;

}

function getsubmit(obj)

{

	document.frmcoursedetail.action='coursedetail.php?id='+obj.value;

	document.frmcoursedetail.submit();

}

function MM_preloadImages() { //v3.0

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}

//-->

</script>

<style type="text/css">

<!--
.style2 {
	font-size: 24px;
	font-weight: bold;
	color: #61C448;
}

-->

</style>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/contactvalid.js"></script>

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

                    <tr>

                   	  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        
                        <tr>
                          <td height="20" class="fontgreen_big"><p class="style2">Our Products </p></td>
                        </tr>
                        <tr>
                          <td  height="5"></td>
                        </tr>
                        <tr>
                          <td height="49" >CareerPaths Online is developing a series of  interactive learning resources for individuals to help them make some of the  most important decisions in their life. </td>
                        </tr>
                        <tr>
                          <td height="63" ><p>It provides practical advice and tips  to help you through the difficult steps in choosing a career or attending an  interview.  CareerPaths Online  interactive learning resources explore the following topics in depth:
						  </p>
                          <ul>
						  <li>
						  <strong> Career Planning</strong></li>
                           <li> <strong>Creating An Effective CV</strong></li>
                          <li>  <strong> Job Searching Techniques</strong></li>
                          <li>  <strong> Researching Job Opportunities</strong></li>
						  <li>  <strong> Writing Applications</strong></li>
                         <li> <strong>  Interview Techniques</strong></li></ul></p></td>
                        </tr>
                        <tr>
                          <td height="90" align="left" ><p>CareerPaths Online  interactive learning resources are divided into small modules. You can spend 15  minutes or an hour learning what you need and go back later to discover the  rest of it.  This is ideal when you need  help filling in a job application or preparing to attend a job interview. </p></td>
                        </tr>
                        <tr>
                          <td height="30" ><strong>For  further information complete form below :</strong>                        </td>
                        </tr>
                        <tr>
                          <td height="108" align="left" >
						  <a name="succ"></a>
						  <form name="contactform" id="contactform" method="post" action="" onsubmit="return contactvalid();">
						  <table width="100%" border="0" cellspacing="3">
                           <?php 
									   $errmsg=$_REQUEST['errmsg'];
									   
									   if($errmsg==1){
															  ?>
                                       <tr>
                                         <td colspan="3" align="center" style="color:#FF0000">Thank you for Contacting Careerpathsonline your message has been sent.</td>
                                       </tr>
                                       <? } ?>
                            <tr>
                              <td width="18%" height="30"><strong>Name</strong></td>
                              <td width="2%"><strong>:</strong></td>
                              <td width="80%"><input name="name" id="name" type="text" size="30" onblur="checkField(this);" />&nbsp; <span id="namereq"></span></td>
                            </tr>
                            <tr>
                              <td><strong>Address</strong></td>
                              <td><strong>:</strong></td>
                              <td><input name="address" id="address" type="text" size="30" onblur="checkField(this);"  />&nbsp; <span id="reqaddress"></span></td>
                            </tr>
                            <tr>
                              <td><strong>Organisation</strong></td>
                              <td><strong>:</strong></td>
                              <td><input name="organisation" id="organisation" type="text" size="30" onblur="checkField(this);"  />&nbsp; <span id="reqorg"></span></td>
                            </tr>
                            <tr>
                              <td><strong>Telephone</strong></td>
                              <td><strong>:</strong></td>
                              <td><input name="phone" id="phone" type="text" size="30" onblur="checkField(this);"  />&nbsp; <span id="reqphone"></span></td>
                            </tr>
                            <tr>
                              <td><strong>Email</strong></td>
                              <td><strong>:</strong></td>
                              <td><input name="email" id="email" type="text" size="30" onblur="checkField(this);"  />&nbsp; <span id="emailreq"></span></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><input type="submit" name="contactus" value="Submit" /> <label>
                                <input type="reset" name="Submit2" value="Reset" />
                              </label></td>
                            </tr>
                          </table>
						  </form>
						  </td>
                        </tr>
                        <tr>
                          <td height="478" ><img src="images/scrren1.jpg" width="576" height="461" border="0" /></td>
                        </tr>
                        <tr>
                          <td height="471" ><img src="images/screen2.jpg" width="576" height="461" border="0" /></td>
                        </tr>
                        <tr>
                          <td height="71" ><p><img src="images/screen3.jpg" width="576" height="461" border="0" /></p></td>
                        </tr>
                      </table></td>
           			</tr> 
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