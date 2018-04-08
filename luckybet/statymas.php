<body>
	
	<div id="betContainer">
		<div>
		<?php
			
		//connection to sql
		
		
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";
		
		$conn = mysqli_connect($serverName, $username, $password,$dbName);
		
		if (!$conn) {
			die("Prisijungti nepavyko: " . mysqli_connect_error());
			mysqli_close($conn);
			
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		
		$sqlQuery="SELECT * FROM events WHERE endDate < now()";
		$result = $conn->query($sqlQuery);

		if ($result->num_rows > 0) {
			echo "Dabar vykstantys ivykiai:";
			echo $result->num_rows;
		} else {
			echo "Ivykių nėra";
		}
		
		
		
		
		
		?>
		
		</div>
	
	
	
	</div>
</body>