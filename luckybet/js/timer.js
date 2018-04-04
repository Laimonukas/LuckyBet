$(document).ready(function(){
	
	
	
	
	
	var myVar = setInterval(myTimer, 1000);

	function myTimer() {
		var d = new Date();
		var arr = document.getElementsByClassName("timer");
		for(var i=0;i<arr.length;i++){
			arr[i].innerHTML ="Dabartinis laikas: "+ d;
		}
	}
	
})
 