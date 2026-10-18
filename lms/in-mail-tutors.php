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
$hub_interactive_tab = 'mail';
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
                <p class="hub-page-sub mb-0">Message your tutor, book a chat, and download resources from one place.</p>
            </div>
            <div class="page-content">
				<?php include "in-section-chat.php"; ?>
                <section class="row">
                    <div class="col-12">
						<?php include "in-interactive-tabs.php"; ?>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="mail-tutors" role="tabpanel" aria-labelledby="mail-tutors-tab">
								<h5 class="hub-panel-title mb-3">Send mail to your tutor</h5>
								<p class="text-secondary small mb-4">Choose your tutor, add a clear subject line, then send your message. Your tutor will reply using the contact details on file.</p>
								<div class="row">
									<div class="col-md-12">
										<div class="card frm-border hub-mail-tutor-card border-0">											
											<div class="card-content">
												<div class="card-body p-0">

													<div class="col-md-12 form-section p-0">
														  <form name="FRMUPLOADFILE" method="post" action="in-mail-tutors.php" novalidate>
														    <?php
																if(isset($_POST['send'])){
																	$learners = array();
																	if (isset($_POST['CMBLEARNER'])) {
																		$learners = is_array($_POST['CMBLEARNER']) ? $_POST['CMBLEARNER'] : array($_POST['CMBLEARNER']);
																	}
																	$learner_id = "";
																	foreach($learners as $value){
																		$learner_id .= $value . ",";
																	}
																	$learner_id = rtrim($learner_id, ",");
																	if ($learner_id !== "" && $learner_id !== "-"){
																		$fromname=$_SESSION['user_name'];
																		$subject=$_POST['txtsubject'];
																		$message=$_POST['txtcontents'];
																		foreach($learners as $value){
																			$idname =explode(',',$value);								  
																			$toname=$idname[1];
																			$toaddress=$idname[0];
																			$mailflg=SendingMail($fromname, admin_email,$toname ,$toaddress, $subject, $message);
																		}
																		echo "<div class='alert alert-success text-center shadow-sm' role='alert'>Mail sent to your tutor successfully.</div>";
																	}else{
																		echo "<div class='alert alert-danger text-center shadow-sm' role='alert'>Please select a tutor before sending.</div>";
																	}
																}
														    ?>
															<div class="row g-3">
																<div class="col-md-12">
																	<fieldset class="form-group mb-0">
																		<label class="form-label" for="tutor">Tutor</label>
																		<select name="CMBLEARNER[]" class="form-select" id="tutor" required>
																			<option value="" selected disabled>Select a tutor</option>
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
															<div class="row g-3">
																<div class="col-md-12">
																	<fieldset class="form-group mb-0">
																	  <label class="form-label" for="mailsebject">Subject</label>
																	  <input type="text" class="form-control" id="mailsebject" name="txtsubject" required autocomplete="off">
																	</fieldset>
																</div>
															</div>
															<div class="row g-3">
																<div class="col-md-12">
																	<fieldset class="form-group mb-0">
																	  <label class="form-label" for="mailcontent">Your message</label>
																	  <textarea class="form-control" rows="6" id="mailcontent" name="txtcontents" required ></textarea>				  
																	</fieldset>
																</div>
															</div>
															<div class="row g-3">
																<div class="col-md-12 text-end">
																	<button type="submit" name="send" id="sendmail" class="btn btn-primary"><i class="bi bi-send-fill me-1" aria-hidden="true"></i> Send</button>
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
			function syncMailFormState(){
				var ok = $("#tutor").val() && $("#tutor").val() !== "";
				$("#sendmail").prop("disabled", !ok);
				$("#mailsebject").prop("disabled", !ok);
				$("#mailcontent").prop("disabled", !ok);
			}
			$("#tutor").on("change", syncMailFormState);
			syncMailFormState();
		});
		
		function chatnow(){
			new1=window.open("../chatnew/","","titlebar='CareerPaths Online - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
		}
	</script>
</body>

</html>