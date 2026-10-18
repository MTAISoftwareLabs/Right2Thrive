<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Download Course Work<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>My E-Portfolio</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
						<div class="tab-content card-header">
							<div class="tab-pane fade active show" id="uploadphoto" role="tabpanel" aria-labelledby="uploadphoto-tab">
								<div class="row">
									<div class="col-md-3">
									</div>
									<div class="col-md-6">
										<h5 class="text-center">Download Course Work</h5>
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body text-center">
												<h6>Select Tutor</h6>
													<form class="" name="FRMUPLOAD" method="post">
													  <div class="form-group">
													  	<div class="input-group">
															<select name="CMBLEARNER" class="form-select" onChange="submitpage()">
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
																	}
																	if($nos>0){
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
																			}if($nos>0){
																				//$firstid ='';									
																				while($result_tutor = mysqli_fetch_array($result_tutor_info)){
																					if(isset($_POST['CMBLEARNER'])){
																						if($_POST['CMBLEARNER']==$result_tutor['iUserId']){
																							echo "<option value=".$result_tutor['iUserId']." selected>".$result_tutor['vUserName']."</option>";												
																						}else{
																							echo "<option value=".$result_tutor['iUserId'].">".$result_tutor['vUserName']."</option>";												
																						}
																					}else{
																						if($firstid==''){
																							echo "<option value=".$result_tutor['iUserId']." selected>".$result_tutor['vUserName']."</option>";
																						}else{
																							echo "<option value=".$result_tutor['iUserId'].">".$result_tutor['vUserName']."</option>";
																						}
																					}if($firstid==''){
																						$firstid = $result_tutor['iUserId'];
																					}
																				}									
																			}
																		}
																	}
																	else{
																		echo "<option selected>No Tutor Exists</option>";
																	}
																?>
															</select>
														</div>
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
									<table class="table table-hover mb-0">
										<thead class="dark">
											<tr>
												<th colspan="3" class="text-center"><h5 class="text-white mt-2">Uploaded Files by Tutor</h5></th>
											</tr>
										</thead>
										<tbody>											
											<?php
												$tid = 0;
												$tid = isset($_GET['id'])?$_GET['id']:$firstid;
												$sqlfiles = "select iFileId,vFilePath,vUploadDate from cpo_uploadfilestutor where iTutorId=".$tid." and iUserId like '%".$user_id."%' order by vUploadDate desc";
												$rsfiles = runquery($sqlfiles);
												$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0 ;
												if ( $num > 0 ){
													foreach($rsfiles as $rsdata){
											?>
											<tr>
												<td><a href="#" onClick="javascript:getnewwin('<?php echo $path;?>','<? echo $rsdata['iFileId'];?>');"><?php echo $rsdata['vFilePath'];?></a></td>
												<td><?php echo gdate($rsdata['vUploadDate']);?></td>
												<td class="text-center"><a href="#" class="show-ftype" onClick="javascript:getnewwin('<?php echo $path;?>','<?php echo $rsdata['iFileId'];?>');"><img src="<?php echo getIcon($rsdata['vFilePath'])?>"></a></td>
											</tr>
											<?php
													}
												}else{
													echo "<tr><td colspan='4'><p class='font-bold text-center mt-3'>No Files Uploaded</p></td></tr>";
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
		function getnewwin(obj,fid){
			new1=window.open("viewdownload.php?id="+obj+"&fid="+fid);
		}
		function submitpage(){
			if (document.FRMUPLOAD.CMBLEARNER.value != "0"){
				document.FRMUPLOAD.action = "DownFiles.php?next=1&id="+document.FRMUPLOAD.CMBLEARNER.value;
				document.FRMUPLOAD.submit();
			}	
		}	
	</script>
</body>

</html>