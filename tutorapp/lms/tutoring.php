<?

session_cache_expire(time()-1);

session_cache_limiter('nocache');

@ob_start();	

include "dbConnection.php";

//echo $_SESSION['user_id'];

//exit;

if (!isset($_SESSION['user_id']))

{ ?>

	<script language="JavaScript">

		document.location ="../user_login.php";

	</script> 

<?

}

else

{

		$user_id = $_SESSION['user_id'];
		$user_name = $_SESSION['user_name'];

}

function getIcon($filename)

{

	switch(substr($filename,strlen($filename)-3,strlen($filename)))

	{

		case "swf" : 

			return "../lms/images/swf.gif";

			break;

		case "doc" : 

			return "../lms/images/doc.gif";

			break;			

		case "jpg" : 

			return "../lms/images/jpg.gif";

			break;			

		case "peg" : 

			return "../lms/images/jpg.gif";

			break;			

		case "gif" : 

			return "../lms/images/gif.gif";

			break;			

		case "pdf" : 

			return "../lms/images/pdf.gif";								

			break;

		default : 

			return "NONE";				

			break;			

	}

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<title><? echo sitename;?>Learner Home</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="lms.css" rel="stylesheet" type="text/css">

<script language="JavaScript" src="./txteditor.js"></script>

<script language="JavaScript" type="text/javascript">

function getnewwin(obj,fid)

{

	new1=window.open("viewdownload.php?id="+obj+"&fid="+fid);

}

function openwin(obj)

{

	new1=window.open("Detail_SuggestJob.php?id="+obj,"",'height=500,width=600,scrollbars=yes,top=50 left=150');

	return true;

}

</script><style type="text/css">

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
<link rel="STYLESHEET" href="http://www.groupworld.net/style.css" type="text/css">
<script language=javascript src="http://www.groupworld.net/groupworld_no3d.js"></script>
<script language="JavaScript">

function start()
{
    // Optional username and password. If not specified here, a popup dialog
    // box will appear.
	<?php print "var username = '$user_name';"; ?>
    //var username = '';
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

<link href="css.css" rel="stylesheet" type="text/css" />

</head>



<body onLoad="start();">

<table width="911"  cellspacing="0" cellpadding="0" align="center">

  <tr>

    <td>

    <div align="right"><? include "logout.php";?></div></td>

  </tr>

</table>



<table width="911" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">

  <tr>

    <th height="672"  align="center"><table width="905" border="0" align="center"  cellpadding="0" cellspacing="0">

      

      <tr>

        <th width="199" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><? include "leftpanel.php"; ?></th>

        <th align="center" valign="top" scope="col"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td valign="top"><? include "includewelcome.php";?></td>

          </tr>

          <tr>

            <td>&nbsp;</td>

          </tr>

          <tr>

            <td>&nbsp;</td>

          </tr>

          <tr>

            <td><script language=javascript>

// This line of code is where the GroupWorld activex control actually appears
// in the web page. The parameters give the width and height (in pixels).

groupworld_object(800,600);

</script>
</td>

          </tr>

          <tr>
            <script language=javascript>
            var agt=navigator.userAgent.toLowerCase();
            var is_nav  = (agt.indexOf('mozilla') != -1);
            var is_ie = (agt.indexOf("msie") != -1);
            var is_macosx = (agt.indexOf("mac os x")!=-1);
            var is_safari = (agt.indexOf("safari")!=-1);
            var is_chrome = (agt.indexOf("chrome") != -1);

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
            else if (is_chrome)
            {
                d.writeln('<p><a target=_blank href="http://www.groupworld.net/chromesetup.exe">Click here to install the required plugin (Windows only).</a></p>');
            }
            else if (is_nav)
            {
                    d.writeln('<p><a target=_blank href="http://www.groupworld.net/plugin_no3d.html">Click here to install the required plugin if it does not install automatically.</a></p>');
            }
            </script>


            <p><a target=help href="http://www.groupworld.net/help/new_conference.html">
Conference room help</a></p>
<p><a target=playback href="http://www.groupworld.net/mp/saved_sessions.cgi?groupworld_id=375&instance=conf1">Play back previously recorded sessions</a></p>


          </tr>

          <tr>

            <td>&nbsp;</td>

          </tr>

          <tr>

            <td><div align="right"><a href="javascript:history.back();" class="textlink"><strong>Back</strong></a></div></td>

          </tr>

        </table></th>

      </tr>

      

      <tr>

        <th colspan="2" align="left" valign="top" bgcolor="#FFFFFF" scope="col"><div align="center">

          <? include "includebottom.php";?>

        </div></th>

        </tr>

      

      

      

    </table>      

    </th>

  </tr>

</table>

<p class="table">&nbsp;</p>



<map name="Map2" id="Map2"><area shape="rect" coords="1,1,196,67" href="#" /></map>

<map name="Map3" id="Map3"><area shape="rect" coords="-4,-6,167,30" href="#" /></map></body>

</html>

