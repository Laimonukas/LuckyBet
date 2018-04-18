$(document).ready(function(){
	

var numberToShow = 30;



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
	
	$(".adminEventPages").append('<br><a class="adminEventPage"> < </a>');
	$(".adminEventPages").append('<a class="adminEventPage"> << </a>');
	
	if(currentPage<=3){
		offset=1;
	}else{
		var offset = currentPage-numOfPagesToShow;	
	}
	
	for(var i=0;i<numOfPagesToShow;i++){
		if(offset==currentPage){
			$(".adminEventPages").append(offset);
		}else{
			$(".adminEventPages").append('<a class="adminEventPage"> '+offset+' </a>');
		}
		offset++;
	}
	$(".adminEventPages").append('<a class="adminEventPage"> ... </a>');
	
	for(var i=0;i<numOfPagesToShow;i++){
		if(offset>totalPages){
			break;
		}
		if(offset==currentPage){
			$(".adminEventPages").append(offset);
		}else{
			$(".adminEventPages").append('<a class="adminEventPage"> '+offset+' </a>');
		}
		offset++;
	}
	
	$(".adminEventPages").append('<a class="adminEventPage"> >> </a>');
	$(".adminEventPages").append('<a class="adminEventPage"> > </a>');
	$(".adminEventPages").append('<br>Rodyti po: <a class="adminEventPageCount"> 30 </a>');
	$(".adminEventPages").append('<a class="adminEventPageCount"> 50 </a>');
	$(".adminEventPages").append('<a class="adminEventPageCount"> 100 </a>');
	$(".adminEventPages").append('<a class="adminEventPageCount"> 200 </a>');
	
	$.post( "selectPagePOST.php",{toSelect: "events",pageNum: currentPage,numToShow: numberToShow},function(data){
		$(".adminEventTable").empty();
		$(".adminEventTable").prepend(data);
		$(".adminEventTable").prepend('<script src="js/jsEditEventForm.js"></script>');
		
	});
	
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
		numberToShow =parseInt(x);
		currentPage=1;
		paginate();
	});
	
};

paginate();



});

