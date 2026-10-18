<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Personal Development<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<?php
if(isset($_GET['did'])){
	$comment	= $_POST['txttcomments'];
	$insql = "update cpo_detention set T_tcomments  ='".$comment."' where I_detentionid =".$_GET['did'];
	$ininfo=runquery($insql);
	if($ininfo){
		header("Location: personaldev");
	}else{
		$msg = "Sorry comment cannot be inserted";
		$flg = "red";
	}
}
?>
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
									<div class="col-md-2">
									</div>
									<div class="col-md-8">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body text-center">
													<h5 class="mb-4">Personal Development<span class="text-sm text-info d-block">Select Reports to View</span></h5>
													<form name="frm_report" method="post" action="">
														<fieldset class="form-group">
															<select class="form-select" name="cmbmonth" onChange="get_report(this.value)">
																<option selected disabled>Select Monthly Progress Report</option>
																<?php
																	$monthlist = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "August", "November", "December");
																	foreach($monthlist as $month){
																		echo"<option value='$month'>$month Report</option>";
																	}
																?>
															</select>
														</fieldset>													  
													</form>
													<div id="report"><div id="id_report"></div></div>

													<form name="cmbdeten" onChange="get_deten(this.value,'D')">
														<fieldset class="form-group">
															<select class="form-select" name="cmbmonth" onChange="get-detention(this.value,'D')">
																<option value="" selected>Detention Record</option>
																 <?php 
																	$sqldet="SELECT * FROM cpo_detention where  C_flag='D' and I_userid  =".$_SESSION['user_id']." order by I_detentionid";
																	$resdet=runquery($sqldet);
																	$countdet = mysqli_num_rows($resdet);
																	for($i=0;$i<$countdet;$i++){
																		$rsdet = mysqli_fetch_array($resdet);
																		echo "<option value='".$rsdet['I_detentionid']."'>".$rsdet['V_reason']."</option>";
																	}
																 ?>
															</select>
														</fieldset>													  
													</form>
													<div id="show_det"><div id="id_deten"></div></div>

													<form name="frm_exec" method="post" action="">
														<fieldset class="form-group">
															<select class="form-select" name="cmbmonth" onChange="get-detention(this.value,'E')">
																<option value="" selected>Exclusion Record</option>
																<?php 
																	$sqldet="SELECT * FROM cpo_detention where  C_flag='E' and I_userid  =".$_SESSION['user_id']." order by I_detentionid";
																	$resdet=runquery1($sqldet);
																	$countdet = mysqli_num_rows($resdet);
																	for($i=0;$i<$countdet;$i++){
																		$rsdet = mysqli_fetch_array($resdet);
																		echo "<option value='".$rsdet['I_detentionid']."'>".$rsdet['V_reason']."</option>";
																	}
																?>
															</select>
														</fieldset>													  
													</form>
													<div id="show_exc"><div id="id_exc"></div></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2">
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
		function hidevreport(){
			document.getElementById('report').style.display = 'none';
		}

		function openreport(obj){
			var new1=window.open("get-progress-detail?id="+obj,"",'height=300,width=600,scrollbars=yes,top=50 left=150');
			return true;
		}

		function hide(f){
			if(f == 'D'){
				document.getElementById('show_det').style.display = 'none';
			}else{
				document.getElementById('show_exc').style.display = 'none';
			}
		}

		function get_report(id){
			var xmlHttp;
			try{
				// Firefox, Opera 8.0+, Safari
				xmlHttp=new XMLHttpRequest();
			}catch (e){
				// Internet Explorer
				try{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}catch (e){
					try{
						xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					}catch (e){
						alert("Your browser does not support AJAX!");
						return false;
					}
				}
			}
			if(id !=''){		
				var query = "get-report?id="+id;
			}else{
				document.getElementById('id_report').style.display='none';
				document.getElementById('report').style.display='none';
				return false;
			}
			xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					var number1 = xmlHttp.responseText;
					document.getElementById('report').style.display = '';
					document.getElementById('id_report').style.display='';
					document.getElementById('id_report').innerHTML= number1;
				}
			}
			xmlHttp.open("GET",query,true);
			xmlHttp.send(null);
		}

		function valid_deten(){
			if(document.frmhw.txttcomments.value == ''){
				alert('Please enter your comments');
				document.frmhw.txttcomments.focus();
				return false;
			}
		}

		function get_deten(id,flag){
			var xmlHttp;
			try{
				// Firefox, Opera 8.0+, Safari
				xmlHttp=new XMLHttpRequest();
			}catch (e){
				// Internet Explorer
				try{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}catch (e){
					try{
						xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					}catch (e){
						alert("Your browser does not support AJAX!");
						return false;
					}
				}
			}
			if(!isNaN(id) && id!=''){
				var query = "getdetention?id="+id+"&flag="+flag;
			}
			else{
				if(id=='' && flag == 'E'){
					document.getElementById('show_exc').style.display='none';
					return false;
				}else{
					document.getElementById('show_det').style.display='none';
					return false;
				}			
			}
			if(!isNaN(id) && id!=''){
				var query = "get-detention?id="+id+"&flag="+flag;
			}else{
				document.getElementById('show_det').style.display='none';
				document.getElementById('show_exc').style.display='none';
				return false;
			}
			xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
					var number1 = xmlHttp.responseText;
					if(flag == 'D'){
						document.getElementById('show_det').style.display = '';
						document.getElementById('id_deten').style.display='';
						document.getElementById('id_deten').innerHTML= number1;
					}else{
						document.getElementById('show_exc').style.display = '';
						document.getElementById('id_exc').style.display='';
						document.getElementById('id_exc').innerHTML= number1;
					}				
				}
			}
			xmlHttp.open("GET",query,true);
			xmlHttp.send(null);
		}
	</script>
</body>

</html>