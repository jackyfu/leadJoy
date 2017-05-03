
function text()
{	
	var x = document.getElementById("select1").value;
/*	document.getElementById("demo").innerHTML = x;*/
	alert(x);
	} 

function judge()
{
	var n=judgeNumber;
	var l=document.getElementByID('login_bx');
	var i=document.getElementByID('quit_bx');
		/*用户已经登录*/
	if(n = 1)
	{
		l.setAttribute("display","none")
		i.setAttribute("display","block")
		return;
	}
		/*用户还未登录*/
	if(n = 0)
	{
		i.setAttribute("display","none")
		l.setAttribute("display","block")
		return;
	}
}