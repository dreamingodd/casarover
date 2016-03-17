window.onload=function()
{
	var a=document.getElementsByTagName('nav')[0];
	console.log(a);
	var oli=$(".nav-middle li:eq(3)");
	var asd=$("#asd");
	var odl=$(".nav-middle dl");
			console.log(odl);
	oli.mouseover(function()
		{
			odl.show();
		});

	oli.mouseout(function()
		{	
			odl.hide();
		});
}