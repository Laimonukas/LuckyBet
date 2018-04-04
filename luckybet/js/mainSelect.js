$( document ).ready(function() {
    

	
	var adminSelectArr =["mainSelectEvents",
					 "mainSelectBets",
					 "mainSelectSport"];

				 
					 
	function hide(arrMember){
	
		for(var i=0;i<adminSelectArr.length;i++){
			if(arrMember!=adminSelectArr[i]){
				var ret = adminSelectArr[i].replace('Select','');
				
				document.getElementById(ret).classList.add("hidden");
				document.getElementById(ret).classList.remove("normal");
				document.getElementById(adminSelectArr[i]).classList.remove("mainSelectButtonsActive");
				
			}else{
				var ret = arrMember.replace('Select','');
				document.getElementById(adminSelectArr[i]).classList.add("mainSelectButtonsActive");
				document.getElementById(ret).classList.add("normal");
				document.getElementById(ret).classList.remove("hidden");
			}
		
		
		
		}
	}


	
	//mainSelect

	$('#'+adminSelectArr[0]).click(function() {
		hide(adminSelectArr[0]);
	});
	$('#'+adminSelectArr[1]).click(function() {
		hide(adminSelectArr[1]);
	});
	$('#'+adminSelectArr[2]).click(function() {
		hide(adminSelectArr[2]);
	});
	
	
	
	

});



