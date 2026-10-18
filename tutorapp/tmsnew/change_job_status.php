<?php
    session_cache_expire(time()-1);
    session_cache_limiter('nocache');
    @ob_start();	
    include "dbConnection.php";
    if (!isset($_SESSION['user_id']))
    { 
        header("Location:../user_login.php");
    }
    else
    {
        $user_id = $_SESSION['user_id'];
    }
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    if(is_numeric($id) && $id>0 && ($status==0 || $status==1))
    {
        $strQuery = "update cpo_jobmaster set iStatus=".$status." where iJobId=".$id;
        runquery($strQuery);
        echo "The Job status is updted";
    }
    else {
        echo "Invalid data";
    }
    
?>