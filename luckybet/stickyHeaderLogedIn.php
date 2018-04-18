
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
			
			$serverName='localhost';
			$username = "root";
			$password = "usbw";
			$dbName="luckybet";
	
			$conn = mysqli_connect($serverName, $username, $password,$dbName);
		
			if (!$conn) {
				die("Prisijungti nepavyko: " . mysqli_connect_error());
				mysqli_close($conn);
			
				echo '<a href="prisijungimas.php" class="linkOnBlack">Grįžti atgal</a><br>';
				return;
			}
			$sqlQuery = "SELECT `credits` FROM `users` WHERE `userID`=".$_SESSION['userID'];
			$result = $conn->query($sqlQuery);
			
			while($row = $result->fetch_array()){
				$_SESSION['credits'] = $row['credits'];
			}
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



