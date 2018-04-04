<body>

	<div id="stickyHeaderContainer">
		<div class="stickyHeaderButton"><img class="lbLogo" src="images/logoWide.jpg" alt="LuckyBet logo"></div>
		<div >
		<?php
			//&nbsp; extra space
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			
				if($_SESSION['isAdmin']==true){
					echo "Administratorius:&nbsp;".$_SESSION['username']."&nbsp;&nbsp;&nbsp;&nbsp;";
				}else{
					echo "Vartotojas:&nbsp;".$_SESSION['username']."&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "Kreditai:&nbsp;".$_SESSION['credits'];
				}
			}else{
				if($_SESSION['isAdmin']==true){
					echo "Administratorius:&nbsp;".$_SESSION['username']."&nbsp;&nbsp;&nbsp;&nbsp;";
				}else{
					echo "Vartotojas:&nbsp;".$_SESSION['username']."&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "Kreditai:&nbsp;".$_SESSION['credits'];
				}
				
				
			}
				
				
			
			
			
			
			
		
		
		
		?>
		
		
		<a class="linkOnBlack" href="logout.php">Atsijungti&nbsp;&nbsp;</a>
		
		</div>
		
		
	
	
	
	
	</div>
	<div class="clearfix"></div>
	




</body>