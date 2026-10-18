<?
//** load email class definition.

  include('class.Email.php'); 
  
   $Sender = "Career Paths Online";
  $Recipiant = 'cleeown@yahoo.co.uk';
  $Cc = "";
  $Bcc = "";
  
  
  
  $msg = new Email($Recipiant, $Sender, "Career Paths Online"); 
  $msg->Cc = $Cc;
  $msg->Bcc = $Bcc;

//** set the message to be text only and set the email content.

  $msg->TextOnly = false;
  $msg->Content = '';
  $msg->Content='Dear Sir/Madam,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This mail has been sent to you because the customer has uploaded a resume.<br><br><strong>Type : </strong>'.$resume_type.'<br><strong>Email : </strong>'.$email.'<br><strong>Comments : </strong>'.$comments.'<br>Thanks again for using our services.<br>Management Service<br>Career Paths Online.';
//** attach this scipt itself to the message.

    $msg->Attach("resumes/".$file, "text/plain");
   

//** send the email message.

  $SendSuccess = $msg->Send();
  
  //echo "HTML email w/attachment was ", 
   //    ($SendSuccess ? "sent" : "not sent"), "<br>";
//header("Location:index.php?msg=1#succ");

  unset($msg); 
?>