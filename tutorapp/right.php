<table width="191" border="0" align="center" cellpadding="0" cellspacing="0">
 <tr>

                  <td width="192" height="35"><img src="images/layout_25.png" width="191" height="30" />                    <!--<img src="images/layout_41.jpg" width="192" height="35" />--></td>
                </tr>
<tr>
<td>
<form action="user_login.php" method="post" name="FRMLOGIN" id="FRMLOGIN" onsubmit="return checklogin()">
				  <table width="182" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="66" class="fontnorm">User ID:</td>
                      <td><!--<input name="user_id" type="text" class="fontnorm" id="user_id" size="15" />-->
                          <input name="TXUSERID" type="text" id="TXUSERID" size="15"  class="fontnorm"/>                      </td>
                    </tr>
                    <tr>
                      <td height="30" class="fontnorm">Password:</td>
                      <td bgcolor="#f5f5f5"><!--<input name="password" type="password" class="fontnorm" id="password" size="15" />-->
                          <input name="TXPASSWORD" type="password" id="TXPASSWORD" size="15"  class="fontnorm"/>                      </td>
                    </tr>
                    <tr>
                      <td height="36" colspan="2"><div align="right">
                          <!--<img src="images/layout_19.jpg" width="54" height="32" border="0" usemap="#Map" />-->
                          <input type="image" src="images/layout_19.jpg" name="submit"/>
                      </div></td>
                    </tr>
                    <tr>
                      <td height="19" colspan="2" valign="top" class="bot_link"><a href="forgotpwd.php" class="links">Forgot your password?</a></td>
                    </tr>
                    <tr>
                      <td  colspan="2" valign="top"><span class="fontnorm">New member?</span> <a href="user_parent_register.php" class="links">Register here</a></td>
                    </tr>
                  </table>
	  </form>				  </td>
				  </tr>
				  <tr>
				  <td height="38">&nbsp;</td>
				  </tr>
 
              <tr>
                <td height="50" align="center">
				<!-- BEGIN Comm100 Live Chat Button Code -->
				<!--<div><div id="comm100_LiveChatDiv"></div><a href="http://www.comm100.com/livechat/" onclick="comm100_Chat();return false;" target="_blank" title = "Live Chat Live Help Software for Website"><img id="comm100_ButtonImage" src="http://chatserver.comm100.com/BBS.aspx?siteId=41309&planId=363" border="0px" alt="Live Chat Live Help Software for Website" /></a><script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=41309&planId=363"type="text/javascript"></script><div id="comm100_track" style="z-index:99;"><span style="font-size:10px; font-family:Arial, Helvetica, sans-serif;color:#555"><a href="http://www.comm100.com/livechat/" style="text-decoration:none;color:#555" target="_blank"><b>Live Chat Software</b></a> by <a href="http://www.comm100.com/" style="text-decoration:none;color:#009999;" target="_blank">Comm100</a></span></div></div>--><!-- End Comm100 Live Chat Button Code -->		
				<a href="resume_upload.php"><img src="btn_postresume.png" width="184" height="48" border="0" /></a>						</td>
              </tr>
              <tr>
                <td height="20" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td height="43" align="center" style="font-size:14px; font-weight:600"><a href="lms/careersuit.php" >Find out what career suit you</a></td>
              </tr>
              <tr>
                <td height="24" align="center"><a href="lms/careersuit.php" ><img src="about_new.jpg" width="170" height="100" border="0" /></a></td>
              </tr>
              <tr>
                <td height="19" align="center">&nbsp;</td>
              </tr>
              <tr>
					  	<td height="57" align="center">
							<a href="http://www.facebook.com/pages/CareerPaths-Online/112757125402937?v=wall" target="_blank"><img src="images/facebook.jpg" style="text-decoration:none;border:0"/></a>						</td>
  </tr>
              
              <!--<tr>

                <td width="191"><img src="images/online_courses.jpg" width="192" height="33" /></td>
              </tr>-->

            <!--<tr>

                <td height="150" valign="top" bgcolor="#f5f5f5"><form id="login" name="login" method="post" action="">

                
               <table>
						<tr>
							<td>
								<font face="Arial, Helvetica, sans-serif" color="#0066CC" size="1px"><u><a href="onlinetutor.php">ONLINE TUTORS/ MENTORS NEEDED</a></u></font>
							</td>
						</tr>
						<tr height="25px">
							<td>&nbsp;
								
							</td>
						</tr>
					</table>
					<table width="189" height="90" border="0" align="center" cellpadding="0" cellspacing="2">
					<?php
					$sql="select * FROM cpo_coursemaster";
					$rID=runquery($sql);
					while($fetch=mysqli_fetch_array($rID)){
					?>
                      
                      <tr>
                        <td width="17" height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                        <td width="166" valign="top" class="fontnorm"><a href="coursedetail.php?id=<?=$fetch['iCourseId'];?>" class="links"><?=$fetch['vCourseName']?> </a></td>
                      </tr>
					  <? } ?>
                     <tr>
                        <td height="28" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                        <td valign="top" class="fontnorm"><a href="coursedetail.php?id=5" class="links">Creating an effective CV</a></td>
                      </tr>
                      <tr>
                        <td height="19" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                        <td valign="top" class="fontnorm"><a href="coursedetail.php?id=4" class="links">Job Search</a></td>
                      </tr>
                  </table>
					
					 <table width="196" height="158" border="0" align="center" cellpadding="0" cellspacing="0">
               <tr>
                  <td><img src="images/home_tution.jpg" width="195" height="33" /></td>
                </tr>
                <tr>
                  <td height="113" align="center" valign="middle"><strong><a href="helping_gcse.php">Helping you to prepare for GCSE &amp; A- Level Exams </a></strong>
                    <map name="Map11Map" id="Map11Map">
                      <area shape="rect" coords="2,1,181,46" href="http://www.curriculumonline.gov.uk/" target="_blank" />
                  </map></td>
                </tr>
              </table>
                                  </td>
              </tr>-->

            </table>

              