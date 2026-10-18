
		<form method='POST' enctype='multipart/form-data'>
		<table>
		<tbody>
		
		
		
		<tr>
		<td>
		<select name='media_to_del' size='20'>
		<?
		$list = wiew_get_sources();
		foreach ($list as $media)
			echo "<option value='$media'>$media</option>";
		unset($list);
		?>
		</select>
		</td>
		
		<td valign=\"top\">
		Media name: <input name='title' type='text'>
		Left video file: <input name='lv_source' type='file'>
		Right video file: <input name='rv_source' type='file'>
		Audio file: <input name='a_source' type='file'>
		<button name='media_upload' type='submit'>Upload</button>
		
		
		<button name='media_delete' type='submit'>Delete</button>
		</td>
		</tr>
		
		</tbody>
		</table>
		</form>
<?
//Code:
/*
	   This routine will upload all files needed and move them in the media
	   repository. This routine requires the following variables:
	   - $_FILES['lv_source']
	   - $_FILES['rv_source']
	   - $_FILES['a_source']
	   - $_POST['title']
	   
	   Audio source is not required. The directory will be created under $GLOBALS['media_prefix'] using the title
	   specified. Uploaded file will be named:
	   - LVIDEO.mpg for left video source.
	   - RVIDEO.mpg for right video source.
	   - AUDIO.wav for audio source (if any).
	 */
	function wiew_media_upload() {
		global $errdescr;

		/* Check variables */
		if (strlen($_POST['title']) == 0) {
			$errdescr = "You haven't specified the media title.";
			utils_show_error($errdescr);
			return (FALSE);
		}
		if (strlen($_FILES['lv_source']['tmp_name']) == 0) {
			$errdescr = "You haven't specified the left video source.";
			utils_show_error($errdescr);
			return (FALSE);
		}
		if (strlen($_FILES['rv_source']['tmp_name']) == 0) {
			$errdescr = "You haven't specified the right video source.";
			utils_show_error($errdescr);
			return (FALSE);
		}
		
		if (!is_uploaded_file($_FILES['lv_source']['tmp_name'])) {
			$errdescr = "Failed to upload files (left video).";
			utils_show_error($errdescr);
			return (FALSE);
		}
		if (!is_uploaded_file($_FILES['rv_source']['tmp_name'])) {
			$errdescr = "Failed to upload files (right video).";
			utils_show_error($errdescr);
			return (FALSE);
		}
		if ((strlen($_FILES['a_source']['tmp_name']) > 0) && !is_uploaded_file($_FILES['a_source']['tmp_name'])) {
			$errdescr = "Failed to upload files (audio).";
			utils_show_error($errdescr);
			return (FALSE);
		}

		/* Check whether destination directory exists */
		$GLOBALS['media_prefix'] = "./upload/";
		$mediadir = trim($GLOBALS['media_prefix'].$_POST['title']);
		//$mediadir = "./flyer/".$_POST['title']);
		if (is_dir($mediadir)) {
			$errdescr = "Media already uploaded.";
			utils_show_error($errdescr);
			return (FALSE);
		}

		/* Create media directory */
		if (!mkdir($mediadir)) {
			$errdescr = "Failed to create media directory.";
			utils_show_error($errdescr);
			return (FALSE);
		}

		/* Upload files */
		print "<pre>";
		/* Upload and move files to the correct position */
		if (!move_uploaded_file($_FILES['lv_source']['tmp_name'], $mediadir."/LVIDEO.mpg")) {
			$errdescr = "Generic upload error.";
			utils_show_error($errdescr);
			
			wiew_media_delete($_POST['title']);
			return (FALSE);
		}
		if (!move_uploaded_file($_FILES['rv_source']['tmp_name'], $mediadir."/RVIDEO.mpg")) {
			$errdescr = "Generic upload error.";
			utils_show_error($errdescr);
			
			wiew_media_delete($_POST['title']);
			return (FALSE);
		}
		if (strlen($_FILES['a_source']['tmp_name']) > 0) {
			if (!move_uploaded_file($_FILES['a_source']['tmp_name'], $mediadir."/AUDIO.wav")) {
				$errdescr = "Generic upload error.";
				utils_show_error($errdescr);
				
				wiew_media_delete($_POST['title']);
				return (FALSE);
			}
		}
		print "</pre>";
		
		$errdescr = "";
		
		return (TRUE);
	}		
?>