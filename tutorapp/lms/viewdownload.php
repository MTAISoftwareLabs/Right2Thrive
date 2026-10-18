<?
include_once 'dbConnection.php';
$fileid = $_GET['fid'];
$filesrc = $_GET['id'];
$upqry="delete from cpo_uploadfilesviewed where iFileId=".$fileid." AND iUserId=".$_SESSION['user_id'];
runquery($upqry);
?>
<script language="JavaScript">
window.location='../tms/upload/<? echo $filesrc;?>';
</script>