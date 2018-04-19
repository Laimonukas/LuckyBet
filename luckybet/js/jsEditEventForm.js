$( document ).ready(function() {
	var nameArray = ["eventId","clubX","clubY","koefX","koefY","betsForX","betsForY","startDate","endDate","winner"];
	
	function replaceValuesType2(nameArr,valArr,id){
		for(var i=0;i<nameArr.length;i++){
			$("#"+nameArr[i]+id).val(valArr[i]);
		}
	}
	
	function fieldReplaceWithValue(click,arr){
		$("#"+click.replace("eventForm","eventId")).val(arr[0]);
		$("#"+click.replace("eventForm","clubX")).val(arr[1]);
		$("#"+click.replace("eventForm","clubY")).val(arr[2]);
		$("#"+click.replace("eventForm","koefX")).val(arr[3]);
		$("#"+click.replace("eventForm","koefY")).val(arr[4]);
		$("#"+click.replace("eventForm","betsForX")).val(arr[5]);
		$("#"+click.replace("eventForm","betsForY")).val(arr[6]);
		$("#"+click.replace("eventForm","startDate")).val(arr[7]);
		$("#"+click.replace("eventForm","endDate")).val(arr[8]);
		$("#"+click.replace("eventForm","winner")).val(arr[9]);
	}
	
	function makeFieldsReadonly(click,secondClick){
		$('.adminEventTable input').attr('readonly','readonly');
		$("#clubX"+click).attr("readonly", false); 
		$("#clubY"+click).attr("readonly", false); 
		$("#koefX"+click).attr("readonly", false); 
		$("#koefY"+click).attr("readonly", false); 
		$("#betsForX"+click).attr("readonly", false); 
		$("#betsForY"+click).attr("readonly", false);
		$("#startDate"+click).attr("readonly", false); 
		$("#endDate"+click).attr("readonly", false); 
		$("#winner"+click).attr("readonly", false);
		$("#"+lastClick).val("Redaguoti");
	}
	
	$('.adminEventTable :input').attr('readonly','readonly');
	
	var valueArray=[];
	
	var lastClick=0;
	
	
	$(".adminSelectButtons").click(function(){
		if(this.id=="adminSelectIvykiai"||this.id=="adminSelectStatymai"
			||this.id=="adminSelectVartotojai"||this.id=="adminSelectReklama"
			||this.id=="adminSelectSpecialus"){
				if(valueArray.length>0){
					try{
						fieldReplaceWithValue(lastClick,valueArray);
						makeFieldsReadonly(lastClick,lastClick);
						valueArray=[];
						lastClick=0;
						return;
					}
					catch(e){
					}
					return;
				}
				return;
		}
		return;
	})
	
	
	$('.jsEventForm').on("click",function(){
		var oldValueArray=valueArray;
		var clickedID = this.id;
		clickedID = clickedID.replace("eventForm",'');
		var lastEventId= document.getElementById('eventId'+clickedID).value;
		
		
		if(lastClick!=this.id){
			//first click lastClick==undefined
			try{
				fieldReplaceWithValue(lastClick,valueArray);
			}
			catch(e){
				
			}
			
			var eventId= document.getElementById('eventId'+clickedID).value;
			var clubX= document.getElementById('clubX'+clickedID).value;
			var clubY= document.getElementById('clubY'+clickedID).value;
			var koefX= document.getElementById('koefX'+clickedID).value;
			var koefY = document.getElementById('koefY'+clickedID).value;
			var betsForX= document.getElementById('betsForX'+clickedID).value;
			var betsForY= document.getElementById('betsForY'+clickedID).value;
			var startDate = document.getElementById('startDate'+clickedID).value;
			var endDate= document.getElementById('endDate'+clickedID).value;
			var winner= document.getElementById('winner'+clickedID).value;
			
			valueArray=[eventId,clubX,clubY,koefX,koefY,betsForX,betsForY,startDate,endDate,winner];
			
			
			makeFieldsReadonly(clickedID,lastClick);
			$("#eventForm"+clickedID).val("Išsaugoti");
			
			lastClick=this.id;
		}else{
			
			eventId= document.getElementById('eventId'+clickedID).value;
			clubX= document.getElementById('clubX'+clickedID).value;
			clubY= document.getElementById('clubY'+clickedID).value;
			startDate= document.getElementById('startDate'+clickedID).value;
			endDate= document.getElementById('endDate'+clickedID).value;
			winner = document.getElementById('winner'+clickedID).value;
			
			if(document.getElementById('koefX'+clickedID).value<0
			||document.getElementById('koefY'+clickedID).value<0
			|| $.isNumeric(document.getElementById('koefX'+clickedID).value)==false
			|| $.isNumeric(document.getElementById('koefY'+clickedID).value)==false){
				alert("Koeficientas < 0");
				return;
			}else{
				koefX= document.getElementById('koefX'+clickedID).value;
				koefY = document.getElementById('koefY'+clickedID).value;
			}
			
			if(document.getElementById('betsForX'+clickedID).value<0
			||document.getElementById('betsForY'+clickedID).value<0
			|| $.isNumeric(document.getElementById('betsForX'+clickedID).value)==false
			|| $.isNumeric(document.getElementById('betsForY'+clickedID).value)==false){
				alert("Statymai < 0");
				return;
			}else{
				betsForX= document.getElementById('betsForX'+clickedID).value;
				betsForY= document.getElementById('betsForY'+clickedID).value;
			}
			
			
			
			
			if(eventId==valueArray[0]&&clubX==valueArray[1]&&clubY==valueArray[2]
				&&koefX==valueArray[3]&&koefY==valueArray[4]
				&&betsForX==valueArray[5]&&betsForY==valueArray[6]&&startDate==valueArray[7]
				&&endDate==valueArray[8]
				&&winner==valueArray[9]){
				
			}else{
				$.post( "editEvents.php", { postEventId: eventId, postClubX: clubX, postClubY: clubY, 
										postKoefX: koefX, postKoefY:koefY,
										postBetsForX: betsForX, postBetsForY: betsForY,
										postStartDate : startDate, postEndDate : endDate,
										postWinner : winner},
					function(data){
						if(data=="Ivykis sekmingai pakeistas"){
							$( ".red" ).empty();
							$( ".green" ).empty();
							$(".adminEventTable").prepend('<div class="green">'+data+'</div>');
							setTimeout(function(){
								$( ".red" ).empty();
								$( ".green" ).empty();
							},5000);
							
						}else{
							replaceValuesType2(nameArray,oldValueArray,clickedID);
							$( ".red" ).empty();
							$( ".green" ).empty();
							$(".adminEventTable").prepend('<div class="red">Klaida</div>');
							setTimeout(function(){
								$( ".red" ).empty();
								$( ".green" ).empty();
							},5000);
						}
						
				});
			}
			
			
			$('.adminEventTable :input').attr('readonly','readonly');
			$("#eventForm"+clickedID).val("Redaguoti");
			
			valueArray = [eventId,clubX,clubY,koefX,koefY,betsForX,betsForY,startDate,endDate,winner];
			lastClick=0;
		}
		
	});
	
	
	
});