<?php



session_cache_expire(time()-1);



session_cache_limiter('nocache');



@ob_start();	



include "dbConnection.php";







if (!isset($_SESSION['user_id']))



{ 



	header("Location:../user_login.php");



}



else



{



	$user_id = $_SESSION['user_id'];

	$user_name = $_SESSION['user_name'];

}



?>



<html>



<head>



<title><?php echo sitename;?>Tutor Home</title>



<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<link href="tms.css" rel="stylesheet" type="text/css">



<script language="JavaScript" type="text/javascript">



function openwin(obj)



{



	new1=window.open("Detail_LogBook.php?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');



}





</script>

<link rel="STYLESHEET" href="http://www.groupworld.net/style.css" type="text/css">

<script language=javascript src="http://www.groupworld.net/groupworld_no3d.js"></script>

<script language="JavaScript">



function start()

{

    // Optional username and password. If not specified here, a popup dialog

    // box will appear.

    <?php print "var username = '$user_name';"; ?>

    var password = '';



    // The GroupWorld server to connect to. You can optionally specify the

    // port number (using the format "server:port").

    var base = 'www.groupworld.net:9174:375';



    // The object to load and instance name. To create a different "session",

    // just copy the html page and change the instance name.

    var object = 'new_conference:conf1';



    // Flags: not currently used.

    var flags = 0;

    if (null == document.GroupWorld || typeof(document.GroupWorld.startup) == 'undefined')

    {

        alert('Error: Plugin not installed. Please click on the installation link at the top of the page. If you continue getting this message, check your browser security settings.');

    }

    else

    {

        document.GroupWorld.startup(username, password, base, object, flags);

    }

}



</script>

</head>



<body bgcolor="#ffffff" leftmargin="0" topmargin="0" onLoad="start();">

<script language=javascript>

var agt=navigator.userAgent.toLowerCase();

var is_nav  = (agt.indexOf('mozilla') != -1);

var is_ie = (agt.indexOf("msie") != -1);

var is_macosx = (agt.indexOf("mac os x")!=-1);

var is_safari = (agt.indexOf("safari")!=-1);



var d = document;

if (is_macosx)

{

    if (is_safari)

    {

        d.writeln('<p><a target=_blank href="http://www.groupworld.net/groupworld_plugin.dmg">Click here to install the required plugin if it does not install automatically.</a></p>');

    }

}

else if (is_ie)

{

        d.writeln('<p><a target=_blank href="http://www.groupworld.net/groupworld_dll_no3d.exe">Click here to install the required activex control if it does not install automatically.</a></p>');

}

else if (is_nav)

{

        d.writeln('<p><a target=_blank href="http://www.groupworld.net/plugin_no3d.html">Click here to install the required plugin if it does not install automatically.</a></p>');

}

</script>

<table width="775" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">



  <tr> 



    <td colspan="2" valign="top"><?php include "includetop.php";?></td>



  </tr>



  <tr> 



    <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">



      <?php include "includeleft.php";?>



    </td>



    <td valign="top"> 



      <?php include "includewelcome.php";?>



    </td>



  </tr>



 



  <tr>



    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">



        <tr>



          <td>&nbsp;</td>



        </tr>



        



		<tr><td>&nbsp;</td></tr>



		<tr><td >

<script language=javascript>



// This line of code is where the GroupWorld activex control actually appears

// in the web page. The parameters give the width and height (in pixels).



groupworld_object(780,600);

</script>

		</td>



		</tr>



		<tr><td><p><a target=help href="http://www.groupworld.net/help/new_conference.html">

Conference room help</a></p>

<p><a target=playback href="http://www.groupworld.net/mp/saved_sessions.cgi?groupworld_id=375&instance=conf1">Play back previously recorded sessions</a></p></td></tr>

<tr><td height="48"><p><a target=help href="http://www.careerpathsonline.net/designer_admin.html">

Groupboard Admin</a></p>
</td></tr>

      </table></td>



   <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>



  </tr>



 <?php include "includebottom.php";?>



</table>



<map name="lms_1_r2_c2Map">



  <area shape="rect" coords="491,88,551,100" href="logout.php">



</map>



</body>



</html>



