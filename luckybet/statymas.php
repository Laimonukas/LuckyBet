<body>
	
	<div id="betContainer">
		<div>
		<?php
			
		//connection to sql
		
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		
		
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
			
			if(!isset($_SESSION["logedIn"])){
				echo "Norint atlikti statymą prisijunkite";
			}
			echo "<table>";
			echo "<tr>";
			echo "<th>Komanda X </th>";
			echo "<th>Komanda Y </th>";
			echo "<th>Koef X </th>";
			echo "<th>Koef Y </th>";
			if(isset($_SESSION["logedIn"])){
				echo "<th>Kreditai</th>";
				echo "<th>----</th>";
			}
			echo "</tr>";
			
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo '<td>'.$row['clubX'].'</td>';
				echo '<td>'.$row['clubY'].'</td>';
				echo '<td>'.$row['coefX'].'</td>';
				echo '<td>'.$row['coefY'].'</td>';
				if(isset($_SESSION["logedIn"])){
					echo '<td><input id="betValue'.$row['eventID'].'" class="tableInput" type="number" min="0" step="1" name="betValue" ></td>';
					echo '<td><input  type="submit" id="betForm'.$row['eventID'].'"  value="Statyti!" class="buttonTypeC placeBet"></td>';
				
				}
				
				echo "</tr>";
			}
			
			
			echo "</table>";
		} else {
			echo "Ivykių nėra";
		}
		
		
		
		
		
		
		
		?>
		
		</div>
	
	
	
	</div>
</body>