<?php
if(isset($_POST['toSelect'])){
	
	if($_POST['toSelect']=="events"&&isset($_POST['pageNum'])&&isset($_POST['numToShow'])){
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";

		$conn = new mysqli($serverName, $username, $password,$dbName);
			if ($conn->connect_error) {
			die("Klaida: " . $conn->connect_error);
		} 
		$conn->query("SET NAMES utf8");
		
		$stmt = $conn->prepare("SELECT * FROM `events` LIMIT ?,?");
		
		
		
		
		$stmt->bind_param('ii', $startId,$howManyToShow);
		
		
		$startId = ($_POST['pageNum']-1)*$_POST['numToShow'];
		$howManyToShow = $_POST['numToShow'];
		$stmt->execute();
		$result = $stmt->get_result();
		
		
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
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
	}
	
	
	if($_POST['toSelect']=="searchEventsCount"){
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";

		$conn = new mysqli($serverName, $username, $password,$dbName);
			if ($conn->connect_error) {
			die("Klaida: " . $conn->connect_error);
		} 
		$conn->query("SET NAMES utf8");
		
		$stmt = $conn->prepare("CALL searchInEvents(?,?,?);");
		
		$stmt->bind_param('sii', $searchValue,$x,$y);
		$x=0;
		$y=0;
		$searchValue= '%'.$_POST['searchValue'].'%';
		$stmt->execute();
		$result = $stmt->get_result();
		
		echo $result->num_rows;
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
		
		
		
		
	}
	
	
	if($_POST['toSelect']=="searchEvents"){
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";

		$conn = new mysqli($serverName, $username, $password,$dbName);
			if ($conn->connect_error) {
			die("Klaida: " . $conn->connect_error);
		} 
		$conn->query("SET NAMES utf8");
		
		$stmt = $conn->prepare("CALL searchInEvents(?,?,?);");
		
		$stmt->bind_param('sii', $searchValue,$startId,$howManyToShow);
		
		
		$startId = ($_POST['pageNum']-1)*$_POST['numToShow'];
		$howManyToShow = $_POST['numToShow'];;
		
		
		$searchValue= '%'.$_POST['searchValue'].'%';
		$stmt->execute();
		$result = $stmt->get_result();
		
		$searchValue= $_POST['searchValue'];
		echo "<table>";
				//headers
			
		
		
		//data
		if ($result->num_rows > 0) {
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
			$count=0;
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				if(strpos(strtolower($row['eventID']),strtolower($searchValue)) !== false){
					echo '<td><input id="eventId'.$count.'" class="tableInput readonly blue" type="text" name="eventId['.$count.']" value="'.$row['eventID'].'" readonly></td>';
				}else{
					echo '<td><input id="eventId'.$count.'" class="tableInput readonly" type="text" name="eventId['.$count.']" value="'.$row['eventID'].'" readonly></td>';
				}
				
				if(strpos(strtolower($row['clubX']), strtolower($searchValue)) !== false){
					echo '<td><input id="clubX'.$count.'" class="tableInput blue" type="text" name="clubX" value="'.$row['clubX'].'"></td>';
				}else{
					echo '<td><input id="clubX'.$count.'" class="tableInput" type="text" name="clubX" value="'.$row['clubX'].'"></td>';
				}
				
				if(strpos(strtolower($row['clubY']), strtolower($searchValue)) !== false){
					echo '<td><input id="clubY'.$count.'" class="tableInput blue" type="text" name="clubY" value="'.$row['clubY'].'"></td>';
				}else{
					echo '<td><input id="clubY'.$count.'" class="tableInput" type="text" name="clubY" value="'.$row['clubY'].'"></td>';
				}
				
				
				
				echo '<td><input id="koefX'.$count.'" class="tableInput" type="number" min="1" step="0.1" name="koefX" value="'.$row['coefX'].'"></td>';
				echo '<td><input id="koefY'.$count.'" class="tableInput" type="number" min="1" step="0.1" name="koefY" value="'.$row['coefY'].'"></td>';
				echo '<td><input id="betsForX'.$count.'" class="tableInput" type="number" min="0" step="1" name="betsForX" value="'.$row['betsForX'].'"></td>';
				echo '<td><input id="betsForY'.$count.'" class="tableInput" type="number" min="0" step="1" name="betsForY" value="'.$row['betsForY'].'"></td>';
				
				if(strpos(strtolower($row['startDate']), strtolower($searchValue)) !== false){
					echo '<td><input id="startDate'.$count.'" class="tableInput blue" type="text" name="startDate" value="'.$row['startDate'].'"></td>';
				}else{
					echo '<td><input id="startDate'.$count.'" class="tableInput" type="text" name="startDate" value="'.$row['startDate'].'"></td>';
				}
				if(strpos(strtolower($row['endDate']), strtolower($searchValue)) !== false){
					echo '<td><input id="endDate'.$count.'" class="tableInput blue" type="text" name="endDate" value="'.$row['endDate'].'"></td>';
				}else{
					echo '<td><input id="endDate'.$count.'" class="tableInput" type="text" name="endDate" value="'.$row['endDate'].'"></td>';
				}
				
				if(strpos(strtolower($row['winner']), strtolower($searchValue)) !== false){
					echo '<td><input id="winner'.$count.'" class="tableInput blue" type="text" name="winner" value="'.$row['winner'].'"></td>';
				}else{
					echo '<td><input id="winner'.$count.'" class="tableInput" type="text" name="winner" value="'.$row['winner'].'"></td>';
				}
				
				echo '<td><input  type="submit" id="eventForm'.$count.'"  value="Redaguoti" class="buttonTypeC jsEventForm"></td>';
				echo "</tr>";
				$count++;
			}
		}else{
			echo "Ivykių nėra";
		}
		
		
		
		echo "</table>";
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
	}
	
}
?>