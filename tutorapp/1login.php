<form action="<? if(isset($_SESSION['url'])) { echo $_SESSION['url']; } else echo "home.php"; ?>" method="post" name="loginForm" id="loginForm">
  <table width="97%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#007ACC">
    <tr>
      <td><div align="center" class="style11 style12">
        <div align="left"></div>
      </div></td>
      <td><span class="mainhead">User Login Area </span></td>
    </tr>
  </table>
  <table width="97%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#EAF7FF">
    <tr>
      <td width="2%"></td>
      <td width="20%" class="hyper">User Id: </td>
      <td width="1%"></td>
      <td width="77%">
        <div align="left">
          <input name="user_name" type="text" id="user_name" size="20" class="inputstyle">
        </div></td></tr>
    <tr>
      <td></td>
      <td class="hyper">Password:</td>
      <td></td>
      <td>
        <div align="left">
          <input name="password" type="password" id="password" size="20" class="inputstyle">
        </div></td></tr>
    <tr>
      <td colspan="2"></td>
      <td></td>
      <td><input name="login" type="submit" id="login" value="Login!" class="textbox"></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center" class="hyper">New User? <a href="register.php">Get Registered</a></div></td>
    </tr>
    <tr>
      <td colspan="4"><div align="center" class="hyper"><a href="forgot_pass.php">Forgot Password?</a></div></td>
    </tr>
  </table>
</form>
  