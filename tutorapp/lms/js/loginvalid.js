var demo_mode = true; // set to false to allow form submit

function checkFieldTask (aFieldName) {
	var bool = true;
	switch (aFieldName) {
					
			case "username":
			   if ($("#"+aFieldName).val()=="") {
				$("#usernamereq").text("required field");
			    $("#usernamereq").fadeIn("slow").css({color:"#ff0000"});
				bool = false;
			}
			else {
				$("#usernamereq").fadeOut("slow");
			}
			break;
			
			
			case "password":
			   if ($("#"+aFieldName).val()=="") {
			$("#passwordreq").text("required field");
			$("#passwordreq").fadeIn("slow").css({color:"#ff0000"});
				bool = false;
			}
			else {
				$("#passwordreq").fadeOut("slow");
			}
			break;	
		
	}
	return bool;
}
function checkField (aField) {
	return checkFieldTask(aField.name);
}
//main form checking starts from here.......
function loginvalid () {

	
	var bool = true;
	for (var i=0; i<document.loginform.elements.length;i++) 
	{
		
			
		if (!checkFieldTask(document.loginform.elements[i].name)) {
			//$("#required").text("Following * marked fields are required").css({ color:"red", fontWeight:"bolder" });
			bool = false;
			//alert(bool);
		}
	}
	//alert(bool);
	return bool;
}

//email validation
   function EmailValidation(Elementvalue)
	{  
		
		Flag  = 1;
		count = 0;
	
		var alp = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_@.-";
		
		if(Elementvalue.length > 0)
		{
			for (var i=0; i<Elementvalue.length; i++)
			{
				temp = Elementvalue.substring(i, i+1);
	
				if (alp.indexOf(temp) == -1)
				{
					Flag = 0;
				}
			} // closing the for loop
		}
		else
		{
			Flag = 0;
		}
	
		for(var i=0; i <= Elementvalue.length; i++)
		{
			if(Elementvalue.charAt(0)=='@')
			{
				Flag = 0;
				break;
			}

			if(Elementvalue.charAt(Elementvalue.length-1)=='@')
			{
				Flag = 0;
				break;
			}

			if(Elementvalue.charAt(i)=='@') 
			{
				count = count + 1;

				if(count>1)
				{
					Flag = 0;
					break;
				}
			  
				if((Elementvalue.charAt(i-1)=='.') || (Elementvalue.charAt(i+1)=='.'))
				{
					Flag = 0;
					break;
				}
			}
			if(Elementvalue.indexOf('@')==-1)
			{
				Flag = 0;		    	
				break;
			}
			if(Elementvalue.charAt(0)=='.')
			{
				Flag = 0;
				break;
			}
			if(Elementvalue.indexOf('.')==-1)
			{
				Flag = 0;		    	
				break;
			}
		  } //closing the for loop
		
		if(Elementvalue.charAt(Elementvalue.length-1) == '.')
			Flag = 0;
			
		if(Flag != 1)
		{
			//alert("Invalid Email Address.\nValid Characters are [a-z][A-Z][0-9][ _ @ . - ].");
			
			return 0;
		}	
		else
			return 1;
	}


