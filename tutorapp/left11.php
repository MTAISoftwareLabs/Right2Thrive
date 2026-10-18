<?php
ob_start();
session_start();

include_once("dbConnection.php");

//$sql = "SELECT * FROM cpo_newsmaster WHERE iStatus = 1 Limit 0,2";
$sql = "SELECT * FROM cpo_newsmaster WHERE iStatus = 1";
$rslt = runquery($sql);

?>
              <table width="196" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="196"><img src="images/layout_40.jpg" width="196" height="33" /></td>
                </tr>
                <tr>
                  <td height="150" valign="top">
				  <marquee behavior="scroll" direction="up" scrolldelay="350" onmouseover="this.stop();" onmouseout="this.start();">
                  	<table width="100%">
					<?php 
					while($row = mysqli_fetch_assoc($rslt))
					{ ?>
					<tr>
	            		<td align="left"><p> <a href="http://careerpathsonline.net/newsdetail.php?id=<?=$row[iNewsID]?>" class="links"><?=$row[vNewsTitle]?></a> </p></td>
                    </tr>
					
					<? }
					?>
					
					<!--<tr>
			            <td height="40" align="right"><a href="http://careerpathsonline.net/morenews.php" class="links2">&gt;&gt;More News</a></td>
          			</tr>-->
				
				
                    <!--<tr>
            		<td align="left"><p> <a href="http://careerpathsonline.net/newsdetail.php?id=14" class="links">Graduates 'regret degree choice'</a> </p></td>
                    </tr>
					<br /><br /><br />
                    <tr>
                    <td align="center"><font face="arial" size="2px">Coming Soon !!!</font>
                    </td></tr>-->
          
          <!--<tr>
            <td height="40" align="right"><a href="http://careerpathsonline.net/morenews.php" class="links2">&gt;&gt;More News</a></td>
          </tr>-->
                    </table>
				</marquee>

                  </td>
                </tr>
				<tr>
				<td>&nbsp;</td></tr>
				<tr>
					  <td height="31" align="left"><img src="images/layout_47.jpg" width="196" height="33" /></td>
			    </tr>
					  <tr>
					  <td height="64" align="center"><table width="188" border="0" align="center" cellpadding="0" cellspacing="2">
                        <tr>
                          <td height="19">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="67"><div align="center"><img src="images/career_img.png" width="153" height="63" border="0" usemap="#Map10Map" /></div></td>
                        </tr>
                        <!--<tr>
                      <td height="95"><div align="center"><img src="images/curriculum.jpg" width="180" height="45" border="0" usemap="#Map11Map" /></div></td>
                    </tr>-->
                        
                      </table>
					    <map name="Map10Map" id="Map10Map">
                          <area shape="rect" coords="-4,2,157,61" href="careerprofile.php" />
                        </map>					    <p><strong><a href="helping_gcse.php"></a></strong></p></td>
					  </tr>
					  <tr>
					  <td align="left">&nbsp;</td>
					  </tr>
              </table>
			
<!--<table width="195" height="176" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="195" bgcolor="#f5f5f5"><img src="images/layout_11.jpg" width="195" height="30" /></td>
              </tr>
              <tr>
                <td height="116" valign="top" bgcolor="#f5f5f5"><table width="187" height="146" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2"></td>
                    </tr>
                    <tr>
                      <td width="156" class="fontnorm">Career development mentor</td>
                      <td width="38"><img src="images/chat_alison.png" width="38" height="39" /></td>
                    </tr>
                    <tr>
                      <?php
						$sql_tutor_count="select * from tracklogtutor";
						$rs_tutor = runquery($sql_tutor_count);	
						$num = $rs_tutor ? mysqli_num_rows($rs_tutor) : 0 ;
						if($num==0) {
					  ?>
                        <td height="38" colspan="2" class="fontsml"><span class="style1">No</span> career development tutor online</td>
                      <?php 
					    } else if($num==1) {
					  ?>
					    <td height="38" colspan="2" class="fontsml"><?php echo $num; ?> career development tutor online</td>
                      <?php
					    } else {
					  ?>
                        <td height="38" colspan="2" class="fontsml"><?php echo $num; ?> career development tutors online</td>
                      <?php
					   }
					  ?>
                    </tr>
                    <?php 
					  if ($num>0) {
					?> 
                    <tr>
                    <?php
                     if(!isset($HTTP_SESSION_VARS['user_id'])){
						$chatstr = 'user_login.php';
					 } else {
						$chatstr = 'javascript:chatnow();';
					 }
					?>
                      <td height="32" colspan="2" valign="top"><div align="right"><img src="images/layout_16.jpg" width="92" height="32" border="0" usemap="#Map2" /></div></td>
                    </tr>
                    <?php
					}
					?>
                </table></td>
              </tr>
