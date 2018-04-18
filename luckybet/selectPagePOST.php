<?php
if(isset($_POST['toSelect'])&&isset($_POST['pageNum'])&&isset($_POST['numToShow'])){
	
	if($_POST['toSelect']=="events"){
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";

		$conn = new mysqli($serverName, $username, $password,$dbName);
			if ($conn->connect_error) {
			die("Klaida: " . $conn->connect_error);
		} 
		$conn->query("SET NAMES utf8");
		//get count
		$sqlQuery = "SELECT * FROM `events` LIMIT ".($_POST['pageNum']-1)*$_POST['numToShow'].",".$_POST['numToShow'].";";
		$result = $conn->query($sqlQuery);
		
		
		
		
		echo "<table>";
				//headers
			echo "<tr>";
				echo "<th>Ivykio ID</th>";
				echo "<th>Komanda X</th>";
				echo "<th>Komanda Y</th>";
				echo "<th>Koeficientas X</th>";
				echo "<th>Koeficientas Y</th>";
				echo "<th>Statė už X</th>";
				echo "<th>Statė už Y</th>";
				echo "<th>Pradžios laikas</th>";
				echo "<th>Pabaigos laikas</th>";
				echo "<th>Laimėtojas</th>";
				echo "<th>------</th>";
			echo "</tr>";
		
		
		//data
		if ($result->num_rows > 0) {
			$count=0;
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo '<td><input id="eventId'.$count.'" class="tableInput readonly" type="text" name="eventId['.$count.']" value="'.$row['eventID'].'" readonly></td>';
				echo '<td><input id="clubX'.$count.'" class="tableInput" type="text" name="clubX" value="'.$row['clubX'].'"></td>';
				echo '<td><input id="clubY'.$count.'" class="tableInput" type="text" name="clubY" value="'.$row['clubY'].'"></td>';
				echo '<td><input id="koefX'.$count.'" class="tableInput" type="number" min="1" step="0.1" name="koefX" value="'.$row['coefX'].'"></td>';
				echo '<td><input id="koefY'.$count.'" class="tableInput" type="number" min="1" step="0.1" name="koefY" value="'.$row['coefY'].'"></td>';
				echo '<td><input id="betsForX'.$count.'" class="tableInput" type="number" min="0" step="1" name="betsForX" value="'.$row['betsForX'].'"></td>';
				echo '<td><input id="betsForY'.$count.'" class="tableInput" type="number" min="0" step="1" name="betsForY" value="'.$row['betsForY'].'"></td>';
				echo '<td><input id="startDate'.$count.'" class="tableInput" type="text" name="startDate" value="'.$row['startDate'].'"></td>';
				echo '<td><input id="endDate'.$count.'" class="tableInput" type="text" name="endDate" value="'.$row['endDate'].'"></td>';
				echo '<td><input id="winner'.$count.'" class="tableInput" type="text" name="winner" value="'.$row['winner'].'"></td>';
				echo '<td><input  type="submit" id="eventForm'.$count.'"  value="Redaguoti" class="buttonTypeC jsEventForm"></td>';
				echo "</tr>";
				$count++;
			}
		}else{
			echo "Ivykių nėra";
		}
		
		
		
		echo "</table>";
		mysqli_close($conn);
	}
	
	
	
	
	
}
?>