<?php
ob_start();
session_start();

include_once("dbConnection.php");

//$sql = "SELECT * FROM cpo_newsmaster WHERE iStatus = 1 Limit 0,2";
$sql = "SELECT * FROM cpo_newsmaster WHERE iStatus = 1";
$rslt = runquery($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

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
<table width="206" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1" rowspan="3" bgcolor="#000000"></td>
    <td height="1" bgcolor="#000000"></td>
    <td width="1" rowspan="3" bgcolor="#000000"></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#fde6c3"><table width="204" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
				    <div style="overflow:scroll;height:240px;">
		<table width="200" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30"><img src="images/news.png" width="42" height="30" /></td>
            <td  width="100%" align="left" background="images/bg1.png" class="heading">Latest News</td>
          </tr>
		  <?php 
				while($row = mysqli_fetch_assoc($rslt))
				{ ?>
<tr>

            <td colspan="2" align="left"><p class="quicklinks"> <a href="http://careerpathsonline.net/newsdetail.php?id=<?=$row[iNewsID]?>" class="quicklinks"> - <?=$row[vNewsTitle]?></a></p></td>
          </tr>
			<tr><td>&nbsp;</td></tr>
				
				<? }
				?>
				<tr>
            		<td height="40" colspan="2" align="right"><span class="learn"> <a href="http://careerpathsonline.net/morenews.php" class="quicklinks">&gt;&gt;More News</a></span></td>
          		</tr>
          <!--<tr>
            <td colspan="2" align="left"><p class="quicklinks"> <a href="http://careerpathsonline.net/newsdetail.php?id=14" class="learn">Graduates 'regret degree choice'</a> <br />
                    <a href="http://careerpathsonline.net/newsdetail.php?id=13" class="learn">E-learning to help Hackney&rsquo;s NEET</a></p></td>
          </tr>
          <tr>
            <td height="40" colspan="2" align="right"><span class="learn"> <a href="http://careerpathsonline.net/morenews.php" class="learn">&gt;&gt;More News</a></span></td>
          </tr>
		  -->
        </table>
		</div>
		</td>
      </tr>
      <tr>
        <td><table width="200" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="42" align="left"><img src="images/quick.png" width="42" height="30" /></td>
            <td width="158" align="left" background="images/bg1.png" class="heading">Quick Links</td>
          </tr>
          <tr align="left">
            <td colspan="2"><p class="quicklinks"> <a href="http://careerpathsonline.net/apprenticeships.php" class="quicklinks">Apprenticeships</a><br />
                        <a href="http://careerpathsonline.net/bskills.php" class="quicklinks">Basic Skills</a><br />
                      <!--  <a href="http://careerpathsonline.net/e2e.php" class="quicklinks">Entry 2 Employment</a><br />-->
                        <a href="http://careerpathsonline.net/college.php" class="quicklinks">Best time to go college</a><br />
                        <a href="http://careerpathsonline.net/christmas_work.php" class="quicklinks">Christmas work</a><br />
                        <a href="http://careerpathsonline.net/gsce_retakes.php" class="quicklinks">GCSE retakes</a><br />
                        <a href="http://careerpathsonline.net/decide.php" class="quicklinks">How do I decide</a><br />
                        <a href="http://careerpathsonline.net/respect.php" class="quicklinks">Respect</a><br />
                        <a href="http://careerpathsonline.net/w3c_accessibility.php" class="quicklinks">W3C Accessibility</a><br />
                        </p></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="1" bgcolor="#000000"></td>
  </tr>
</table>
</body>
</html>