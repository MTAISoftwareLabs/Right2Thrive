<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Book Chat Time<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
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
								<a class="nav-link active" id="book-chat-tab" href="in-book-chat" role="tab" aria-controls="book-chat" aria-selected="true"><i class="fa fa-clock-o" aria-hidden="false"></i> Book Chat</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="mail-tutors-tab" href="in-mail-tutors" role="tab" aria-controls="mail-tutors" aria-selected="false"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mail To Tutor</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="event-history-tab" href="in-event-history" role="tab" aria-controls="event-history" aria-selected="false"><i class="fa fa-history" aria-hidden="true"></i> Event History</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="book-chat" role="tabpanel" aria-labelledby="book-chat-tab">
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body">
												<h5 class="text-center">Book Chat</h5>
													<?php 
														if(isset($_POST['btnbchat'])){
															$topic_discuss = clean_string($_POST['TXTOPIC']);
															$tutor_id = $_POST['CBOTUTOR'];
															$is_urgent = isset($_POST['CHURGENT'])?1:0;
															// TXDATE, TXTIME, TXDURATION
															$scd = $_POST['TXDATE'];
															$sct = $_POST['TXTIME'];
															$dur = $_POST['TXDURATION'];
															$startdate = $scd." ".$sct;
															$startdatestring = strtotime($startdate);
															$enddatestring = $startdatestring + ($dur*60);
															$newstartdate = date('Y-m-d H:i:s', $startdatestring);
															$newenddate = date('Y-m-d H:i:s', $enddatestring);
															
															$sqlchk="select StartApprovalDateTime,EndApprovalDateTime from cpo_bookchattime where iTutorId=".$tutor_id." and (StartApprovalDateTime between '".$newstartdate."' and '".$newenddate."' or EndApprovalDateTime between '".$newstartdate."' and '".$newenddate."')";
															$ressqlchk=runquery($sqlchk);
															$num=$ressqlchk ? mysqli_num_rows($ressqlchk) : 0;
															if($num==0){
																//// Check for learners booking for the same date and time
																$sqlchk1="select StartApprovalDateTime,EndApprovalDateTime from cpo_bookchattime where iUserId=".$user_id." and (StartApprovalDateTime between '".$newstartdate."' and '".$newenddate."' or EndApprovalDateTime between '".$newstartdate."' and '".$newenddate."')";
																$ressqlchk1=runquery($sqlchk1);
																$num1=$ressqlchk1 ? mysqli_num_rows($ressqlchk1) : 0; 
																if($num1>0){
																	$num=1;
																}
															}
															
															if($num > 0){
																echo "<div class='alert alert-warning' role='alert'>This Chat time is already Booked.</div>";
															}else{
																$insert_times="insert into cpo_bookchattime (iUserId,iTutorId,dBookingDate,vTopicToDiscuss,iIsUrgent,StartApprovalDateTime,EndApprovalDateTime,iIsApproved) values (".$user_id.",".$tutor_id.",'".date('Y-m-d H:i:s')."','".$topic_discuss."',".$is_urgent.",'".$newstartdate."','".$newenddate."',1)";
																runquery($insert_times) or die(mysqli_error($conn));
																echo "<div class='alert alert-success' role='alert'>Your request has been submited.</div>";
																//////////// To Learner
																$fromname = $_SESSION['user_name'];
																$fromaddress = admin_email;
																$toname = $_SESSION['user_name'];
																$toaddress = $_SESSION['email_id'];
																$subject = "Chat time booking in CareerPaths Online";
																$message ="<html><body><p>Dear ".$_SESSION['user_name'].",</p>";
																$message .= "<p>Your request for chatting with tutor has been submited.</p>";
																$message .= "<p>Warm Regard From,</p>";
																$message .= "<p>CareerPaths Online Team</p></body></html>";
																SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
																//////////// To Tutor
																$seltutor = "select vUserName,vUserEmailId from cpo_usermaster where iUserId=".$tutor_id;
																$rstutor = runquery($seltutor);
																$tutor_name = '';
																$tutor_email = '';
																if($rstutor){
																	$rssettutor = mysqli_fetch_array($rstutor);
																	$tutor_name = $rssettutor['vUserName'];
																	$tutor_email = $rssettutor['vUserEmailId'];
																}
																
																$fromname = $_SESSION['user_name'];
																$fromaddress = $_SESSION['email_id'];
																$toname = $tutor_name;
																$toaddress = $tutor_email;
																$subject = "Chat time booking in CareerPaths Online";
																$message ="<html><body><p>Dear ".$tutor_name.",</p>";
																$message .= "<p>Request for chat time booking with you has been submited by ".$_SESSION['user_name'].".</p>";
																$message .= "<p>Warm Regard From,</p>";
																$message .= "<p>CareerPaths Online Team</p></body></html>";
																SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
																addlog(7);
															}
														}	
													?>
													<form class="" name="FRMUPLOADFILE" method="post" action="in-book-chat" id="chatbfrom" onsubmit="validate();">
													  <div class="form-group">
													  	<input type="text" class="form-control" name="TXTOPIC" id="basicInput" placeholder="Topic to discuss" maxlength="50" required>
														<small class="text-muted text-danger">Write topic upto 50 letters.</small>
													  </div>
													  <div class="form-group">
															<select class="form-select" name="CBOTUTOR" id="tutor">
																<option value="" disabled>Select Tutor</option>
																<?php
																	$query_tutor_id = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
																	$result_tutor_id = runquery($query_tutor_id);
																	$nos = $result_tutor_id ? mysqli_num_rows($result_tutor_id) : 0 ;
																	if($nos > 0){
																		$tutor_ids='';
																		while($result_tutor = mysqli_fetch_array($result_tutor_id)){
																			$str_tutor_id=$result_tutor['vTutorId'];
																			$str_tutor_length = strlen($str_tutor_id)-1;
																			if(substr($str_tutor_id,$str_tutor_length-1,$str_tutor_length)<>','){
																				$str_tutor_id=$result_tutor['vTutorId'].',';
																			}
																			$tutor_ids.= $str_tutor_id;
																		}
																		if($tutor_ids<>''){
																			$tutor_ids=substr($tutor_ids,0,strlen($tutor_ids)-1);								
																			$query_tutor_info = "select iUserId,vUserName from cpo_usermaster where iUserId in (".$tutor_ids.")";
																			$result_tutor_info = runquery($query_tutor_info);
																			$nos = 0;
																			if($result_tutor_info){
																				$nos = mysqli_num_rows($result_tutor_info);
																			}
																			if($nos>0){
																				while($result_tutor = mysqli_fetch_array($result_tutor_info)){
																					echo "<option value=".$result_tutor['iUserId'].">".$result_tutor['vUserName']."</option>";
																				}									
																			}
																		}
																	}else{
																		echo "<option value='' selected>No Tutor Exists For Selection</option>";
																	}
																?>																
															</select>
													  </div>
													  <div class="row">
														  <div class="col-md-8 form-group">
															<label>Select Chat Date</label>
															<input type="date" class="form-control" name="TXDATE" id="scdate" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" required>
														  </div>
														  <div class="col-md-4 form-group form-check">
																<div class="custom-control custom-checkbox mt-4">
																	Is it Urgent ? <input type="checkbox" class="form-check-input form-check-success" name="CHURGENT" id="urgent">
																</div>
														  </div>
													  </div>
													  <div class="row">
														  <div class="col-md-6 form-group">
															<label>Chat Start Time</label>
															<input type="time" class="form-control" name="TXTIME" id="cstime" value="<?php echo date('H:i'); ?>" required>
														  </div>
														  <div class="col-md-6 form-group">	
															<label>Chat Duration</label>														
															<select class="form-select" name="TXDURATION" id="tutor">
																<option value="15">15 Min</option>
																<option value="30" selected>30 Min</option>
																<option value="45">45 Min</option>
																<option value="60">01 Hour</option>
																<option value="75">01:15 Hour</option>
																<option value="90">01:30 Hour</option>
																<option value="105">01:45 Hour</option>
																<option value="120">02 Hour</option>
															</select>
														  </div>
													  </div>
													  <p class="small mt-1 text-danger text-center">Make booking for maximum 2 hours.</p>											  
													  <div class="form-group text-center">
													  	<button type="submit" class="btn btn-primary btn-sm" id="btnbchat" name="btnbchat" disabled>Book Chat Now</button>
													  </div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
									</div>
								</div>
								<div class="table-responsive">
									<h5>Chat Booking Record</h5>
									<table class="table table-hover mb-0">
										<thead class="dark">
											<tr>
												<th>Tutor Name</td>
												<th>Chat Date/Time</td>
												<th>Chat Duration</td>
												<th>Topic to Discuss</td>
											</tr>
										</thead>
										<tbody>											
											<?php
												$sqlspn="select * from cpo_bookchattime where iUserId=".$user_id." and (iIsApproved=1 and  EndApprovalDateTime >='".date('Y-m-d G:i:s')."')";
												$result = runquery($sqlspn);
												$count = mysqli_num_rows($result);
												$page=Ceil($count/page_size);
												if(isset($_GET['curpage'])){
													$curpage = $_GET['curpage'];
													if($curpage==0){
														 $sqlspn.=" order by dBookingDate desc Limit 0,".page_size;
													}else{
														$current=page_size*($curpage);
														$sqlspn.=" order by dBookingDate desc Limit " .$current. ",".page_size;
													}
												}else{
												   $sqlspn.=" order by dBookingDate desc Limit 0,".page_size;
												   $curpage=0;
												}
												$result = runquery($sqlspn);
												$num=$result ? mysqli_num_rows($result) : 0;
												if($num > 0){
													while($res=mysqli_fetch_array($result)){
														$sqluser="select vUserName from cpo_usermaster where iUserId=".$res['iTutorId']."";
														$ressqluser=runquery($sqluser);
														$no=$ressqluser ? mysqli_num_rows($ressqluser) : 0;
														if($no > 0){
															$ressqluser=mysqli_fetch_array($ressqluser);
														}
														$cdate = date('d M Y \A\t h:i A', strtotime($res['StartApprovalDateTime']));

														$datetime1 = new DateTime($res['EndApprovalDateTime']);
														$datetime2 = new DateTime($res['StartApprovalDateTime']);
														$interval = $datetime1->diff($datetime2);
														$cduration = $interval->format('%H').":".$interval->format('%I');
											?>
												<tr>
													<td><?php echo $ressqluser['vUserName']; ?></td>
													<td><?php echo $cdate; ?></td>
													<td><?php echo $cduration." Hr"; ?> </td>
													<td><?php echo $res['vTopicToDiscuss']; ?></td>
												</tr>
												<?php
													}
													if($page>1){
														echo"<tr><td colspan='4' class='text-right'>Page : ";
														 for($i=1; $i<=$page; $i++){
															if($i==($curpage+1)){
																echo "<b>$i</b>";
															}else{
																$str=""; $j = $i-1;
																echo "<a href='bookchattime.php?curpage=$j'><b>$i</b></a>";
															}									
														 }
														echo "</td></tr>";
													}
												}else{
													echo "<tr><td colspan='4'><p class='font-bold text-center mt-3'>NO FILE FOUND</p></td></tr>";
												}
											?>
										</tbody>
									</table>
								</div>
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