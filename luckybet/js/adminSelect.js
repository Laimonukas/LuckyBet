$( document ).ready(function() {
    

	
	var adminSelectArr =["adminSelectIvykiai",
					 "adminSelectStatymai",
					 "adminSelectVartotojai",
					 "adminSelectReklama",
					 "adminSelectSpecialus",];

				 
					 
	function hide(arrMember){
	
		for(var i=0;i<adminSelectArr.length;i++){
			if(arrMember!=adminSelectArr[i]){
				var ret = adminSelectArr[i].replace('Select','');
				
				document.getElementById(ret).classList.add("hidden");
				document.getElementById(ret).classList.remove("normal");
				document.getElementById(adminSelectArr[i]).classList.remove("adminSelectButtonsActive");
				
			}else{
				var ret = arrMember.replace('Select','');
				document.getElementById(adminSelectArr[i]).classList.add("adminSelectButtonsActive");
				document.getElementById(ret).classList.add("normal");
				document.getElementById(ret).classList.remove("hidden");
			}
		
		
		
		}
	}


	
	//adminSelect

	$('#'+adminSelectArr[0]).click(function() {
		hide(adminSelectArr[0]);
	});
	$('#'+adminSelectArr[1]).click(function() {
		hide(adminSelectArr[1]);
	});
	$('#'+adminSelectArr[2]).click(function() {
		hide(adminSelectArr[2]);
	});
	$('#'+adminSelectArr[3]).click(function() {
		hide(adminSelectArr[3]);
	});
	$('#'+adminSelectArr[4]).click(function() {
		hide(adminSelectArr[4]);
	});
	
	
	
	

});



