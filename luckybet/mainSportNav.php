
<body>
<script src="js/mainSelect.js"></script>

<div id="mainSelectContainer">
	<div id="mainSelectSport" class="mainSelectButtons mainSelectButtonsActive">Sportas</div>
	
	<div id="mainSelectEvents" class="mainSelectButtons">Ivykiai</div>
		
	<div id="mainSelectBets" class="mainSelectButtons">Statymai</div>
</div>

<div id="mainSport" class="normal">
	<?php include('statymas.php');?>
	<?php include('betslip.php');?>
</div>

<div id="mainEvents" class="hidden">Vykstantys ivykiai:</div>
	
<div id="mainBets" class="hidden">Statymai:</div>
	
</body>