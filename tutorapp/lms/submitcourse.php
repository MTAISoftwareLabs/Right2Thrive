<?php
include "dbConnection.php";
if(isset($_POST['addcourse_x']))
{
extract($_POST);
$regdate=date('Y-m-d h:i:s');
for($i=1;$i<$cnt;$i++)
	{
	//echo "hi";
			if(isset($HTTP_POST_VARS['chk'.$i]))
			{
				$coursename= $HTTP_POST_VARS['chk'.$i];
				$addcourse="insert into cpo_usercourse values('',".$userid.",".$coursename.",'','".$regdate."',0,'','')";
				$record=runquery($addcourse);
				
			}
	}
	header("Location:addcourses.php?msg=1");
	}

?>
