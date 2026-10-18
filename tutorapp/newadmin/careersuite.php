<?php
@session_start();
@ob_start();
include "../lms/db.php";
if (!isset($_SESSION['user_id'])){?>
	<script language="JavaScript">
		window.parent.location = 'index.htm';
	</script> 
<?php }
if(isset($_GET['act'])){
	$act = $_GET['act'];
}
if(isset($_GET['stp']))
{
	$stp=$_GET['stp'];
}
if(isset($_GET['rid']))
{
	$rid=$_GET['rid'];
}
if(isset($_GET['rid'])){
	$rid = $_GET['rid'];
}
if( isset($act) && $act == 'del' ){
	$qDelAdmin = "DELETE from `careersuit` WHERE `id` = '$rid'";
	mysqli_query($qDelAdmin);
	header("Location:careersuite.php");
	exit;
}

if(isset($_POST['register'])){
	extract($_POST);
	 $new_action=$_REQUEST['new_action'];
	 
	$phone=$phone.' '.$phone1;
	$regselqry="select * from careersuit where email='$email'";
	$regselres=mysqli_query($regselqry);
	$regrows=mysqli_num_rows($regselres);
	
	if($new_action == 'new'){
	
	if($regrows=="")
	{
	 $registerqry="insert into careersuit (email,password,lastname,firstname,address,city,state,zip,phone,mobile,ethinicity,status) values('$email','$password','$lastname','$firstname','$address','$city','$state','$zip','$phone','$mobile','$ethinicity','1')";
	mysqli_query($registerqry);
	$rid=mysqli_insert_id();
	header("Location:careersuite.php");
	}
	else
	{
		header("Location:careersuite.php?act=new&msg=1");
	}
		
		
		
	}
	
	else if($new_action == 'edit'){
		extract($_POST);
	$phone=$phone.' '.$phone1;
	
	$registerqry="update careersuit set password='$password',email='$email',lastname='$lastname',firstname='$firstname',address='$address',city='$city',state='$state',zip='$zip',phone='$phone',mobile='$mobile',ethinicity='$ethinicity' where id='$rid'";
	mysqli_query($registerqry);
   header("Location:careersuite.php"); 
	}

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CareerPaths Online Admin Panel</title>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" language="javascript">
 function del_admin(adminid){
	if(confirm("Are you sure want to delete this member?")){
		document.location.href = 'careersuite.php?act=del&rid='+adminid;
	}
}
 </script>
 <script language="javascript" type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" language="javascript">
function setAction(action,eid)
{
	if(action=="delete")
	{
	
		document.frm1.eid.value="";
		document.frm1.myaction.value=action;
		
		document.frm1.action="members_del.php";
		
		 mycount = 0;
		for(i=0;i<document.frm1.elements.length;i++)
		{
			
			if(document.frm1.elements[i].name=="Event_Ids[]" && document.frm1.elements[i].checked)
				mycount++;
		}

		if(mycount==0)
		{
			alert("You must check one of the checkboxes.");
			return false;
		}

		if(!confirm("Are you sure you want to "+action+" selected members?"))
			return false;
	
		document.frm1.submit();
	}
	
	if(action=="active")
	{
	
		document.frm1.eid.value="";
		document.frm1.myaction.value=action;
		
		document.frm1.action="members_del.php";
		
		 mycount = 0;
		for(i=0;i<document.frm1.elements.length;i++)
		{
			
			if(document.frm1.elements[i].name=="Event_Ids[]" && document.frm1.elements[i].checked)
				mycount++;
		}

		if(mycount==0)
		{
			alert("You must check one of the checkboxes.");
			return false;
		}

		if(!confirm("Are you sure you want to "+action+" selected members?"))
			return false;
	
		document.frm1.submit();
	}
	
	if(action=="inactive")
	{
	
		document.frm1.eid.value="";
		document.frm1.myaction.value=action;
		
		document.frm1.action="members_del.php";
		
		 mycount = 0;
		for(i=0;i<document.frm1.elements.length;i++)
		{
			
			if(document.frm1.elements[i].name=="Event_Ids[]" && document.frm1.elements[i].checked)
				mycount++;
		}

		if(mycount==0)
		{
			alert("You must check one of the checkboxes.");
			return false;
		}

		if(!confirm("Are you sure you want to "+action+" selected members?"))
			return false;
	
		document.frm1.submit();
	}
}
</script>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {font-size: 13px}
.style4 {	color: #BB2B2B;
	font-size: 14px;
}
.style5 {color: #FF0000; font-size: 12px; }
.style6 {color: #FFFFFF}
.style8 {
	font-size: 24px;
	color: #339331;
}
-->
</style>
</head>

<body>
<?php include_once('top.php')?>
<table width="999" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="208"><?php include_once('add.php')?></td>
	<td width="791" valign="top">
	<table width="795" border="0">
	 <?php if( $act == 'new' || $act == 'edit' ){ ////main if start
			   if($act == 'edit'){ 
			   $qAdmin   = "SELECT * FROM careersuit WHERE id = $rid";
			   $rsAdmin  = mysqli_query($qAdmin);
			   $resAdmin = mysqli_fetch_array($rsAdmin);
			   extract($resAdmin);
			   $phone=$resAdmin['phone'];
               $p=explode(' ',$phone);
			   }
			?>
  <tr>
    <td><form name="registerform" id="registerform" method="post" action="" onSubmit="return regvalid();">

                        <input type="hidden" name="rid" id="rid" value="<?=$rid?>">
                        <input type="hidden" name="new_action" value="<?=$act?>">
                        <input type="hidden" name="stp" id="stp" value="<?=$stp?>" />
							<fieldset>
							  <legend>Add/Edit Members</legend>
                              <table width="667" align="center" cellpadding="5">
                                <?php
		$msg=$_REQUEST['msg'];
		if($msg==1)
		{
			?>
                                <tr>
                                  <th colspan="3" align="center" class="style5">Username already existed. Please try again.</th>
                                </tr>
                                <?php } ?>
							<tr>
								  <th height="34" colspan="2" align="left" ><span class="style8">what career suit you</span></th>
							      <th height="34" align="right" ><a href="javascript:history.back();">&lt;&lt; Back</a></th>
							</tr>
                                <tr>
                                  <th width="33%" align="left" class="red style4">LOGIN INFORMATION</th>
                                  <td width="35%">&nbsp;</td>
                                  <td width="32%"></td>
                                </tr>
                                <tr>
                                  <th align="left" class="style2"><span class="style1">*</span>Email:</th>
                                  <td id="country_input2"><input name="email" id="email" title="Email" size="30" type="text" onBlur="checkField(this);" value="<?=$email?>"></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th align="left" class="style2"><label for="password2"><span class="style1">*</span>Password</label>
                                  :</th>
                                  <td><input name="password" id="password" title="Type Password (5-12 characters)" size="30" maxlength="12" type="password" onBlur="checkField(this);" value="<?=$password?>"></td>
                                  <td class="style2">5-12 characters</td>
                                </tr>
                                <tr>
                                  <th align="left" class="style2"><label for="password_confirm2"><span class="style1">*</span>Confirm Password:</label></th>
                                  <td><input name="cpassword" id="cpassword" title="Retype Password" size="30" maxlength="12" type="password"  onblur="checkField(this);" value="<?=$password?>" /></td>
                                  <td class="style2">5-12 characters</td>
                                </tr>
                                <tr>
                                  <th align="left">&nbsp;</th>
                                  <td id="country_input5">&nbsp;</td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th align="left" class="style4">PERSONAL INFORMATION</th>
                                  <td id="country_input12">&nbsp;</td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th align="left" class="style2"><span class="style1">*</span>Last Name:</th>
                                  <td id="country_input13"><input name="lastname" id="lastname" title="Last Name" size="30" type="text" onBlur="checkField(this);" value="<?=$lastname?>"></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th align="left" valign="top" class="style2"><span class="style1">*</span>First Name:</th>
                                  <td id="country_input"><input name="firstname" id="firstname" title="First Name" size="30" type="text" onBlur="checkField(this);" value="<?=$firstname?>"></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th align="left" valign="top" class="style2"><span class="style1">*</span>Address:</th>
                                  <td id="country_input8"><input name="address" id="address" title="Address" size="30" type="text" onBlur="checkField(this);" value="<?=$address?>"></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th align="left" valign="top" class="style2"><span class="style1">*</span>City:</th>
                                  <td id="country_input6"><input name="city" id="city" title="City" size="30" type="text" onBlur="checkField(this);" value="<?=$city?>"></td>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th align="left" valign="top" class="style2"><span class="style1">*</span>State:</th>
                                  <td id="country_input7"><input name="state" id="state" title="state" size="30" type="text" onBlur="checkField(this);" value="<?=$state?>"></td>
                                  <td><span class="style1"><strong>*</strong></span><strong class="style2">Zip Code: </strong>
                                      <input name="zip" id="zip" title="Zipcode" size="10" type="text" onBlur="checkField(this);" value="<?=$zip?>"></td>
                                </tr>
                                <tr>
                                  <th align="left" class="style2">Phone Number: </th>
                                  <td colspan="2" id="country_input15"><input name="phone" id="phone" title="Phone" size="4" maxlength="3" type="text" onBlur="checkField(this);" value="<?=substr($phone,0,3);?>">
                                    -
                                  <input name="phone1" id="phone1" title="Phone1" size="20" maxlength="7" type="text" onBlur="checkField(this);" usemap="<?=substr($phone,3);?>"></td>
                                </tr>
                                <tr>
                                  <th align="left" class="style2">Mobile : </th>
                                  <td id="country_input16"><input name="mobile" id="mobile" title="mobile" size="30" type="text" onBlur="checkField(this);" value="<?=$mobile?>"></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <th align="left" class="style2"><span class="style1">*</span>Employment Status:</th>
                                  <td id="country_input16"><select name="ethinicity" id="ethinicity" onBlur="checkField(this);" style="width:210px">
								  <?php if($act=="edit"){
								  ?>
								  <option value="<?=$ethinicity?>"><?=$ethinicity?></option>
								  <?php } else{?>
								  <option value="">Select</option>
								  <?php } ?>
                                      
                                      <option value="Unemployed">Unemployed</option>
                                      <option value="Employed">Employed</option>
                                  </select></td>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <th align="left">&nbsp;</th>
                                  <td id="country_input16"><input type="submit" name="register" id="register" value="Save and Continue" /></td>
                                  <td>&nbsp;</td>
                                </tr>
                              </table>
							</fieldset>
		  </form></td>
    </tr>
	 <?php } else if($act=="view"){
             ////main if start
			  
			   $qAdmin   = "SELECT * FROM careersuit WHERE id = $rid";
			   $rsAdmin  = mysqli_query($qAdmin);
			   $resAdmin = mysqli_fetch_array($rsAdmin);
			   extract($resAdmin);
			  
			?>
  <tr>
    <td><form name="registerform" id="registerform" method="post" action="" onSubmit="return regvalid();">

                        <input type="hidden" name="edit_id" value="<?=$rid?>">
                        <input type="hidden" name="new_action" value="<?=$act?>">
                        <input type="hidden" name="stp" id="stp" value="<?=$stp?>" />
			    <fieldset>
        <legend>Add/Edit Members</legend>
                              <table width="99%" align="center" cellpadding="0" cellspacing="2">
        
		<tr>
								  <th height="34" align="left" ><span class="style8">what career suit you</span></th>
							      <th height="34" align="left" >&nbsp;</th>
							      <th height="34" align="right" ><a href="javascript:history.back();">&lt;&lt; Back</a></th>
		</tr>
          <tr>

            <th align="left"  class="red">LOGIN INFORMATION</th>

            <td >&nbsp;</td>

            <td ></td>
          </tr>

          <tr>

            <th width="27%" height="26" align="right" >*Email:</th>

            <td width="31%" ><?=$resAdmin['email'];?></td>

            <td width="42%" ></td>
          </tr>

          <tr>
            
            <th height="27" align="right" >*Password:</th>
            
            <td ><?=$resAdmin['password'];?></td>
            
            <td >&nbsp;</td>
          </tr>

          <tr>
            
            <th height="30" align="right" >*Email:</th>
            
            <td><?=$resAdmin['email'];?></td>
            
            <td ></td>
          </tr>

          <tr>
            
            <th align="left" >&nbsp;</th>
            
            <td >&nbsp;</td>
            
            <td ></td>
          </tr>

          <tr>

            <th align="left"  class="red">PERSONAL INFORMATION</th>

            <td>&nbsp;</td>

            <td ></td>
          </tr>

          <tr>

            <th height="26" align="right" >*Last Name:</th>

            <td ><?=$resAdmin['lastname'];?></td>

            <td ></td>
          </tr>

          <tr>

            <th height="26" align="right" valign="top" >*First Name:</th>

            <td  ><?=$resAdmin['firstname'];?></td>

            <td ></td>
          </tr>

          <tr>

            <th height="30" align="right" valign="top" >*Address:</th>

            <td  ><?=$resAdmin['address'];?></td>

            <td ></td>
          </tr>

          <tr>

            <th height="29" align="right" valign="top" >*City:</th>

            <td  ><?=$resAdmin['city'];?></td>

            <td ></td>
          </tr>

          <tr>

            <th height="28" align="right" valign="top" >*State:</th>

            <td  ><?=$resAdmin['state'];?></td>

            <td >&nbsp;</td>
          </tr>

          <tr>
            <th height="27" align="right" ><strong>*Zip Code:</strong></th>
            <td colspan="2"  ><?=$resAdmin['zip'];?></td>
          </tr>
          <tr>
            <th height="28" align="right" >*Phone Number: </th>
            <td colspan="2"  ><?=$resAdmin['phone'];?>            </td>
          </tr>
          <tr>
            <th height="28" align="right" >*Mobile: </th>
            <td colspan="2"  ><?=$resAdmin['mobile'];?>            </td>
          </tr>
          <tr>
            <th height="28" align="right" >*Employment Status: </th>
            <td colspan="2"  ><?=$resAdmin['ethinicity'];?>
            </td>
          </tr>
          <tr>

            <th colspan="3" align="left" >&nbsp;</th>
          </tr>
</table>
						
			  </fieldset>
		  </form></td>
    </tr>
	<?php } else {?>
  <tr>
    <td><form name="frm1" method="post">
					<table width="100%" border="0" cellpadding="2" cellspacing="3" class="display dataTable">
							<thead>
								<tr>
								  <th height="34" colspan="7" align="left" ><span class="style8">what career suit you</span></th>
							  </tr>
								<tr>
								  <th width="5%" height="34" bgcolor="#000000" ><input name="CheckAll_Event_Ids" type="checkbox" onClick="CheckUncheckAll(this.form,this);" /></th>
									<th width="9%" bgcolor="#000000" class="sorting style6">Email</th>
									<th width="17%" bgcolor="#000000" class="sorting style6">Password</th>
									<th width="17%" bgcolor="#000000" class="sorting style6">First Name</th>
									<th width="15%" bgcolor="#000000" class="sorting style6">Last Name</th>
									<th width="9%" bgcolor="#000000" class="sorting style6">Status</th>
									<th width="20%" bgcolor="#000000" class="sorting style6">Action</th>
								</tr>
							</thead>
                           
							<tfoot>
                            
								<tr>
								  <th height="32" bgcolor="#000000" class="style6">&nbsp;</th>
								  <th bgcolor="#000000" class="style6">Email</th>
								  <th bgcolor="#000000" class="style6">Password</th>
									<th bgcolor="#000000" class="style6">First Name</th>
									<th bgcolor="#000000" class="style6">Last Name</th>
									<th bgcolor="#000000" class="style6">Status</th>
									<th bgcolor="#000000" class="style6">Action</th>
								</tr>
                                 <tr>
                                   <td colspan="3"><input type="button" class="but " onClick="setAction('delete');" value="delete" /> <input name="button" type="button" class="but " onClick="setAction('active');" value="active" /> <input name="button2" type="button" class="but " onClick="setAction('inactive');" value="inactive" /></td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
                                 <td>&nbsp;</td>
								 <td align="right"><input type="button" name="New Member" value="New Member" class="but" onClick="javascript:document.location.href='careersuite.php?act=new'"></td>
								</tr>
							</tfoot>
							<tbody>
                            <?php
							$qGetAdmin   = "SELECT * FROM careersuit";
							$qadminres=mysqli_query($qGetAdmin);
		                    $no_rows   = mysqli_num_rows($qadminres);
							if($no_rows > 0){
				            $i = 0;
				            while($resGetAdmin = mysqli_fetch_array($qadminres)){
				            
							?>
                            
                            <tr <?php if($i%2==0){ echo 'class="gradeA odd"'; } else if($i%2==1){echo 'class="gradeA even"';}?>>
                              <td height="32" bgcolor="#555555" class=" sorting_1"><input name="Event_Ids[]" type="checkbox" onClick="CheckUncheckAll(this.form,this);" value="<?php echo $resGetAdmin["id"];?>"></td>
									<td bgcolor="#555555"><span class="style6">
                                      <?=$resGetAdmin['email'];?>
                                    </span></td>
									<td bgcolor="#555555"><span class="style6">
								    <?=$resGetAdmin['password'];?>
									</span></td>
									<td bgcolor="#555555"><span class="style6">
								    <?=$resGetAdmin['firstname'];?>
									</span></td>
									<td bgcolor="#555555"><span class="style6">
								    <?=$resGetAdmin['lastname'];?>
									</span></td>
									<td bgcolor="#555555"><span class="style6">
								    <?php if($resGetAdmin['status']==1){ echo "Active"; } else{ echo "Inactive"; }?>
									</span></td>
									<td bgcolor="#555555" class="center style6"><a href="careersuite.php?act=edit&rid=<?=$resGetAdmin['id']?>" class="tahoma11boldlink" style="color:#FFFFFF">Edit</a> / <a href="careersuite.php?act=view&rid=<?=$resGetAdmin['id']?>" class="tahoma11boldlink" style="color:#FFFFFF">View</a> / <a href="javascript:del_admin(<?=$resGetAdmin['id']?>)" class="tahoma11boldlink" style="color:#FFFFFF">Delete</a></td>
							</tr>
                            <?php $i++; } } ?>
					  </tbody>
			  </table>
                      <input type="hidden" name="myaction">
                      <input type="hidden" name="eid">
		  </form></td>
    </tr>
	<?php } ?>
</table>

	
	</td>
  </tr>
</table>


</body>
</html>
