<?php
if(isset($_POST['submit_x']))
{
extract($_POST);

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" language="javascript">
function submitform(){
document.getElementById('payform').submit();
}

</script>

<script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>

</head>

<body onload="submitform()">

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="payform" id="payform">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="cleeown@yahoo.co.uk">
<input type="hidden" name="item_name" value="<?=$cname;?>">

<input type="hidden" name="image_url"
value="http://careerpathsonline.net/images/logo.jpg">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return"
value="http://careerpathsonline.net/thankyou.php">
<input type="hidden" name="cancel_return"
value="http://careerpathsonline.net/cancel.php">
<input type="hidden" name="currency_code" value="GBP">
<input type="hidden" name="a3" value="<?=$cost?>">
<input type="hidden" name="p3" value="1">
<input type="hidden" name="t3" value="M">
<input type="hidden" name="src" value="1">
<input type="hidden" name="sra" value="1">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="no_note" value="1">

<input type="hidden" name="usr_manage" value="1">
<!--<input type="image" src="http://images.paypal.com/images/x-click-but01.gif"
border="0" name="submit"
alt="Make payments with PayPal - it’s fast, free and secure!">-->
</form>
<br /><br /><br /><br /><br />
<table cellpadding="0" cellspacing="0" align="center">
<tr>
<td align="center"><img src="images/loading.gif" />
<br /><span style="color:#FF80D7"><strong>Your request is being processed.Please wait..</strong></span>
</td>
</tr>
</table>

</body>
</html>
