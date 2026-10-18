<?php
	header("Location: ../tmsnew/career_progress.php");
	exit;
	include 'dbConnection.php';
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	if (!isset($_SESSION['user_id'])) {
		header('Location:../user_login.php');
		exit;
	}

	function getlearnernames($ids)
	{
		$strnames = '';
		if ($ids) {
			$strids = explode(',', $ids);
			for ($i = 0; $i < count($strids); $i++) {
				$sqlselect = 'select vUserName from cpo_usermaster where iUserId=' . $strids[$i];
				$rssqlselect = runquery($sqlselect);
				if (isset($rssqlselect)) {
					$rssqlselect1 = mysqli_fetch_array($rssqlselect);
					$strnames = $strnames . $rssqlselect1[0] . ' , ';
				}
			}
			$strnames = substr($strnames, 0, strlen($strnames) - 2);
		}

		return $strnames;
	}

	function getIcon($filename)
	{
		switch (substr($filename, strlen($filename) - 3, strlen($filename))) {
			case 'swf':
				return 'images/swf.gif';
			case 'doc':
				return 'images/doc.gif';
			case 'jpg':
				return 'images/jpg.gif';
			case 'peg':
				return 'images/jpg.gif';
			case 'gif':
				return 'images/gif.gif';
			case 'pdf':
				return 'images/pdf.gif';
			case 'ppt':
				return 'images/ppt.gif';
			case 'xls':
				return 'images/xls.gif';
			case 'avi':
				return 'images/avi.gif';
			case 'mpg':
				return 'images/mpeg.gif';
			default:
				return 'images/gif.gif';
		}
	}

	$careers_page_title = 'Upload portfolio file';
	$careers_breadcrumb_current = 'Upload portfolio file';
	$careers_extra_head = <<<'HTML'
<script>
function getconfirm() {
	return confirm("Are you sure you want to delete this file?");
}
function validation() {
	if (document.FRMUPLOADFILE.userfile.value === "") {
		alert("Please select file !");
		return false;
	}
	var flag = 0;
	var file = document.FRMUPLOADFILE.userfile.value.split("\\");
	for (var j = 0; j < files.length; j++) {
		if (files[j][1] === file[file.length - 1]) {
			flag = 1;
		}
	}
	if (flag === 1) {
		var cn = confirm("File already uploaded ! Do you want to overwrite");
		return cn;
	}
	return true;
}
</script>
HTML;
	require __DIR__ . '/careers_lte_layout_start.php';
?>

