<table width="195" height="206" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="195" bgcolor="#f5f5f5"><img src="images/layout_11.jpg" width="195" height="30" /></td>
              </tr>
              <tr>
                <td height="176" valign="top" bgcolor="#f5f5f5"><table width="187" height="156" border="0" align="center" cellpadding="0" cellspacing="0">
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
                      <td height="46" colspan="2" valign="top"><div align="right"><img src="images/layout_16.jpg" width="92" height="32" border="0" usemap="#Map2" /></div></td>
                    </tr>
                    <?php
					}
					?>
                </table></td>
              </tr>
            </table>
              <table width="195" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="195" bgcolor="#f5f5f5"><img src="images/layout_25.jpg" width="195" height="33" /></td>
                </tr>
                <tr>
                  <td valign="top" bgcolor="#f5f5f5"><table width="189" border="0" align="center" cellpadding="0" cellspacing="2">
                            <tr>
                              <td colspan="2" class="fontnorm_sml">&nbsp;</td>
                            </tr>
                            <tr>
                              <td width="17" height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td width="166" valign="top" class="fontnorm"> <a href="http://careerpathsonline.net/apprenticeships.php" class="links">Apprenticeships</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/bskills.php" class="links">Basic Skills</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/e2e.php" class="links">Entry 2 Employment</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/college.php" class="links">Best time to go college</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/christmas_work.php" class="links">Christmas work</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/gcse_retakes.php" class="links">GCSE retakes</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/decide.php" class="links">How do I decide</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/respect.php" class="links">Respect</a></td>
                            </tr>
                            <tr>
                              <td height="30" valign="top"><div align="right"><img src="images/layout_33.jpg" width="14" height="14" /></div></td>
                              <td valign="top" class="fontnorm"><a href="http://careerpathsonline.net/w3c_accessibility.php" class="links">W3C Accessibility</a></td>
                            </tr>
                            
                        </table></td>
                </tr>
              </table>
              <table width="196" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="196"><img src="images/layout_40.jpg" width="196" height="33" /></td>
                </tr>
                <tr>
                  <td height="150" valign="top">
                  	<table width="100%">
                    <tr>
            		<td align="left"><p> <a href="http://careerpathsonline.net/newsdetail.php?id=14" class="links">Graduates 'regret degree choice'</a> </p></td>
                    </tr>
                    <tr>
                    <td align="left"><p>
                    <a href="http://careerpathsonline.net/newsdetail.php?id=13" class="links">E-learning to help Hackney&rsquo;s NEET</a></p></td>
          </tr>
          <tr>
            <td height="40" align="right"><a href="http://careerpathsonline.net/morenews.php" class="links2">&gt;&gt;More News</a></td>
          </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <table width="196" border="0" align="center" cellpadding="0" cellspacing="0">
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
              </table>