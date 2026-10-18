<?php
	include_once 'dbConnection.php';

	if($_GET['flag'] == 'D'){
		$flag = 'Detention';
	}else{
		$flag = 'Exclusion';
	}
	$sql="SELECT * FROM cpo_detention where I_detentionid=".$_GET['id'];
	$rID=runquery1($sql);
	if(isset($rID)){
		$result_info = mysqli_fetch_array($rID);
	}
?>
<h6 class="text-info text-left">Detention Report</h6>
<div class="table-responsive text-left">
	<form name="frmhw" method="post" action="eps-personal-development.php?did=<?php echo $_GET['id']?>" onSubmit="return valid_deten()">
		<input type="hidden" name="hdn_det" value="1">
		<table class='table border mb-4'>
			<tbody>
				<tr> 
					<th>Date</th><td><?php $date = explode('-', $result_info['D_detention']); echo $date[2]."/".$date[1]."/".$date[0];?></td>
				</tr>
				<tr> 
					<th>Reason</th><td><?php if( $result_info['V_reason'] != '') { echo ucfirst($result_info['V_reason']);} else { echo "-";} ?></td>
				</tr>
				<tr><th colspan="2">What do I need to improve?</th></tr>
				<tr><td colspan="2"><?php if( $result_info['T_improve'] != '') {  echo ucfirst($result_info['T_improve']); } else {echo "-"; } ?></td></tr>
				<tr><th colspan="2">Tutor  Comments</th></tr>
				<tr><td colspan="2"><? if( $result_info['T_tcomments'] != '') {  echo ucfirst($result_info['T_tcomments']);  } else { echo "-";} ?> </td></tr>
				<tr><th colspan="2">Student Comments</td></tr>
				<tr><td colspan="2"><? if($result_info['T_scomments'] != ''){echo $result_info['T_scomments'];}else { ?> <textarea name="txttcomments" cols="60" rows="3"></textarea><?}?></td></tr>
				<tr><th colspan="2">Parent Comments</td></tr>
				<tr><td colspan="2"><? if($result_info['T_pcomments'] != ''){echo $result_info['T_pcomments'];}else { echo "-"; }?></td></tr>
			</tbody>
		</table>
	</form>
</div>