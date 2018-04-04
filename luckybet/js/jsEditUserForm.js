$( document ).ready(function() {
   
	
	function fieldReplaceWithValue(click,arr){
		$("#"+click.replace("form","id")).val(arr[0]);
		$("#"+click.replace("form","name")).val(arr[1]);
		$("#"+click.replace("form","lastname")).val(arr[2]);
		$("#"+click.replace("form","username")).val(arr[3]);
		$("#"+click.replace("form","password")).val(arr[4]);
		$("#"+click.replace("form","credits")).val(arr[5]);
		$("#"+click.replace("form","role")).val(arr[6]);
	}
	
	function makeFieldsReadonly(click,secondClick){
		$('#adminVartotojai input').attr('readonly','readonly');
		$("#name"+click).attr("readonly", false); 
		$("#lastname"+click).attr("readonly", false); 
		$("#username"+click).attr("readonly", false); 
		$("#password"+click).attr("readonly", false); 
		$("#credits"+click).attr("readonly", false); 
		$("#role"+click).attr("readonly", false);
		$("#"+lastClick).val("Redaguoti");
		
	}
	
	
	
	$('#adminVartotojai :input').attr('readonly','readonly');
	var lastArray=[];
	var lastClick=0;
	
	
	$(".adminSelectButtons").click(function(){
		if(this.id=="adminSelectIvykiai"||this.id=="adminSelectStatymai"
			||this.id=="adminSelectVartotojai"||this.id=="adminSelectReklama"
			||this.id=="adminSelectSpecialus"){
				if(lastArray.length>0){
					try{
						fieldReplaceWithValue(lastClick,lastArray);
						makeFieldsReadonly(lastClick,lastClick);
						lastArray=[];
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
	
	
	$('.jsUserForm').click(function(){
		
		
		
		var clickedID = this.id;
		clickedID = clickedID.replace("form",'');
		var lastId= document.getElementById('id'+clickedID).value;
		
		
		if(lastClick!=this.id){
			//first click lastClick==undefined
			try{
				fieldReplaceWithValue(lastClick,lastArray);
			}
			catch(e){
				
			}
			
			var id= document.getElementById('id'+clickedID).value;
			var name= document.getElementById('name'+clickedID).value;
			var lastname= document.getElementById('lastname'+clickedID).value;
			var username= document.getElementById('username'+clickedID).value;
			var userPassword = document.getElementById('password'+clickedID).value;
			var credits= document.getElementById('credits'+clickedID).value;
			var role= document.getElementById('role'+clickedID).value;
			
			lastArray=[id,name,lastname,username,userPassword,credits,role];
			
			
			makeFieldsReadonly(clickedID,lastClick);
			$("#form"+clickedID).val("Išsaugoti");
			
			lastClick=this.id;
		}else{
			
			
			
			
			
			id= document.getElementById('id'+clickedID).value;
			name= document.getElementById('name'+clickedID).value;
			lastname= document.getElementById('lastname'+clickedID).value;
			username= document.getElementById('username'+clickedID).value;
			userPassword = document.getElementById('password'+clickedID).value;
			if(document.getElementById('credits'+clickedID).value<0|| $.isNumeric(document.getElementById('credits'+clickedID).value)==false){
				alert("Kreditai < 0");
				return;
			}else{
				credits= document.getElementById('credits'+clickedID).value;
			}
			
			if(document.getElementById('role'+clickedID).value==0 || document.getElementById('role'+clickedID).value==1){
				role= document.getElementById('role'+clickedID).value;
			}else{
				alert("Rolė gali būti 0/1");
				return;
			}
			
			
			
			
			
			if(name==lastArray[1]&&lastname==lastArray[2]&&username==lastArray[3]&&userPassword==lastArray[4]
				&&credits==lastArray[5]&&role==lastArray[6]
				){
				
			}else{
				$.post( "editUsers.php", { postId: id, postName: name, postLastname: lastname, 
										postUsername: username, postPassword:userPassword,
										postCredits: credits, postRole: role},
					function(data){
				
					console.log(data);
				});
			}
			
			
			
			$('#adminVartotojai :input').attr('readonly','readonly');
			$("#form"+clickedID).val("Redaguoti");
			
			lastArray=[id,name,lastname,username,userPassword,credits,role];
			lastClick=0;
			
		}
		
	});
	
	
	
});