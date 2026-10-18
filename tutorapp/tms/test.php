<?php
//post_max_size
ini_set("upload_max_filesize","100M");
echo 'upload_max_filesize = ' . ini_get('upload_max_filesize') . "\n";
?>
<form enctype="multipart/form-data" action="upload.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="200000000" />
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
