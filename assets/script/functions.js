function onlynum(evt){
	if(evt.keyCode<45 || evt.keyCode>57)
	{
		evt.keyCode=0;
		alert("Only numbers allowed...");
		return false;
	}
	return true;
}
function checknum(obj){
	var s = new String("0123456789+-");

	for ( i = 0; i < obj.value.length; i++ )
	{
		ch = String(obj.value).charAt(i);
		for (j=0;j<s.length;j++)
			if (ch == s.charAt(j))
				break;
		if (j == s.length)
			return false;
	}
	return true;
}