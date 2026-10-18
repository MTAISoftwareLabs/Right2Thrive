<?php
    include "dbConnection.php";
    if (!isset($_SESSION['user_id']))
    {
        header("Location:../user_login.php");
    }

    if(isset($_GET['id']))
	{
        
		$id=$_GET['id'];
		
		$qry="select * from cpo_uploadfilestutor where iFileId=".$id;
		$rsfile=runquery($qry);
		if($rsfile)
		{
			$numrows=mysqli_num_rows($rsfile);
			if($numrows>0)
			{
				$res_file=mysqli_fetch_array($rsfile);
				if($res_file)
				{
					$filename=$res_file['vFilePath'];
					$tutorid=$res_file['iTutorId'];
				}
			}
		}
		
		$qry="delete from cpo_uploadfilestutor where iFileId=".$id;
		$res=runquery($qry);
		$qry="delete from cpo_uploadfilesviewed where iFileId=".$id;
		$res=runquery($qry);		
		if($res)
		{
			
			if(file_exists("upload/".$tutorid."/".$filename))
			{
				unlink("upload/".$tutorid."/".$filename);
			}
			$msg="File '".$filename."' deleted successully !";
            $_SESSION['msg'] = $msg;
            header("Location: UpFiles.php");
		}
    }
    header("Location: UpFiles.php");
?>