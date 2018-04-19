$(document).ready(function(){
	

var numberToShow = 30;
var searchOn = false;
var searchValue = "";


if (typeof currentPage === 'undefined') {
	var currentPage = 1;
}

function paginate(){
	
	$(".adminEventPages").empty();
	
	var totalPages = Math.ceil(numRows/numberToShow);
	var numOfPagesToShow = 3;
	
	if (currentPage <= 0) {
		currentPage = 1;
	}
	
	if(currentPage>totalPages){
		currentPage=totalPages;
	}
	
	
	$(".adminEventPages").append('<br><a class="adminEventPage buttonTypeD"> < </a>');
	$(".adminEventPages").append('<a class="adminEventPage buttonTypeD"> << </a>');
	
	
	
	if(currentPage<=3){
		offset=1;
	}else{
		var offset = currentPage-numOfPagesToShow;	
	}
	
	
	if(numOfPagesToShow>totalPages){
		numOfPagesToShow=totalPages;
	}
	for(var i=0;i<numOfPagesToShow;i++){
		
		if(offset==currentPage){
			$(".adminEventPages").append(offset);
		}else{
			$(".adminEventPages").append('<a class="adminEventPage buttonTypeD"> '+offset+' </a>');
		}
		offset++;
	}
	
	$(".adminEventPages").append('<a class="adminEventPage buttonTypeD"> ... </a>');

	for(var i=0;i<numOfPagesToShow;i++){
		if(offset>totalPages){
			break;
		}
		if(offset==currentPage){
			$(".adminEventPages").append(offset);
		}else{
			$(".adminEventPages").append('<a class="adminEventPage buttonTypeD"> '+offset+' </a>');
		}
		offset++;
	}
	
	
	
	
	$(".adminEventPages").append('<a class="adminEventPage buttonTypeD"> >> </a>');
	$(".adminEventPages").append('<a class="adminEventPage buttonTypeD"> > </a>');
	$(".adminEventPages").append('<br>Rodyti po: <a class="adminEventPageCount buttonTypeD"> 30 </a>');
	$(".adminEventPages").append('<a class="adminEventPageCount buttonTypeD"> 50 </a>');
	$(".adminEventPages").append('<a class="adminEventPageCount buttonTypeD"> 100 </a>');
	$(".adminEventPages").append('<a class="adminEventPageCount buttonTypeD"> 200 </a>');
	
	
	
	if(searchOn == false){
		$.post( "selectPagePOST.php",{toSelect: "events",pageNum: currentPage,numToShow: numberToShow},function(data){
			$(".adminEventTable").empty();
			$(".adminEventTable").prepend(data);
			$(".adminEventTable").prepend('<script src="js/jsEditEventForm.js"></script>');	
		});
	}else{
		$.post( "selectPagePOST.php",{toSelect: "searchEvents",searchValue: searchValue,pageNum: currentPage,numToShow: numberToShow},function(data){
			$(".adminEventTable").empty();
			$(".adminEventTable").prepend(data);
			$(".adminEventTable").prepend('<script src="js/jsEditEventForm.js"></script>');
		});	
	}
	
	
	
	
	
	
	$(".adminEventPage").on("click",function(){
		var x = this.innerText.replace(' ','');
		x = x.replace(' ','');
		switch(x){
			case '<':
				currentPage-=1;
				paginate();
				break;
			case '<<':
				currentPage=1;
				paginate();
				break;
			case '>':
				currentPage+=1;
				paginate();
				break;
			case '>>':
				currentPage=totalPages;
				paginate();
				break;
			case '...':
				break;
			default:
				x = parseInt(x);
				currentPage=x;
				paginate();
				break;
		}
	});
	
	$(".adminEventPageCount").on("click",function(){
		var x = this.innerText.replace(' ','');
		x = x.replace(' ','');
		numberToShow = parseInt(x);
		currentPage= 1;
		paginate();
	});
	
};

paginate();

$('.eventSearchSubmit').on('click',function(){
		searchValue = $(".eventSearchInput").val();
		
		if(searchValue==""){
			alert("Paieškos laukas tuščias");
			return;
		}
		
		searchOn = true;
		
		$.post( "selectPagePOST.php",{toSelect: "searchEventsCount",searchValue: searchValue},function(data){
			numRows=parseInt(data);
			currentPage=1;
			paginate();
		});
		
		
		
		
		
		
		
	});


});

