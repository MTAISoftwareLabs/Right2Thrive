<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Event History<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<?php define('show_page_size',25); ?>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Interactive</h4>
            </div>
            <div class="page-content">
				<?php include "in-section-chat.php"; ?>
                <section class="row">
                    <div class="col-12">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="download-center-tab" href="in-download-center" role="tab" aria-controls="download-center" aria-selected="false"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download Center</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="book-chat-tab" href="in-book-chat" role="tab" aria-controls="book-chat" aria-selected="false"><i class="fa fa-clock-o" aria-hidden="true"></i> Book Chat</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="mail-tutors-tab" href="in-mail-tutors" role="tab" aria-controls="mail-tutors" aria-selected="false"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mail To Tutor</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="event-history-tab" href="in-event-history" role="tab" aria-controls="event-history" aria-selected="true"><i class="fa fa-history" aria-hidden="false"></i> Event History</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="event-history" role="tabpanel" aria-labelledby="event-history-tab">
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body">
												<h5 class="text-center">Event History</h5>
												<small class="text-muted text-danger">Search Criteria</small>
													<form class="" name="FRMLEARNEROPERATION" method="post" action="in-event-history?next=1#search">
													  <div class="form-group">
															<select class="form-select" name="CMBEVENT" id="tutor">
																<option value="" disabled selected>Select Operation</option>
																<?php
																	$seltutor = "select * from operation";
																	$rst = runquery($seltutor);
																	echo "<option value='0'>ALL</option>";
																	foreach($rst as $rstutor){
																		if (isset($_POST['CMBEVENT']) && $_POST['CMBEVENT'] == $rstutor['OperationId']) {
																			$selected = "selected";
																		}else{
																			$selected = "";
																		}
																		echo "<option value=".$rstutor['OperationId']." $selected>".$rstutor['OperationDesc']."</option>";

																	}
																?>															
															</select>
													  </div>
													  <div class="row">
														  <div class="col-md-6 form-group">
															<label>From Date</label>
															<input type="date" class="form-control" name="TXDATE" id="scdate" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>
														  </div>
														  <div class="col-md-6 form-group">
															<label>To Date</label>
															<input type="date" class="form-control" name="TXDATE" id="scdate" value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>
														  </div>
													  </div>										  
													  <div class="form-group text-center" id="search">
													  	<button type="submit" class="btn btn-primary btn-sm mt-4" id="btnbchat" name="search" disabled>Search</button>
													  </div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
									</div>
								</div>

								<div class="table-responsive" id="search1">
								<?php
									if(isset($_GET['next'])){
										echo "<h5>Search Result</h5>";
										$sql="SELECT TrackLogId,StudentId,StudentName,OperationId,DateTime,IPAddress,LEFT(DateTime,10)AS tdate,RIGHT(DateTime,8)AS ttime FROM tracklogstudent where 1=1 and StudentId=".$user_id;
										if (isset($_REQUEST['CMBEVENT']) && $_REQUEST['CMBEVENT'] <> "0"){
											$sql .= " and OperationId=".$_REQUEST['CMBEVENT'];
										}if (isset($_REQUEST['CMBLEARNER']) && $_REQUEST['CMBLEARNER'] <> "0"){
											$sql .= " and StudentId=".$_REQUEST['CMBLEARNER'];
										}if (isset($_REQUEST['TXSTARTDATE']) && $_REQUEST['TXSTARTDATE'] <> ""){
											$sdate = explode("/",$_REQUEST['TXSTARTDATE']);
											$tday=$sdate[2]."-".$sdate[1]."-".$sdate[0];
											$sql .= " and DateTime>='".$tday."'";
										}if (isset($_REQUEST['TXENDDATE']) && $_REQUEST['TXENDDATE'] <> ""){
											$sdate = explode("/",$_REQUEST['TXENDDATE']);
											$tday=$sdate[2]."-".$sdate[1]."-".($sdate[0]+1);
											$sql .= " and DateTime<'".$tday."'";
										}
										$sql .= " ORDER BY tdate DESC,ttime";
												

										$rID=runquery1($sql);
										$count = $rID ? mysqli_num_rows($rID) : 0;

										$page=Ceil($count/show_page_size);
										if(isset($_GET['curpage'])){
											$curpage = $_GET['curpage'];
											if($curpage==0){
												$sql.=" Limit 0,".show_page_size;
												$lmt =" Limit 0,".show_page_size;
											}else{
												$current=show_page_size*($curpage);
												$sql.=" Limit " .$current. ",".show_page_size;
												$lmt=" Limit " .$current. ",".show_page_size;
											}
										}else{
											$sql.=" Limit 0,".show_page_size;
											$lmt=" Limit 0,".show_page_size;
											$curpage=0;
										}

										$rID=runquery($sql) or die('could not'.mysqli_error());
																																	
										$num = $rID ? mysqli_num_rows($rID) : 0 ;
										if($num){
											$flg=true;
											$x="";
											while ($rs = mysqli_fetch_row($rID)){
												$tutorname = "";
												$sqltutor = "select OperationDesc from operation where OperationId=".$rs[3];
												$rstutor = runquery($sqltutor);
												$num1 = $rstutor ? mysqli_num_rows($rstutor) : 0 ;
												if ($num1 > 0 ){
													$rsdata = mysqli_fetch_array($rstutor);
													$tutorname = $rsdata[0];
												}
												
												$sdt=explode(" ",$rs[4]); 
												$sddt=explode("-",$sdt[0]);
												$stdt=explode(":",$sdt[1]);
																				
												$sdcon=$sddt[2]."/".$sddt[1]."/".$sddt[0];
												$stcon=$stdt[0].":".$stdt[1].":".$stdt[2];
												if($x==""){
													$flg=true;
													$x=$sddt[2];
												}elseif($x!=""){													
													if($sddt[2]==$x){
														$flg=false;
													}else{
															$flg=true;
															$x=$sddt[2];
													}	
												}
																							
												if($flg==true)
												{									
													echo "<table class='table table-hover'><thead class='dark'><tr><th colspan='3' class='small'>Date: $sdcon</th></tr><tr class='bg-light text-dark'><th>Operations</th><th>Time</th><th>IP Address</th></tr></thead><tbody>";
													$flg=false;
												}
													echo "<tr><td>$tutorname</td><td>$stcon</td><td>$rs[5]</td></tr>";								
											}
										}else{
											echo "<tr><td colspan='3' class='text-center font-bold'>No Records found</td></tr>";
										}
								?>
													
													</tbody>
												</table>
										<div class="dataTable-bottom">
											<ul class="pagination pagination-primary float-end dataTable-pagination">
												<?php
												if($page>1){ 
													echo "Page : ";
													for($i=1;$i<=$page;$i++){
														if($i==($curpage+1)){
															echo "<li class='page-item active'><a href='#' class='page-link' data-page='$i'>$i</a></li>";
														}else{
															$str="";
															$j = $i-1;
															if(isset($_REQUEST['CMBEVENT'])){ 
																$getevent = $_REQUEST['CMBEVENT'];
															}else{  
																$getevent = ""; 
															}
															if(isset($_REQUEST['TXSTARTDATE'])){ 
																$getstartdate = $_REQUEST['TXSTARTDATE']; 
															}else{ 
																$getstartdate = ""; 
															}
															if(isset($_REQUEST['TXENDDATE'])){ 
																$getenddate = $_REQUEST['TXENDDATE']; 
															}else{ 
																$getenddate = ""; 
															}
															echo "<li class='page-item'><a class='page-link' data-page='$i' href='in-event-history?curpage=$j&next=1&CMBEVENT=$getevent&TXSTARTDATE=$getstartdate&TXENDDATE=$getenddate#search'>$i</a></li>";															
														}									
													}
												}
												?>
											</ul>
										</div>
									</div>
								<?php
									}
								?>
								
							</div>
						</div>							
                    </div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>
	<script>		
		$(document).ready(function(){
		  $("#tutor").change(function(){
			if($("#tutor").val() !== ""){
				$("#btnbchat").attr("disabled", false);
			}else{
				$("#btnbchat").attr("disabled", true);
			}
		  });
		});
		
		function chatnow(){
			new1=window.open("../chatnew/","","titlebar='CareerPaths Online - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
		}
    </script>
</body>

</html>