<div class="row">
	<div class="col-12">
		<div class="card card-primary card-outline mb-4">
			<div class="card-header">
				<h3 class="card-title">Upload files</h3>
			</div>
			<div class="card-body">
				<form name="FRMUPLOADFILE" enctype="multipart/form-data" method="POST" onsubmit="return validation();" action="UpFiles_portfolio.php?next=1">
					<?php
					if (isset($_GET['next']) && $_GET['next'] == 1) {
						if (isset($_POST['CMBLEARNER']) && count($_POST['CMBLEARNER']) < 1) {
							echo '<script>alert(\'Please select learner first\');document.location = "UpFiles_portfolio.php";</script>';
						}
						if (!empty($_FILES['userfile']['type']) && (
							$_FILES['userfile']['type'] == 'application/x-shockwave-flash' ||
							$_FILES['userfile']['type'] == 'image/pjpeg' ||
							$_FILES['userfile']['type'] == 'application/msword' ||
							$_FILES['userfile']['type'] == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
							$_FILES['userfile']['type'] == 'application/pdf' ||
							$_FILES['userfile']['type'] == 'image/gif' ||
							$_FILES['userfile']['type'] == 'application/octet-stream' ||
							$_FILES['userfile']['type'] == 'application/vnd.ms-powerpoint' ||
							$_FILES['userfile']['type'] == 'application/vnd.ms-excel' ||
							$_FILES['userfile']['type'] == 'video/avi' ||
							$_FILES['userfile']['type'] == 'video/mpeg'
						)) {
							if (!file_exists('./upload/' . $_SESSION['user_id'])) {
								mkdir('./upload/' . $_SESSION['user_id'], 0755);
							}
							$uploaddir = '/home/eafbbabd/public_html/app/tms/upload/' . $_SESSION['user_id'] . '/';
							$uploadfile = $uploaddir . $_FILES['userfile']['name'];
							move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
							$UserId = '';
							foreach ($_POST['CMBLEARNER'] as $value) {
								$UserId = $UserId . $value . ',';
							}
							$UserId = substr($UserId, 0, strlen($UserId) - 1);
							$sqladd = "insert into cpo_uploadfilestutor(iUserId,iTutorId,vFilePath,vUploadDate,file_type) values ('" . $UserId . "'," . $_SESSION['user_id'] . ",'" . mysqli_real_escape_string($conn, $_FILES['userfile']['name']) . "','" . date('Y-m-d') . "','portfolio_upload')";
							runquery($sqladd);
							$qry = 'select max(iFileId) from cpo_uploadfilestutor';
							$rsqry = runquery($qry);
							$numq = isset($rsqry) ? mysqli_num_rows($rsqry) : 0;
							if ($numq > 0) {
								$resqry = mysqli_fetch_array($rsqry);
								$iFileId = $resqry[0];
								foreach ($_POST['CMBLEARNER'] as $value) {
									$sqladdnew = 'insert into cpo_uploadfilesviewed (iFileId, iUserId) values (' . (int) $iFileId . ',' . (int) $value . ')';
									runquery($sqladdnew);
								}
							}
						}
					}
					$sqlfiles = "select vFilePath from cpo_uploadfilestutor where iTutorId=" . (int) $_SESSION['user_id'] . " and file_type='portfolio_upload'";
					$rsfiles = runquery($sqlfiles);
					echo "<script>var files = [];";
					$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0;
					if ($num > 0) {
						$i = 0;
						while ($rsdata = mysqli_fetch_array($rsfiles)) {
							echo 'files[' . $i . ']= new Array(2);';
							echo 'files[' . $i . '][0]= 0;';
							echo "files[" . $i . "][1]= '" . addslashes($rsdata['vFilePath']) . "';";
							$i++;
						}
					}
					echo '</script>';
					$sqllearner = 'select iUserId,vUserName from cpo_usermaster ';
					$rslearner = runquery($sqllearner);
					$nlearn = $rslearner ? mysqli_num_rows($rslearner) : 0;
					?>
					<div class="mb-3">
						<label class="form-label">Select learner(s)</label>
						<select name="CMBLEARNER[]" class="form-select" multiple size="6">
							<?php
							if ($nlearn > 0) {
								while ($rsdata = mysqli_fetch_array($rslearner)) {
									echo '<option value="' . (int) $rsdata['iUserId'] . '">' . htmlspecialchars($rsdata['vUserName'], ENT_QUOTES, 'UTF-8') . '</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Upload file</label>
						<input type="file" name="userfile" id="userfile" class="form-control" size="50">
					</div>
					<p class="text-danger small">(Only *.pdf, *.doc, *.xls, *.ppt, *.swf, *.gif, *.jpeg, *.avi, *.mpeg files can upload)</p>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
$sqlfiles = "select vFilePath,vUploadDate,iFileId,iUserId from cpo_uploadfilestutor where iTutorId=" . (int) $_SESSION['user_id'] . " and file_type='portfolio_upload' order by vUploadDate desc";
$rsfiles = runquery($sqlfiles);
$num = $rsfiles ? mysqli_num_rows($rsfiles) : 0;
if ($num > 0) {
	?>
<div class="row">
	<div class="col-12">
		<div class="card card-outline">
			<div class="card-header">
				<h3 class="card-title">Uploaded files</h3>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table table-striped table-hover mb-0">
						<thead>
							<tr>
								<th>File</th>
								<th>Date</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($rsdata = mysqli_fetch_array($rsfiles)) {
								$path = './upload/' . $_SESSION['user_id'] . '/' . $rsdata['vFilePath'];
								?>
							<tr>
								<td><a target="_blank" href="<?php echo htmlspecialchars($path, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($rsdata['vFilePath'], ENT_QUOTES, 'UTF-8'); ?></a></td>
								<td><?php echo htmlspecialchars(gdate($rsdata['vUploadDate']), ENT_QUOTES, 'UTF-8'); ?></td>
								<td class="text-center"><a target="_blank" href="<?php echo htmlspecialchars($path, ENT_QUOTES, 'UTF-8'); ?>"><img src="<?php echo htmlspecialchars(getIcon($rsdata['vFilePath']), ENT_QUOTES, 'UTF-8'); ?>" alt=""></a></td>
								<td class="text-center"><a href="UpFilesDeleted.php?id=<?php echo (int) $rsdata['iFileId']; ?>" onclick="return getconfirm();"><img src="images/delete.gif" alt="Delete" style="cursor:pointer" width="16" height="16"></a></td>
							</tr>
							<tr>
								<td colspan="4" class="text-muted small"><strong>Uploaded for</strong> — <?php echo htmlspecialchars(getlearnernames($rsdata['iUserId']), ENT_QUOTES, 'UTF-8'); ?></td>
							</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
}
require __DIR__ . '/careers_lte_layout_end.php';
