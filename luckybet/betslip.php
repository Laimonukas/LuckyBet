<body>
<div id="betslipContainer">
	<div>
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
					
					$sql = "SELECT advertName FROM advertisement";
		
					$adResult = $conn->query($sql);
					$adResult = $adResult->fetch_assoc();
					echo '<img src="images/'.$adResult['advertName'].'.jpg" alt="reklama" class="advertImg">';
					
					mysqli_close($conn);
					
			}else{
				echo "Statymu istorija:";
			}
		
		?>
	</div>
</div>
</body>