function CheckUncheckAll(frm,chk)
{
	
	if(chk.name.substr(0,8)!="CheckAll")
	{
		
		CheckName = chk.name;
		MyChecked = true;

		for(i=0;i<frm.elements.length;i++)
		{
			if(frm.elements[i].name==CheckName && frm.elements[i].checked==false)
			{
				MyChecked=false;
				break;
			}
		}

		CheckAll = eval("frm.CheckAll_"+CheckName.substr(0,CheckName.length-2));
		
		CheckAll.checked=MyChecked;
	}		
	else
	{
		
		CheckName = chk.name.substr(9,chk.name.length)+"[]";
		
		if(chk.checked==true)
			AllChecked = true;
		else
			AllChecked = false;

		for(i=0;i<frm.elements.length;i++)
		{
			if(frm.elements[i].name==CheckName)
				frm.elements[i].checked=AllChecked;		
		}
	}
}

