<?php

include('head.php');

?>



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

                    <tr><td colspan="3">&nbsp;</td></tr>

                     	<tr>

                              <td width="75%" class="intheading"><img src="images/arrow.gif" width="14" height="14" /> Welcome to News</td>

                              <td width="8%"><div align="right"><a href="javascript:print()"><img src="images/print_this_page.jpg" width="16" height="16" border="0" /></a></div></td>

                              <td width="17%" class="bodytext"><div align="right"><a  class="print" href="javascript:print()">Print 

                                this page</a></div></td>

                            </tr>

            		</table>

              		<table width="380" border="0" align="center" cellpadding="0" cellspacing="0">

                	

              		</table>

                      <?

			$sql="SELECT * FROM cpo_newsmaster where iStatus=1 order by iNewsID desc";

    		$rID1=runquery($sql);

			$num = $rID1 ? mysqli_num_rows($rID1) : 0 ;

		   ?>

              		<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

                		 <tr>

                        <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="23" /></td>

                        <td width="96%" background="images/changep_center_cor.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td width="49%" class="welcome"><div align="left"><font color="#FFFFFF"><strong>News</strong></font></div></td>

                              <td width="50%" class="welcome"><div align="right"><strong>::</strong></div></td>

                            </tr>

                        </table></td>

                        <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>

                      </tr>

              		</table>

              		<table width="550" border="0" align="center" cellpadding="0" cellspacing="0" class="forborder">

                	<tr>

                        <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;"><? if($num > 0)

                  {

                   while ($rs1 = mysqli_fetch_row($rID1))

                    {

						 $d=explode("-",$rs1[3]);

						 

					?>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">

                              <tr>

                                <td height="22" bgcolor="DFEAF2"><table width="100%">

                                    <tr>

                                      <td width="50%" class="fontgreen"><b><? echo $rs1[1]; ?></b></td>

                                      <td width="50%" class="fontgreen"><b>Posting Date    : <? echo $d[2]."/".$d[1]."/".$d[0];?></b></td>

                                    </tr>

                                </table></td>

                              </tr>

                              <tr>

                                <td><table cellpadding="4" cellspacing="2" width="100%">

                                    <tr bgcolor="#FFFFFF">

                                      <td width="25%" rowspan="2" valign="top"><div align="center">

                                          <?	if(file_exists("admin/upload/".$rs1[0].".jpg"))

			{

				$file1="admin/upload/".$rs1[0].".jpg";

			}

			else

			{

				$file1="images/noavailable_big.jpg";

			}?>

<!--                                          <div align="center"><a class="link" href="javascript:openwin(<? //echo $rs1[0] ?>)"><img src="<? //echo $file1; ?>" width="90" height="90" border="0" /></a></div>
-->
                                      </div></td>

                                      <td width="75%" valign="top" class="fontnorm"><? echo substr($rs1[2], 0,500); ?>..</td>

                                    </tr>

                                    <tr>

                                      <td height="18" valign="middle" ><div align="right">

                                          <div align="right">
										  	<!-- <a class="links2" href="javascript:openwin(<? echo $rs1[0] ?>)">More..</a>&nbsp;&nbsp; -->
											<a class="links2" href="newsdetail.php?id=<? echo $rs1[0];?>">More..</a>&nbsp;&nbsp;
										  </div>

                                      </div></td>

                                    </tr>

                                    <tr>

                                      <td colspan="2">&nbsp;</td>

                                    </tr>

                                </table></td>

                              </tr>

                            </table>

                          <?

			}

		}

		else

		{

		?>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%">

                              <tr>

                                <td height="22"><table width="100%">

                                    <tr>

                                      <td align="center" class="fontgreen"><b>No News Found!!</b></td>

                                    </tr>

                                </table

						></td>

                              </tr>

                            </table>

                          <?

		}

		?>

        <table width="550" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

                        <td width="2%" ><img src="images/changebttm_left_cor.jpg" width="11" height="25" /></td>

                        <td width="96%" height="22" background="images/changebttm_center_cor.jpg" ><div align="right"></div></td>

                        <td width="2%" ><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25" /></div></td>

                      </tr>

        </table>

        

                        </td>

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

