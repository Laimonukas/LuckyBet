
<body>
<script src="js/mainSelect.js"></script>
<?php


	if(isset($_SESSION["logedIn"])){
		echo '<div id="mainSelectContainer">';
		echo '<div id="mainSelectSport" class="mainSelectButtons mainSelectButtonsActive">Sportas</div>';
		echo '<div id="mainSelectEvents" class="mainSelectButtons">Ivykiai</div>';
		echo '<div id="mainSelectBets" class="mainSelectButtons">Statymai</div>';
		echo '</div>';
		echo "<script src='js/placeBetForm.js'></script>";
		
	}
		
	
?>


<div id="mainSport" class="normal">
	<div>
	<?php
		include('statymas.php');
	?>
	</div>
	<?php include('betslip.php');?>
</div>

<div id="mainEvents" class="hidden">Vykstantys ivykiai:</div>
	
<div id="mainBets" class="hidden">Statymai:</div>
	
</body>