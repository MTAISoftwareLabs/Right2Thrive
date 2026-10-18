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
    if(is_numeric($id) && $id>0)
    {
        $strQuery = "delete from cpo_categorymaster where iCategoryId=".$id;
        runquery($strQuery);
    }
    header("Location: category.php");
?>