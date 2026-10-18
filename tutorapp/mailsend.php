<?
extract($_POST);

$to = "cleeown@yahoo.co.uk";
//$to .= $_POST['contact_email'];
$subject = "Customer Details";
$from = "info@careerpathsonline.net";
$headers = "From: $from"; 


  
$html ="<html> 
 <body>
 
  <table width=\"540\" height=\"159\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
 
  <tr>
  <td width=\"244\" align=\"right\"><strong>Name </strong>
  <td width=\"31\" align=\"center\"> <strong>:</strong> </td>
  <td width=\"265\">".$_POST['contact_name']."</td>
  </tr>
  
  <tr>
  <td align=\"right\"><strong>Organisation/ Company</strong>
  <td align=\"center\"> <strong>:</strong> </td>
<td>".$_POST['contact_company']."</td>
  </tr>
	
  <tr>
  <td align=\"right\"><strong>Address </strong>
  <td align=\"center\"> <strong>:</strong> </td>
  <td>".$_POST['contact_adress']."</td>
  </tr>		
	
  <tr>
  <td align=\"right\"><strong>Postcode </strong>
  <td align=\"center\"> <strong>:</strong> </td>
  <td>".$_POST['contact_postcode']."</td>
  </tr>	
  
	<tr>
	<td align=\"right\"><strong>Telephone </strong>
	<td align=\"center\"> <strong>:</strong> </td>
  <td>".$_POST['contact_phone']."</td>
  </tr>
	
	<tr>
	<td align=\"right\"><strong>Email </strong>
	<td align=\"center\"> <strong>:</strong> </td>
  <td>".$_POST['contact_email']."</td>
  </tr>	
 
</table>
</body>
</html>";
/* <tr>
	<td align=\"right\"><strong>Demo Link</strong>
	<td align=\"center\" > <strong>:</strong> </td>
  <td>http://careerpathsonline.net/admin/flash/aboutyou.swf</td>
  </tr>*/	

$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/alternative;\n" .
" boundary=\"{$mime_boundary}\"";


$message = "--{$mime_boundary}\n" .
"Content-Type: text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
"<font face=Arial>" .
$html."\r\n";
 
mail($to,$subject,$message,$headers);

/*echo "<script type=\"text/javascript\" language=\"javascript\">"; 
echo "alert(\"thank you the demo link has been sent to your email!\");";
echo "</script>";*/


$to=$_POST['contact_email'];
//$to.="cleeown@yahoo.co.uk";
$subject = "CareerPaths Online Course";
$from = "info@careerpathsonline.net";
$message="<table width=\"540\" height=\"159\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
 
  <tr>
    <td align=\"center\"><strong>CareerPath Online Course </strong></td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\">Demo Link: </td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td width=\"512\" align=\"center\"><a href=\"http://www.careerpathsonline.net/admin/new_demo/CareerPathsDemo.html\">Course One Demo</a></td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\">Thank you for your interest in Careerpaths Online Course</td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>
  <tr>
    <td align=\"center\">&nbsp;</td>
  </tr>	
</table>";
$headers = 'From: info@careerpathsonline.net' . "\r\n" .
	'Reply-To: info@careerpathsonline.net' . "\r\n" .
	'X-Mailer: PHP/' . phpversion() ."\r\n";
	$headers .= "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
/*$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/alternative;\n" .
" boundary=\"{$mime_boundary}\"";

$message = "--{$mime_boundary}\n" .
"Content-Type: text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 16bit\n\n" .
"<font face=Arial>" .
$msg."\r\n";*/
 
mail($to,$subject,$message,$headers);
header("location:thankyou.php");


?>

