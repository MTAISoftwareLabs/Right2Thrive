// JavaScript Document

function writeName(ctrl)

{

	var letters="abcdefghijklmnopqrstuvwxyz /";

	var letters3="0123456789-"

	var letters2="0123456789";

	strn=new String(ctrl.value);

	var str=new String(ctrl.value);

	var str2=new String("");

	var cntDot= 0;

	var dotPos = new Array();



	for(charPos=0;charPos<strn.length ;charPos++)

	{

		if(strn.charAt (charPos)=='.')

		{

			cntDot++;

			dotPos[cntDot]=charPos;

		}

		else if(!isNum(strn.charAt(charPos)) )

		{

			strn=strn.substr (0,charPos);

			ctrl.value =strn.valueOf ();

			break;

		}

	}

	if(cntDot>1)

	{

		alert("Enter proper price value!");

		ctrl.focus();

		return false;

	}

	else if(cntDot==1)

	{

		if(dotPos[cntDot]==ctrl.value.length-1 )

		{

			ctrl.value=ctrl.value+'00';

		}

		else if(dotPos[cntDot]==ctrl.value.length-2)

		{

			//alert(dotPos[cntDot]);  alert(ctrl.value.length);

			str=ctrl.value.substr(0,dotPos[cntDot]+1);

			str2=ctrl.value.substr(dotPos[cntDot]+1,ctrl.value.length-1);

			//alert(str);

			ctrl.value=str+str2+'0';

		}

		else if(dotPos[cntDot]==ctrl.value.length-3){}

		else

		{

			str=ctrl.value.charAt(dotPos[cntDot]+3);		//str2=ctrl.value.charAt(dotPos[cntDot]+2);

			if(str.valueOf ()<5)

			{

				ctrl.value=ctrl.value.substr(0,dotPos[cntDot]+3);

			}

			else

			{

				str2=ctrl.value.charAt(dotPos[cntDot]+2);

				var intChar;

				intChar=(str2.valueOf ());

				intChar++;

				str2=intChar.toString();

				ctrl.value=ctrl.value.substr(0,dotPos[cntDot]+2);

				ctrl.value=ctrl.value+str2;

			}

		}

	}

	return true;        

}

function isNum(pChar)

{

	if((pChar == '1')||(pChar == '2')||(pChar == '3')||(pChar == '4'))

	{

		return true;

	}

	if((pChar == '5')||(pChar == '6')||(pChar == '7')||(pChar == '8'))

	{

		return true;

	}

	if((pChar == '9')||(pChar == '0'))

	{

		return true;

	}

	else

	{

		return false;

	}

}

function passval()

{

	var  uploadfile="";

	uploadfile="'tmpupload.php?addnews=ok";

	window.open('tmpupload.php?addnews=ok');

}



var i=1;

function onlynum(evt)

{

    if(evt.keyCode<48 || evt.keyCode>57)

    {

        evt.keyCode=0;

        alert("Only numbers allowed...");

        return false;

    }

    return true;

}

function CheckNum(ctrl)

{

	var letters="abcdefghijklmnopqrstuvwxyz /";

	var letters3="0123456789-"

	var letters2="0123456789";

	strn=new String(ctrl.value);

	for(charPos=0;charPos<strn.length ;charPos++)

	{

		if(strn.charAt (charPos)=='.')

		{

		}

		else if(!isNum(strn.charAt(charPos)) )

		{

			strn=strn.substr (0,charPos);

			ctrl.value =strn.valueOf ();

			break;

		}

	}

	return;

}

function onlytxt(evt)

{

	if((evt.keyCode<65 || evt.keyCode>90) && (evt.keyCode<97 || evt.keyCode>123) && (evt.keyCode!=32))

    {    evt.keyCode=0;

        alert("Only text allowed..." );

        return false;

    }

    return true;

}

function addfeature(obj)

{    

	if(obj.value!="")

	{

		var current_tbox=new String();

		var current_tbox=obj.name;

		var temp=new String();

		temp=current_tbox;

		temp=temp.split("_");

		num=(temp[1]);

		num=parseInt(num);

		next=0;

		next=num+1;

		next_tbox="features_"+next;

		

		var blank="";

		var new_tbox="features_"+next;

		var  current_html=document.getElementById("id_features").innerHTML;



		var new_html="<br>&nbsp;<input type='text'  name='" + new_tbox + "'    class='flattextbox_large'  onblur='addfeature(this)'>";

		if(!document.frmaddcat.item(next_tbox))

		{

			if (document.frmaddcat.item(current_tbox).value!="")

			{

				document.getElementById("id_features").innerHTML=current_html+new_html;

				document.frmaddcat.features.value = document.frmaddcat.features.value  +  obj.name  + "~";

				document.frmaddcat.item(next_tbox).focus();

			} 

		}

	}

}

function onok()

{

	document.frmaddcat.action="addproduct.php";

	document.frmaddcat.submit();

}

function bk()

{

	document.frmaddcat.action="addproduct.php";

	document.frmaddcat.submit();

}

function cls()

{

	document.frmaddcat.action="addproduct.php";

	document.frmaddcat.submit();

}

function cat()

{

	document.frmaddcat.action="addproduct.php?next1=true";

	document.frmaddcat.submit();

}

function gp()

{

	document.frmaddcat.action="addproduct.php?next=true";

	document.frmaddcat.submit();

}

function subc()

{

	document.frmaddcat.action="addproduct.php?done=yes";

	document.frmaddcat.submit();

}



function count_description()

{

//  alert(desc_no);

	desc=new String("");

	desc=document.frmaddcat.description.value;

	if (desc.length >=1000)

	{

		alert("Description must be greater then 100 or less  then 1000 characters !!!");

		document.frmaddcat.description.focus();

		return false;

	}

	return true;

}

function ad1()

{

	if(document.frmaddcat.txtdescription.value=='')

	{

		alert('Please enter description for message.');

		document.frmaddcat.txtdescription.focus();

		return false;

	}

	if(Composition.document.body.innerHTML=='')

	{

		alert('Please enter message text.');

		return false;

	}

	if(Composition.document.body.innerHTML!="")

	{

		var str;

		str	=Composition.document.body.innerHTML;

		str1=str.indexOf("<IMG");

	

		if(parseInt(str1)!=-1)

		{

			alert('You are not allowed to enter images in features');

			return false;

		}

		else

		{

			document.frmaddcat.features.value=Composition.document.body.innerHTML;

		}

	}

	msg=document.frmaddcat.msgid.value;

	document.frmaddcat.method='post';

	document.frmaddcat.action='editwelcome.asp?valid=yes&msgid='+msg;

	document.frmaddcat.submit();

}

function passval(id)

{

	window.open('tmpupload.php?id='+id,null,"width=500,height=200");

}

function passval1(id)

{

	window.open('tmpupload1.php?id='+id,null,"width=500,height=200");

}

function previewimage(id)

{

	window.open('preview_image.php?id='+id,null,"width=500,height=500");

}

function previewflash(id)

{

	window.open('main.php?id='+id,null,"left=150,top=50,height=600,width=800");

	//	var newwin = 

}


