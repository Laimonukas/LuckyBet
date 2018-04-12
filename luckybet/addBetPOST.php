<?php
if(isset($_POST)){
	if (session_status() == PHP_SESSION_NONE) {
			session_start();
	}
	//check values
	if(isset($_POST['betSum'])&&isset($_POST['eventId'])&&isset($_POST['club'])){
		$betSum = $_POST['betSum'];
		$eventId = $_POST['eventId'];
		$userId = $_SESSION["userID"];
		$selectedClub = $_POST['club'];
		
		
		//validation
		if(!is_numeric($betSum)||$betSum<0||$_SESSION['credits']-$betSum<0){
			echo "Bloga statymo suma/Nepakanka kreditų";
			return;
		}
		
		
		//sql connection
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";
		
		$conn = mysqli_connect($serverName, $username, $password,$dbName);
		
		if (!$conn) {
			die("Prisijungti nepavyko: " . mysqli_connect_error());
			mysqli_close($conn);
			return;
		}
		//set charset
		//mysql_query("SET character_set_results = 'utf8mb4', character_set_client = 'utf8mb4', character_set_connection = 'utf8mb4', character_set_database = 'utf8mb4', character_set_server = 'utf8mb4'", $conn);
		$conn->query("SET NAMES utf8");
		//query to get current event data
		$sqlQuery="SELECT eventId,clubX,clubY,coefX,coefY FROM events WHERE endDate > now() AND eventId=".$eventId;
		$result = $conn->query($sqlQuery);
		
		if($result->num_rows<=0){
			echo "Ivykis nerastas/pasibeiges";
			return;
		}else{
			while($row = $result->fetch_assoc()){
				if($selectedClub=="x"){
					$coef = $row['coefX'];
					$club = $row['clubX'];
				}else{
					$coef = $row['coefY'];
					$club = $row['clubY'];
				}
				
			}
		}
		
		date_default_timezone_set("Europe/Vilnius");
		$time = new DateTime(date("Y-m-d H:i:s"));
		$time = $time->format('Y-m-d H:i:s');
		
		//creating bet
		$stmt = $conn->prepare("INSERT INTO `bets`(`userID`,`eventID`,`betSum`,`betCoef`,`betPlannedWin`,`betOutcome`,`betTime`) 
								values ((?),(?),(?),(?),(?),(?),(?))");
		$stmt->bind_param('iidddss',$userId,$eventId,$betSum,$coef,$win,$club,$time);
		
		$win=$betSum*$coef;
		$stmt->execute();
		
		
		//updating event
		if($selectedClub=="x"){
			$sqlQuery="UPDATE `events` SET `betsForX`=`betsForX`+1 WHERE `eventID`=".$eventId.";";
			$sqlQuery.="UPDATE `events` SET `coefX`= CASE WHEN `coefX`-(`coefX`/100)>= 1.05 THEN `coefX`-(`coefX`/100) ELSE `coefX` END WHERE `eventID`=".$eventId.";";
			$sqlQuery.="UPDATE `events` SET `coefY`=`coefY`+(`coefY`/100) WHERE `eventID`=".$eventId.";";
		}else{
			$sqlQuery="UPDATE `events` SET `betsForY`=`betsForY`+1 WHERE `eventID`=".$eventId.";";
			$sqlQuery.="UPDATE `events` SET `coefY`= CASE WHEN `coefY`-(`coefY`/100)>= 1.05 THEN `coefY`-(`coefY`/100) ELSE `coefY` END WHERE `eventID`=".$eventId.";";
			$sqlQuery.="UPDATE `events` SET `coefX`=`coefX`+(`coefX`/100) WHERE `eventID`=".$eventId.";";
		}
		//deduct credits from user balance
		$sqlQuery.="UPDATE `users` SET `credits`=`credits`-".$betSum." WHERE `userID` = ".$userId.";";
		
		$conn->multi_query($sqlQuery);
		
		(float)$_SESSION["credits"]-=$betSum;
		
		echo "Statymas priimtas";
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
		
		
		
		
	}else{
		echo "Klaida atliekant statymą";
	}
	

	
}
?>