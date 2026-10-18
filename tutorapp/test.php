<style type="text/css">
  .label{
    text-align:right;
  }
  #submit{
    text-align:center;
  }
</style>
<?php
  $to='neilnpaul@yahoo.in';
  $messageSubject='Message subject';
  $confirmationSubject='Confirmation message subject';
  $confirmationBody="Confirmation message body";
  $email='';
  $body='';
  $displayForm=true;
  if ($_POST){
    $email=stripslashes($_POST['email']);
    $body=stripslashes($_POST['body']);
    // validate e-mail address
    $valid=eregi('^([0-9a-z]+[-._+&])*[0-9a-z]+@([-0-9a-z]+[.])+[a-z]{2,6}$',$email);
    $crack=eregi("(\r|\n)(to:|from:|cc:|bcc:)",$body);
    if ($email && $body && $valid && !$crack){
      if (mail($to,$messageSubject,$body,'From: '.$email."\r\n")
          && mail($email,$confirmationSubject,$confirmationBody.$body,'From: '.$to."\r\n")){
        $displayForm=false;
?>
<p>
  Your message was successfully sent.
  In addition, a confirmation copy was sent to your e-mail address.
  Your message is shown below.
</p>
<?php
        echo '<p>'.htmlspecialchars($body).'</p>';
      }else{ // the messages could not be sent
?>
<p>
  Something went wrong when the server tried to send your message.
  This is usually due to a server error, and is probably not your fault.
  We apologise for any inconvenience caused.
</p>
<?php
      }
    }else if ($crack){ // cracking attempt
?>
<p><strong>
  Your message contained e-mail headers within the message body.
  This seems to be a cracking attempt and the message has not been sent.
</strong></p>
<?php
    }else{ // form not complete
?>
<p><strong>
  Your message could not be sent.
  You must include both a valid e-mail address and a message.
</strong></p>
<?php
    }
  }
  if ($displayForm){
?>
<form action="URL" method="post">
  <table>
    <tr>
      <td class="label"><label for="email">Your e-mail address</label></td>
      <td>
        <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" size="30">
        (a confirmation e-mail will be sent to this address)
      </td>
    </tr>
    <tr>
      <td class="label"><label for="body">Your message</label></td>
      <td><textarea name="body" id="body" cols="70" rows="5">
        <?php echo htmlspecialchars($body); ?>
      </textarea></td>
    </tr>
    <tr><td id="submit" colspan="2"><button type="submit">Send message</button></td></tr>
  </table>
</form>
<?php
  }
?>
