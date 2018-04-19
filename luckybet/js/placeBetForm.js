$(document).ready(function(){
	
	$("#mainSport").parent().on("click",".placeBet",function(){
		if(this.id.includes('X')){
			var id = this.id.replace("betFormX","");
			var selectedClub ="x";
		}else{
			var id = this.id.replace("betFormY","");
			var selectedClub ="y";
		}
		
		var betSum = document.getElementById("betValue"+id).value;
		if(isNaN(betSum)==true||betSum==0||betSum==""){
			alert("Statoma suma mažesnė už 0 arba blogas jos formatas");
			return;
		}
		
		$.post( "addBetPOST.php", { betSum: betSum,eventId: id,club: selectedClub },
		function(data){
			if(data=="Statymas priimtas"){
				document.getElementById("betValue"+id).value = "";
				$( ".red" ).remove();
				$( ".green" ).remove();
				$(".betslipMessages").prepend('<div class="green">'+data+'</div>');
				setTimeout(function(){
					$( ".red" ).remove();
					$( ".green" ).remove();
				},5000);
							
			}else{
				document.getElementById("betValue"+id).value = "";
				$( ".red" ).remove();
				$( ".green" ).remove();
				$(".betslipMessages").prepend('<div class="red">Klaida:'+data+'</div>');
				setTimeout(function(){
					$( ".red" ).remove();
					$( ".green" ).remove();
				},5000);
			}
			$( "#betContainer" ).parent().load("statymas.php");
			$( ".betHistory" ).parent().load("betslip.php");
			$( "#stickyHeaderContainer" ).parent().load("stickyHeaderLogedIn.php");
		});
		
	});
	
	
});