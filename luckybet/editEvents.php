<?php
function isDate($value) {
    if (!$value) {
        return false;
    }
	date_default_timezone_set("Europe/Vilnius");
    return (date('Y-m-d H:i:s', strtotime($value)) == $value);
}

	if(isset($_POST)){
		
		if($_POST['postKoefX']<0&&is_float($_POST['postKoefX'])&&
			$_POST['postKoefY']<0&&is_float($_POST['postKoefY'])){
			echo "Klaida,koeficientai negali būti mažesni už 0";
			return;
		}
		if($_POST['postBetsForX']<0&&is_float($_POST['postBetsForX'])&&
			$_POST['postBetsForY']<0&&is_float($_POST['postBetsForY'])){
			echo "Klaida,statymų kiekis negali būti mažesnis už 0";
			return;
		}
		if(isDate($_POST['postStartDate'])==false||isDate($_POST["postEndDate"])==false){
			echo "Blogas datos formatas";
			return;
		}
		
		
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";
		
		$conn = new mysqli($serverName, $username, $password,$dbName);
		if ($conn->connect_error) {
			die("Klaida: " . $conn->connect_error);
		} 
		
		$stmt = $conn->prepare("UPDATE `events` 
								SET `clubX` = (?),`clubY` = (?),
									`coefX` = (?),`coefY` = (?),`betsForX` = (?)
									,`betsForY` = (?),`startDate`=(?),`endDate`=(?)
								WHERE `eventID` =".$_POST['postEventId'].";");
		$stmt->bind_param('ssddiiss',$clubX,$clubY,$koefX,$koefY,$betsForX,$betsForY,$startDate,$endDate);
		
		$clubX=$_POST["postClubX"];
		$clubY=$_POST["postClubY"];
		$koefX=$_POST["postKoefX"];
		$koefY=$_POST["postKoefY"];
		$betsForX=$_POST["postBetsForX"];
		$betsForY=$_POST["postBetsForY"];
		$startDate=$_POST["postStartDate"];
		$endDate=$_POST["postEndDate"];
		
		$stmt->execute();
		
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
		echo "Ivykis sekmingai pakeistas";
	}else{
		echo "Klaida gaunant duomenis";
	}




?>
