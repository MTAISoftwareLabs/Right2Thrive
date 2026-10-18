<table width="191" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>
                <td height="137" align="center">
				<!-- BEGIN Comm100 Live Chat Button Code -->
				<div><div id="comm100_LiveChatDiv"></div><a href="http://www.comm100.com/livechat/" onclick="comm100_Chat();return false;" target="_blank" title = "Live Chat Live Help Software for Website"><img id="comm100_ButtonImage" src="http://chatserver.comm100.com/BBS.aspx?siteId=41309&planId=363" border="0px" alt="Live Chat Live Help Software for Website" /></a><script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=41309&planId=363"type="text/javascript"></script><div id="comm100_track" style="z-index:99;"><span style="font-size:10px; font-family:Arial, Helvetica, sans-serif;color:#555"><a href="http://www.comm100.com/livechat/" style="text-decoration:none;color:#555" target="_blank"><b>Live Chat Software</b></a> by <a href="http://www.comm100.com/" style="text-decoration:none;color:#009999;" target="_blank">Comm100</a></span></div></div><!-- End Comm100 Live Chat Button Code -->				</td>
              </tr>
              
              
              <tr>

                <td width="191"><img src="images/online_courses.jpg" width="192" height="33" /></td>
              </tr>

              <tr>

                <td height="150" valign="top" bgcolor="#f5f5f5"><!--<form id="login" name="login" method="post" action="">-->

                
                <!--<table>
						<tr>
							<td>
								<font face="Arial, Helvetica, sans-serif" color="#0066CC" size="1px"><u><a href="onlinetutor.php">ONLINE TUTORS/ MENTORS NEEDED</a></u></font>
							</td>
						</tr>
						<tr height="25px">
							<td>&nbsp;
								
							</td>
						</tr>
					</table>-->
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
                     <!-- <tr>
                        <td height="28" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                        <td valign="top" class="fontnorm"><a href="coursedetail.php?id=5" class="links">Creating an effective CV</a></td>
                      </tr>
                      <tr>
                        <td height="19" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                        <td valign="top" class="fontnorm"><a href="coursedetail.php?id=4" class="links">Job Search</a></td>
                      </tr>-->
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
                    <table width="192" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
						  <td><img src="images/layout_27.jpg" width="192" height="33" /></td>
					  </tr>
						<tr>
						  <td height="50" align="center"><table width="189" height="76" border="0" align="center" cellpadding="0" cellspacing="2">
                            <tr>
                              <td height="19" colspan="2" valign="top" class="fontnorm_sml">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="17" height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td width="166" valign="top" class="fontnorm"><a href="our_products.php">Our Products </a></td>
                            </tr>

                            <tr>
                              <td height="19" colspan="2"><img src="images/scrren1_thumb..jpg" width="150" height="120" border="0" /></td>
                            </tr>
                          </table>					      </td>
					  </tr>
						<tr>

                              <td height="30" valign="middle" align="center" colspan="2">&nbsp;</td>
                      </tr>	
                      <tr>

                        <!--<td width="192"><img src="images/layout_27.jpg" width="192" height="33" /></td>
                      </tr>

                      <tr>

                        <td height="150" valign="top"><table width="189" border="0" align="center" cellpadding="0" cellspacing="2">

                            <tr>

                              <td colspan="2" class="fontnorm_sml">&nbsp;</td>
                            </tr>

                            <tr>

                              <td width="17" height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                              <td width="166" valign="top" class="fontnorm"> <a href="coursedetail.php?id=20" class="links">Career Planning </a></td>
                            </tr>

                            <tr>

                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                              <td valign="top" class="fontnorm"><a href="coursedetail.php?id=5" class="links">Creating an effective CV</a></td>
                            </tr>

                            <tr>

                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>

                              <td valign="top" class="fontnorm"><a href="coursedetail.php?id=4" class="links">Job Search</a></td>
                            </tr>
							<tr><td>&nbsp;</td></tr>
							
							

                        </table></td>-->
                      </tr>
					  <tr>
					  	<td align="center">
							<a href="http://www.facebook.com/pages/CareerPaths-Online/112757125402937?v=wall" target="_blank"><img src="images/facebook.jpg" style="text-decoration:none;border:0"/></a>						</td>
					  </tr>
					  <tr>
					  	<td>&nbsp;						</td>
					  </tr>
					  <tr>
					  	<td align="center">
							<!--<a href="http://twitter.com/CareerPaths1" target="_blank"><img src="images/twitter.jpg" height="80" width="150" 
							style="text-decoration:none;border:0"/></a>			-->			</td>
					  </tr>
                    </table>              </td>
              </tr>

            </table>

              