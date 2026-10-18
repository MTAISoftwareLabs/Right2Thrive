var demo_mode = true; // set to false to allow form submit

function checkFieldTask (aFieldName) {
	var bool = true;
	switch (aFieldName) {
					
		case "email":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
		 else if(!EmailValidation($("#"+aFieldName).val()))
			  {
			$("#"+aFieldName).css({background:"#FDB0B0"});
			alert("Invalid email");
			$("#"+aFieldName).show("slow");
				bool = false;
				  
			  }
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
			case "password":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;	
			case "cpassword":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else if($("#"+aFieldName).val()!=$("#password").val())
			  {
				$("#"+aFieldName).css({background:"#FDB0B0"});
			    alert("mismatch password");
			    $("#"+aFieldName).show("slow");
				bool = false;
			  }
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
		
			
			case "lastname":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
			case "firstname":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
			case "address":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
			case "city":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
			case "state":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
			case "zip":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
		
		case "ethinicity":
			   if ($("#"+aFieldName).val()=="") {
				$("#"+aFieldName).css({background:"#FDB0B0"});
				$("#"+aFieldName).show("slow");
				bool = false;
			}
			else {
				$("#"+aFieldName).css({background:""});
			}
			break;
		
		
	}
	return bool;
}
function checkField (aField) {
	return checkFieldTask(aField.name);
}
//main form checking starts from here.......
function regvalid () {

	
	var bool = true;
	for (var i=0; i<document.registerform.elements.length;i++) 
	{
		
			
		if (!checkFieldTask(document.registerform.elements[i].name)) {
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


