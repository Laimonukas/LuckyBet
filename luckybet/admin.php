<html>
<head>
	<meta charset="UTF-8">
	<title>LuckyBet Admin</title>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/eventPagination.js"></script>
	<script src="js/timer.js"></script>
	<script src="js/adminSelect.js"></script>
	<script src="js/jsEditUserForm.js"></script>
</head>

<body>
	<?php 
		include('headerLogo.php'); 
		include('stickyHeaderLogedIn.php');
		
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		//check sessions
		if(isset($_SESSION['logedIn'])){
			if($_SESSION['logedIn']==false){
				header('Location: prisijungimas.php');
			}else{
				if($_SESSION['isAdmin']==false){
					header('Location: index.php');
				}
			}
		}else{
			header('Location: index.php');
		}
		
		
		//sql connection / get data
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";
		
		$conn = new mysqli($serverName, $username, $password,$dbName);
		if ($conn->connect_error) {
			die("Klaida: " . $conn->connect_error);
		} 
		//set char
		$conn->query("SET NAMES utf8");
		
		//get adverts
		$sql = "SELECT * FROM advertisement";
		
		
		$adResult = $conn->query($sql);
		//get customers
		$sql = "SELECT * FROM users";
		
		$userResult = $conn->query($sql);
		
		
		
		
		
	
	
	
		mysqli_close($conn);
	?>
	
	
	
	<div id="adminSelectContainer">
		<div id="adminSelectIvykiai" class="adminSelectButtons">Ivykiai</div>
	
		<div id="adminSelectStatymai" class="adminSelectButtons ">Statymai</div>
		
		<div id="adminSelectVartotojai" class="adminSelectButtons adminSelectButtonsActive">Vartotojai</div>
	
			
		<div id="adminSelectReklama" class="adminSelectButtons">Reklama
		
		
		
		
		
		
		</div>

		<div id="adminSelectSpecialus" class="adminSelectButtons">Specialus</div>
	</div>
	
	<div id="adminContainer">
		
		<div id="adminIvykiai" class="hidden">
			
			<div class="timer">
			
			
			</div><br>
			
			<div>Pridėti naują ivykį:<br>
					<form id="newEvent" action="eventPOST.php" method="post">
						Komandos: <input class="tableInput" type="text" name="eventX" required> ir 
						<input class="tableInput" type="text" name="eventY" required><br>
						Ivykio trukmė(minutės): <input class="tableInput" type="number" min="1" step="1" name="eventLength" required>
						<input id="eventSubmit" type="submit" class="buttonTypeC" value="Pridėti" ><br>
					</form>
			</div>
			<br>
			
			
			<div>
				
				Surasti ivykį:<br>
				Paieškos dalis: <input class="eventSearchInput tableInput" type="text">
				<input type="submit" class="eventSearchSubmit buttonTypeC" value="Ieškoti" ><br>
			</div>
			<br>
			
			<div class="adminEventTable">
			<?php
			
			$serverName='localhost';
			$username = "root";
			$password = "usbw";
			$dbName="luckybet";
	
			$conn = new mysqli($serverName, $username, $password,$dbName);
				if ($conn->connect_error) {
				die("Klaida: " . $conn->connect_error);
			} 
			
			//get count
			$sqlQuery = "SELECT COUNT(*) FROM `events`;";
			$result = $conn->query($sqlQuery);
			
			$r = $result->fetch_row();
			$numRows = $r[0];
			
			if($numRows<=0){
				echo "Šiuo metu sporto ivykių nėra.";
				return;
			}
			
			
			
			
			/*
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
		if ($eventCountResult->num_rows > 0) {
			$count=0;
			while($row = $eventCountResult->fetch_assoc()) {
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
		*/
			mysqli_close($conn);
			?>
			
			</div>
			<div class="adminEventPages">
			<?php
				//send to js
				echo '<script>';
				echo 'var numRows='.json_encode((int)$numRows).";";
				echo '</script>';
			?>
			</div>
			
		
		</div>
		<div id="adminStatymai" class="hidden">
			<div>
				<form id="findBet">
					Surasti statymą:
					<input type="text" name="betString">
					<input type="submit" value="Rasti"><br>
				</form>
				
			</div>
			
			<div>
				Statymai:<br>
			</div>
		
		</div>
		<div id="adminVartotojai" class="normal">
		
			
			<?php 
			
			echo "<table>";
				//headers
				echo "<tr>";
					echo "<th>Vartotojo ID</th>";
					echo "<th>Vardas</th>";
					echo "<th>Pavardė</th>";
					echo "<th>Slapyvardis</th>";
					echo "<th>Slaptažodis</th>";
					echo "<th>Kreditai</th>";
					echo "<th>Rolė</th>";
					echo "<th>------</th>";
				echo "</tr>";
			
			
			//data
			if ($userResult->num_rows > 0) {
				$count=0;
				while($row = $userResult->fetch_assoc()) {
					echo "<tr>";
					echo '<td><input id="id'.$count.'" class="tableInput readonly" type="text" name="id['.$count.']" value="'.$row['userID'].'" readonly></td>';
					echo '<td><input id="name'.$count.'" class="tableInput" type="text" name="name" value="'.$row['name'].'"></td>';
					echo '<td><input id="lastname'.$count.'" class="tableInput" type="text" name="surname" value="'.$row['surname'].'"></td>';
					echo '<td><input id="username'.$count.'" class="tableInput" type="text" name="username" value="'.$row['username'].'"></td>';
					echo '<td><input id="password'.$count.'" class="tableInput" type="text" name="password" value="'.$row['password'].'"></td>';
					echo '<td><input id="credits'.$count.'" class="tableInput" type="text" name="credits" value="'.$row['credits'].'"></td>';
					echo '<td><input id="role'.$count.'" class="tableInput" type="text" name="role" value="'.$row['role'].'"></td>';
					echo '<td><input  type="submit" id="form'.$count.'"  value="Redaguoti" class="buttonTypeC jsUserForm"></td>';
					echo "</tr>";
					$count++;
				}
			}else{
				echo "Irašų nėra";
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			echo "</table>";
			?>
			
			
			
			
			
			
			
		</div>
		<div id="adminReklama" class="hidden">
			<?php
				$adRowCount=$adResult->num_rows;
				if ($adRowCount ==0) {
					echo "Dabar reklama nenustatyta<br>";
				}else{
					$adResult = $adResult->fetch_assoc();
					echo "Dabartinė reklama:<br>";
					echo "<div class='advertShowDiv'>";
					echo "<img src='images/".$adResult['advertName'].".jpg' class='advertImg' alt='Reklama'><br>";
					echo "</div>";
					
				}
				
				echo "Pasirinkite kitą reklamą:<br>";
				echo "<div>";
				echo "<form action='advertPOST.php' method='post'>";
				$files = glob("images/*.*");
				for ($i=0; $i<count($files); $i++){
					$num = $files[$i];
					
					if($adRowCount >0){
						
						if($num==("images/".$adResult['advertName'].".jpg")){
							
						}else{
						
							$adname = str_replace("images/","",$num);
							$adname = str_replace(".jpg","",$adname);
							echo "<div class='advertSelectDiv'>";
							echo '<input class="advertImg" type="image" name="advert" value="'.$adname.'" alt="'.$adname.'" src="'.$num.'">';
							echo "</div>";
						}
					}else{
						$adname = str_replace("images/","",$num);
						$adname = str_replace(".jpg","",$adname);
						echo "<div class='advertSelectDiv'>";
						echo '<input class="advertImg" type="image" name="advert" value="'.$adname.'" alt="'.$adname.'" src="'.$num.'">';
						echo "</div>";
					}
					
					
					
				}
				
				
				
				
				
				
				echo "</form>";
				echo "</div>";
				
				
			
			
			
			
			
			

			?>
		</div>
		<div id="adminSpecialus" class="hidden">
			<div>
				<form id="special">
					Speciali komanda:
					<input type="text" name="specialString">
					<input type="submit" value="Siųsti"><br>
				</form>
				
				
			</div>
			<div>
				Komandos rezultatas:<br>
			</div>
		</div>
	
	
	
	</div>
	
	
	
	
	
	
	
	
	
	
	


</body>


</html>