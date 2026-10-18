<script language="JavaScript" type="text/javascript">
function openWindow1()
{
	window.open("admin/flash/useful_contact.html","","left=150,top=50,height=604,width=797");
}
</script>
     <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr> 
          <td>
		  <table cellpadding="0" cellspacing="0" width="100%">
		          <tr> 
          <td height="33" background="images/quick_links.jpg" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="29%">&nbsp;</td>
                <td width="71%" class="link">Latest News</td>
              </tr>
            </table></td>
        </tr>
	  <?
		$selsql ="select iNewsID,vNewsTitle from cpo_newsmaster order by dNewsDate desc";
		$rssql = runquery($selsql);
		$num = isset($rssql)?mysqli_num_rows($rssql):0;
		$count = 0;
		if($num>0)
		{	
		?>
			<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="3">
              	<tr>
					<td width="100%" valign="top" height="30">		
					<marquee direction="up" height="30" scrollamount="1" onMouseOver="this.stop()" onMouseOut="this.start()" style="Filter:Alpha(Opacity=100, FinishOpacity=0, Style=1, StartX=0, StartY=40, FinishX=0, FinishY=0);">
		<?
			while($rsrec = mysqli_fetch_array($rssql))
			{
				if($count<=1)
				{
					$count = $count +1;
					$title = $rsrec['vNewsTitle']; //strlen($rsrec['vNewsTitle'])>20 ? substr($rsrec['vNewsTitle'],0,20).'...' : 
				?>
					<img src='images/arrow.jpg' width='7' height='9' alt=''>&nbsp;<a class='sublink' href='newsdetail.php?id=<? echo $rsrec[0];?>'><? echo $title;?></a><br><br>
		<?		}
			}
			?>
</marquee></td>				</tr>
				</table>
			</td>
			</tr>				
			
			<?
		}?>
		  </table>
		  </td>
        </tr>
		<tr valign="top"> 
	        <td height="12" colspan="2"><div align="right"><a class="midsublink" href="morenews.php"><u>More News</u></a>&nbsp;&nbsp;</div></td>
        </tr>
        <tr> 
          <td height="33" background="images/quick_links.jpg" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="29%">&nbsp;</td>
                <td width="71%" class="link">Quick Links</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="11%" ><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td width="89%" height="22" ><a class="sublink" href="apprenticeships.php">Apprenticeships</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"> <a class="sublink" href="bskills.php">Basic 
            Skills</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"><a class="sublink" href="e2e.php">Entry 
            2 Employment</a></td>
        </tr>
        <!--
              <tr> 
                <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9"></div></td>
                <td height="22" style="border-top : 1px solid #D4D2D2;"> <a class="sublink" href="procedures.php">Complaint 
                  Procedures</a></td>
              </tr>
              <tr> 
                <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9"></div></td>
                <td height="22" style="border-top : 1px solid #D4D2D2;"> <a class="sublink" href="guidance.php">Client 
                  Guidance Policy</a></td>
              </tr>-->
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"> <a class="sublink" href="college.php">Best 
            time to go college</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"> <a class="sublink" href="christmas_work.php">Christmas 
            work</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"> <a class="sublink" href="gsce_retakes.php">GCSE 
            retakes</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"> <a class="sublink" href="decide.php">How 
            do I decide</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"><a class='sublink' href="respect.php">Respect</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"><a class='sublink' href="w3c_accessibility.php">W3C 
            Accessibility</a></td>
        </tr>
        <tr> 
          <td style="border-top : 1px solid #D4D2D2;"><div align="center"><img src="images/arrow.jpg" width="7" height="9" alt=""></div></td>
          <td height="22" style="border-top : 1px solid #D4D2D2;"><a class='sublink' href="javascript:openWindow1();">Useful 
            Contacts</a></td>
        </tr>
      </table></td>
        </tr>
      </table>