<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Send Mail to Tutors<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<?php
	function getlearnernames($ids){
		$strnames = '';
		if($ids){	
			$strids = explode(',',$ids);		
			for($i=0;$i<count($strids);$i++){
				$sqlselect = "select vUserName from cpo_usermaster where iUserId=".$strids[$i];
				//echo $sqlselect.'<br>';
				$rssqlselect = runquery($sqlselect);
				if(isset($rssqlselect)){
					$rssqlselect1 = mysqli_fetch_array($rssqlselect);
					$strnames = $strnames.$rssqlselect1[0].' , ';
				}
			}
			$strnames = substr($strnames,0,strlen($strnames)-2);
		}
		return $strnames;
	}
?>
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
								<a class="nav-link active" id="mail-tutors-tab" href="in-mail-tutors" role="tab" aria-controls="mail-tutors" aria-selected="true"><i class="fa fa-envelope-o" aria-hidden="false"></i> Mail To Tutor</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="event-history-tab" href="in-event-history" role="tab" aria-controls="event-history" aria-selected="false"><i class="fa fa-history" aria-hidden="true"></i> Event History</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="mail-tutors" role="tabpanel" aria-labelledby="mail-tutors-tab">
								<h5>Send Mail to Tutors</h5>															
								<div class="row">
									<div class="col-md-12">
										<div class="card frm-border">											
											<div class="card-content">
												<div class="card-body">

													<div class="col-md-12 form-section">
														  <form name="FRMUPLOADFILE" method="post" action="in-mail-tutors">
														    <?php
																if(isset($_POST['send'])){
																	$learner_id = "";	
																	foreach($_POST['CMBLEARNER'] as $value){
																		$learner_id.= $value. ",";
																	}
																	$learner_id = substr($learner_id,0,strlen($learner_id)-1);
																	if ($learner_id <> "-"){
																		$fromname=$_SESSION['user_name'];
																		$subject=$_POST['txtsubject'];
																		$message=$_POST['txtcontents'];
																		foreach($_POST['CMBLEARNER'] as $value){
																			$idname =explode(',',$value);								  
																			$toname=$idname[1];
																			$toaddress=$idname[0];
																			$mailflg=SendingMail($fromname, admin_email,$toname ,$toaddress, $subject, $message);
																		}
																		echo "<div class='alert alert-success text-center' role='alert'>Mail Sent to Tutor Successfully.</div>";
																	}else{
																		echo "<div class='alert alert-danger text-center' role='alert'>Please first select Tutor!!</div>";
																	}
																}
														    ?>
															<div class="row">
																<div class="col-md-12">
																	<fieldset class="form-group">
																		<select name="CMBLEARNER[]" class="form-select" id="tutor">
																			<option value="" disabled>Select Tutor</option>
																			<?php
																				$sqllearner = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
																				$rslearner = runquery($sqllearner);
																				$num = $rslearner ? mysqli_num_rows($rslearner) : 0 ; 
																				$query_tutor_id = "select vTutorId from cpo_usercourse where vTutorId<>0 and iUserId = ".$user_id;
																				$result_tutor_id = runquery($query_tutor_id);
																				$nos = 0;
																				//***CHANGE BY ALPA BECAUSE OF ERROR ON LINE NO 169***//
																				$firstid ='';
																				//***CHANGE COMPLETE***//
																				if($result_tutor_id){
																					$nos = mysqli_num_rows($result_tutor_id);
																				}if($nos>0){
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
																						$query_tutor_info = "select vUserEmailId,vUserName from cpo_usermaster where iUserId in (".$tutor_ids.")";
																						$result_tutor_info = runquery($query_tutor_info);
																						$nos = 0;
																						if($result_tutor_info){
																							$nos = mysqli_num_rows($result_tutor_info);
																						}
																						if($nos>0){
																							while($result_tutor = mysqli_fetch_array($result_tutor_info)){
																								if(isset($_POST['CMBLEARNER'])){
																									if($_POST['CMBLEARNER']==$result_tutor['iUserId']){
																										echo "<option value=".$result_tutor['vUserEmailId'].",".$result_tutor['vUserName'].">". $result_tutor['vUserName']."</option>";
																									}
																									else{
																										echo "<option value=".$result_tutor['vUserEmailId'].",".$result_tutor['vUserName'].">".$result_tutor['vUserName']."</option>";
																									}
																								}else{
																									if($firstid==''){
																										echo "<option value=".$result_tutor['vUserEmailId'].",".$result_tutor['vUserName'].">".$result_tutor['vUserName']."</option>";
																									}else{
																										echo "<option value=".$result_tutor['vUserEmailId'].",".$result_tutor['vUserName'].">".$result_tutor['vUserName']."</option>";
																									}
																								}
																								if($firstid==''){
																									$firstid = $result_tutor['iUserId'];
																								} 
																							} 
																						} 
																					}
																				}else{
																					echo "<option value='' selected>No Tutor Exists For Selection</option>";
																				}																		
																			?>
																		</select>
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<fieldset class="form-group">
																	  <label for="mailsebject">Subject</label>
																	  <input type="text" class="form-control" rows="3" id="mailsebject" name="txtsubject" required disabled>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12">
																	<fieldset class="form-group">
																	  <label for="mailcontent">Your Message</label>
																	  <textarea class="form-control" rows="6" id="mailcontent" name="txtcontents" required disabled></textarea>				  
																	</fieldset>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12 text-right">
																	<button type="submit" name="send" id="sendmail" class='btn btn-primary' disabled>Send</button>
																</div>
															</div>
														  </form>
													</div>													
												</div>
											</div>
										</div>
									</div>
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
				$("#sendmail").attr("disabled", false);
				$("#mailsebject").attr("disabled", false);
				$("#mailcontent").attr("disabled", false);
			}else{
				$("#sendmail").attr("disabled", true);
				$("#mailsebject").attr("disabled", true);
				$("#mailcontent").attr("disabled", true);
			}
		  });
		});
		
		function chatnow(){
			new1=window.open("../chatnew/","","titlebar='CareerPaths Online - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
		}
	</script>
</body>

</html>