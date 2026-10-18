<?php
include "dbConnection.php";
$fromname = $_SESSION['user_name'];

if (!isset($_SESSION['user_id'])) {
    header("Location:../user_login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST['phone'];
    $subject = $_POST['txtsubject'];
    $message = $_POST['txtcontents'];

    // Your WhatsApp API endpoint
$api_endpoint = 'https://wa.me/' . urlencode($to) . '?text=' . urlencode($message);



    // Redirect to the WhatsApp API endpoint
    header('Location: ' . $api_endpoint);
    exit;
}
?>

<html>
<head>
    <title><?php echo sitename;?>Upload files</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="tms.css" rel="stylesheet" type="text/css">
    <script language="JavaScript">
        function validation() {
            if(document.FRMUPLOADFILE.txtsubject.value == "") {
                alert("Please write message Subject!");
                document.FRMUPLOADFILE.txtsubject.focus();
                return false;
            }
            if (document.FRMUPLOADFILE.txtcontents.value == "") {
                alert("Please write message Contents!");
                document.FRMUPLOADFILE.txtcontents.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body bgcolor="#ffffff" leftmargin="0" topmargin="0">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border : 1px solid  #cccccc;">
    <tr>
        <td colspan="2" valign="top"><?php include "includetop.php";?></td>
    </tr>
    <tr>
        <td rowspan="2" valign="top" width="25%" style="border-right:1px solid #cccccc;">
            <?php include "includeleft.php";?>
        </td>
        <td valign="top">
            <?php include "includewelcome.php";?>
        </td>
    </tr>
    <tr>
        <td valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <form name="FRMUPLOADFILE" method="post" onSubmit="return validation();" action=""  enctype="multipart/form-data">
                            <?php if(isset($_GET['next']) && $_GET['next'] == 1) { ?>
                                <!-- Your code to handle form submission -->
                            <?php } else { ?>
                                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="2%"><img src="images/changep_left_cor.jpg" width="11" height="20"></td>
                                        <td width="96%" background="images/changep_center_cor.jpg">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td class="welcome">Send WhatsApp Message to Learner</td>
                                                    <td><div align="right"><font color="#FFFFFF"><strong>::</strong></font></div></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="2%" background="images/changep_right_cor.jpg">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="50" colspan="3" style="border-right : 1px solid  #4681C4; border-left : 1px solid  #4681C4;">&nbsp;
                                            <table class="" width="90%" align="center">
                                                <tr>
                                                    <td class="bodytext">&nbsp;Select Learner</td>
                                                    <td class="bodytext">
                                                        <select name="phone" class="textbox">
                                                            <option selected>Select Learner</option>
                                                            <?php
                                                            $sqllearner = "select vUserMobile,iUserId,vUserName from cpo_usermaster where iUserType=2";
                                                            $rslearner = runquery($sqllearner);
                                                            $num = $rslearner ? mysqli_num_rows($rslearner) : 0 ;

                                                            while ($rsdata = mysqli_fetch_array($rslearner)) { ?>
                                                                <option value="<?php echo $rsdata['vUserMobile'] ?>"><?php echo $rsdata['vUserName'];?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="bodytext">&nbsp;Message Contents</td>
                                                    <td class="bodytext"><textarea name="txtcontents" class="textbox" rows="8" cols="50"></textarea></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="11"><img src="images/changebttm_left_cor.jpg" width="11" height="25"></td>
                                        <td height="22" background="images/changebttm_center_cor.jpg">
                                            <div align="right">
                                                <input type="submit" value="Send WhatsApp" alt="Send WhatsApp" width="67" height="17">
                                            </div>
                                        </td>
                                        <td width="11"><div align="right"><img src="images/changebttm_right_cor.jpg" width="11" height="25"></div></td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                </table>
                            <?php } ?>
                        </form>
                    </td>
                </tr>
            </table>
        </td>
        <td><img src="images/spacer.gif" width="1" height="350" border="0" alt=""></td>
    </tr>
    <?php include "includebottom.php";?>
</table>
<map name="lms_1_r2_c2Map">
    <area shape="rect" coords="491,88,551,100" href="logout.php">
</map>
</body>
</html>
