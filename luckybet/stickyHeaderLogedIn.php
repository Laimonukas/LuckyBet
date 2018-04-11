
<div id="stickyHeaderContainer">
	<div class="stickyHeaderButton"><img class="lbLogo" src="images/logoWide.jpg" alt="LuckyBet logo"></div>
	<div class="width50 floatLeft" >
	<?php
		//&nbsp; extra space
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		
		}
			
		if($_SESSION['isAdmin']==true){
			echo "<div class='width33 floatLeft'>";
			echo "Administratorius: ".$_SESSION['username'];
			echo "</div>";
			
			echo "<div class='width33 floatLeft'>";
			echo '<a class="linkOnBlack" href="logout.php">Atsijungti</a>';
			echo "</div>";
		}else{
			echo "<div class='width33 floatLeft'>";
			echo "Vartotojas: ".$_SESSION['username'];
			echo "</div>";
			
			echo "<div class='width33 floatLeft'>";
			echo "Kreditai: ".$_SESSION['credits'];
			echo "</div>";
			
			echo "<div class='width33 floatLeft'>";
			echo '<a class="linkOnBlack" href="logout.php">Atsijungti</a>';
			echo "</div>";
			
			
		}
	?>
	
	
	
	
	</div>
	
	




</div>
<div class="clearfix"></div>



