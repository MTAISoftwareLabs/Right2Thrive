<?php
include_once 'dbConnection.php';
?>
<html>
    <head>
        <title>File Upload</title>
		<link href="css/adminstyle.css" rel="stylesheet" type="text/css">

        <script language="javascript">
            function ca()
            {
                var linkval;
                linkval=document.all("imgfile").value;
                window.opener.document.all("phptopath").value=linkval;
                document.frmaddphoto.submit();
                window.close();
            }
        </script>
    
<link href="css/adminstyle.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF">
 
		<form name="frmaddphoto" action="tmpupload1.php?post=yes" method="POST" enctype="multipart/form-data">

<?php
        if (isset($_GET['post']) == "yes")
        {
			$filedir = './flash/'; // the directory for the original image 
    	    $userfile_name = $_POST['idval'].".jpg";
			
       		$userfile_tmp = $_FILES['flashfile']['tmp_name']; 
			
		    if (isset($_FILES['flashfile']['name']))  
       		{ 
           		$prod_img = $filedir.$userfile_name; 
           		move_uploaded_file($userfile_tmp, $prod_img); 
				echo "uploaded";
				die();
//           		$sizes = getimagesize($prod_img); 
       		} ?>
			<script language="JavaScript">
				window.close();
			</script>
<?php       }
?>

    <input type="hidden" name="MAX_FILE_SIZE" value="500000000">
	<center>
    <table width="90%" align="center" cellpadding="1"  cellspacing="1" class="redborder">
 	<tr>
		<td colspan="2">
			<table width="100%" align="center" cellpadding="1" cellspacing="1" class="table">
				<tr><td height="18" colspan="5" bgcolor="FF0000" class="headingtd">&nbsp;&nbsp;Uploading Flash Files</td></tr>
    			<tr> 
        			
            <td width="28%" class="bgyellow">&nbsp;Upload Image:</td>
        			<td width="72%" class="whittd2"><input type="file" id="imgfile" name="flashfile" class="flattextbox_large"></td>
    			</tr>
      			<tr>
        			
      			</tr>
      				<font size="2" face="verdana"><b> Click browse to upload a local file </b></font><br>
      				<br>
      			<tr> 
        			<td  class="whittd2" colspan="2" align="center"><div align="center"> 
            			<input src="images/upload.gif" type="image">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="hidden" name="idval" value="<?php echo $_GET['id'];?>">
            			<input type="image" src="images/close.gif" onClick="javascript: window.close();">
          				</div>
					</td>
      			</tr>
	  		</table>
		</td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>	
</table>
		</form>
		
</body>
</html>
<?php

/*== FUNCTIONS ==*/
    function getFileExtension($str)
    {
        $i = strrpos($str,".");
        if (!$i)
        {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
?>