</table> -->
              <table width="195" border="0" align="center" cellpadding="0" cellspacing="0">                
                <tr>
                  <td valign="top" bgcolor="#f5f5f5">
				  	<table width="192" border="0" cellspacing="0" cellpadding="0">

                <tr>

                  <td width="192" height="35"><img src="images/layout_13.jpg" width="191" height="30" />                    <!--<img src="images/layout_41.jpg" width="192" height="35" />--></td>

                </tr>

                <tr>

                  <td height="150" valign="top">
				  <form action="user_login.php" method="post" name="FRMLOGIN" id="FRMLOGIN" onsubmit="return checklogin()">
				  <table width="182" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="66" class="fontnorm">User ID:</td>
                      <td><!--<input name="user_id" type="text" class="fontnorm" id="user_id" size="15" />-->
                          <input name="TXUSERID" type="text" id="TXUSERID" size="15"  class="fontnorm"/>
                      </td>
                    </tr>
                    <tr>
                      <td height="38" class="fontnorm">Password:</td>
                      <td bgcolor="#f5f5f5"><!--<input name="password" type="password" class="fontnorm" id="password" size="15" />-->
                          <input name="TXPASSWORD" type="password" id="TXPASSWORD" size="15"  class="fontnorm"/>
                      </td>
                    </tr>
                    <tr>
                      <td height="30" colspan="2"><div align="right">
                          <!--<img src="images/layout_19.jpg" width="54" height="32" border="0" usemap="#Map" />-->
                          <input type="image" src="images/layout_19.jpg" name="submit"/>
                      </div></td>
                    </tr>
                    <tr>
                      <td height="25" colspan="2" valign="top" class="bot_link"><a href="forgotpwd.php" class="links">Forgot your password?</a></td>
                    </tr>
                    <tr>
                      <td height="41" colspan="2" valign="top"><p><span class="fontnorm">New member?</span> <a href="user_parent_register.php" class="links">Register here</a></p></td>
                    </tr>
                    <tr>
                      <td height="51" colspan="2" valign="top">&nbsp;</td>
                    </tr>
                  </table>
				  </form>
                  <!--<table width="193" border="0" align="center" cellpadding="0" cellspacing="2">

                      <tr>

                        <td colspan="2">&nbsp;</td>

                      </tr>

                      <tr>

                        <td width="17" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                        <td width="170" height="50" valign="top" class="fontnorm_justified">Receive one-to-one Personal &amp; curriculum target  setting</td>

                      </tr>

                      <tr>

                        <td valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                        <td height="60" valign="top"class="fontnorm_justified">Have their own digital portfolio where they can access course work online</td>

                      </tr>

                      <tr>

                        <td valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                        <td height="50" valign="top" class="fontnorm_justified">Speak to a mentor, tutors and career advisors online</td>

                      </tr>

                      <tr>

                        <td valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                        <td height="50" valign="top" class="fontnorm_justified">Upload course work to their tutor</td>

                      </tr>

                      <tr>

                        <td valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                        <td height="50" valign="top" class="fontnorm_justified">Receive lessons and progress reports online</td>

                      </tr>

                      <tr>

                        <td valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                        <td height="60" valign="top" class="fontnorm_justified">Tutors and mentors can monitor and track their progress online</td>

                      </tr>

                  </table>--></td>

                </tr>

              </table>
				  </td>
                </tr>
              </table>

              <!--<table width="196" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><img src="images/layout_47.jpg" width="196" height="33" /></td>
                </tr>
                <tr>
                  <td height="150" valign="top"><table width="188" border="0" align="center" cellpadding="0" cellspacing="2">
                    <tr>
                      <td height="19">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="67"><div align="center"><img src="images/career_img.png" width="153" height="63" border="0" usemap="#Map10Map" /></div></td>
                    </tr>
                    <tr>
                      <td height="95"><div align="center"><img src="images/curriculum.jpg" width="180" height="45" border="0" usemap="#Map11Map" /></div></td>
                    </tr>
                    <tr>
                      <td><div align="center"></div></td>
                    </tr>
                  </table>
                    <map name="Map10Map" id="Map10Map">
                      <area shape="rect" coords="-4,2,157,61" href="careerprofile.php" />
                    </map>
                    <map name="Map11Map" id="Map11Map">
                      <area shape="rect" coords="2,1,181,46" href="http://www.curriculumonline.gov.uk/" target="_blank" />
                    </map></td>
                </tr>
              </table>-->