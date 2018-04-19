<body>
	<div class="betHistory">
		<?php
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if(isset($_SESSION["logedIn"])==false){
			$serverName='localhost';
			$username = "root";
			$password = "usbw";
			$dbName="luckybet";

			$conn = new mysqli($serverName, $username, $password,$dbName);
			if ($conn->connect_error) {
				die("Klaida: " . $conn->connect_error);
			} 
			$conn->query("SET NAMES utf8");
			
			$sql = "SELECT advertName FROM advertisement";

			$adResult = $conn->query($sql);
			$adResult = $adResult->fetch_assoc();
			echo '<img src="images/'.$adResult['advertName'].'.jpg" alt="reklama" class="advertImg">';
			
			mysqli_close($conn);
					
		}else{
			
			$serverName='localhost';
			$username = "root";
			$password = "usbw";
			$dbName="luckybet";

			$conn = new mysqli($serverName, $username, $password,$dbName);
			if ($conn->connect_error) {
				die("Klaida: " . $conn->connect_error);
			} 
			$conn->query("SET NAMES utf8");
			
			$sqlQuery = "SELECT `selectedClub`,`betID`,`betOutcome`,`betWon`,`betPlannedWin`,`clubX`,`clubY` 
						FROM `bets` INNER JOIN `events` ON `bets`.`eventID` = `events`.`eventID`
						WHERE `userID`=".$_SESSION["userID"]." ORDER BY `betID` DESC LIMIT 5;";
			
			$result = $conn->query($sqlQuery);
			
			if($result->num_rows > 0){
				echo "Paskutiniai statymai:<br>";
				
				
				
				while($row = $result->fetch_assoc()){
					switch((int)$row['betWon']){
						case 1:
							if($row['selectedClub']=="x"){
								echo "<p class='blue'><b>".$row['clubX']."</b> vs. ".$row['clubY']."<br>";
							}else{
								echo "<p class='blue'>".$row['clubX']." vs. <b>".$row['clubY']."</b><br>";
							}
							echo "Laimėta suma: ".$row['betPlannedWin']."</p><br>";
							break;
						case 2:
							if($row['selectedClub']=="x"){
								echo "<p class='orangeRed'><b>".$row['clubX']."</b> vs. ".$row['clubY']."<br>";
							}else{
								echo "<p class='orangeRed'>".$row['clubX']." vs. <b>".$row['clubY']."</b><br>";
							}
							
							echo "Pralaimėtas</p><br>";
							break;
						case 0:
							if($row['selectedClub']=="x"){
								echo "<p><b>".$row['clubX']."</b> vs. ".$row['clubY']."<br>";
							}else{
								echo "<p>".$row['clubX']." vs. <b>".$row['clubY']."</b><br>";
							}
							
							echo "Ivykis dar vyksta</p><br>";
							break;
					}
				}
			}else{
				echo "Statymų nerasta";
			}
			
			
			mysqli_close($conn);
		}
		
		?>
	</div>
</body>