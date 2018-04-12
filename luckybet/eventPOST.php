<body>
<?php 
if(isset($_POST)){
	if(isset($_POST['eventX'])&&isset($_POST['eventY'])&&isset($_POST['eventLength'])){
		
		if($_POST['eventLength']<1&&is_int($_POST['eventLength'])){
			echo "Klaida,minučių negali būti mažiau už 1.";
			return;
		}
		
		
		
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";
		
		$conn = mysqli_connect($serverName, $username, $password, $dbName);
		
		if (!$conn) {
			die("Prisijungti nepavyko: " . mysqli_connect_error());
			mysqli_close($conn);
			
			echo '<a href="registracija.php" class="linkOnBlack">Grįžti atgal</a><br>';
			return;
		}
		
		//set chars
		$conn->query("SET NAMES utf8");
		
		
		//prepared statements
		$stmt = $conn->prepare("INSERT INTO `events`(`clubX`,`clubY`,`coefX`,`coefY`,`betsForX`,`betsForY`,`startDate`,`endDate`) 
								values ((?),(?),1.5,1.5,0,0,(?),(?))");
		$stmt->bind_param('ssss', $clubX,$clubY,$startDate,$endDate);
		//set var
		$clubX=$_POST['eventX'];
		$clubY=$_POST['eventY'];
		
		date_default_timezone_set("Europe/Vilnius");
		
		$minutes_to_add = $_POST['eventLength'];

		$time = new DateTime(date("Y-m-d H:i:s"));
		$startDate=$time;
		$startDate=$startDate->format('Y-m-d H:i:s');
		
		$stamp=$time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
		$stamp = $stamp->format('Y-m-d H:i:s');
		$endDate=$stamp;
		
		
		
		$stmt->execute();
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
		header("Location: admin.php");

	
	}else{
		echo "Nenustatyti visi kintamieji";
		
	}
}else{
	echo "Klaida gaunant informaciją";
}






?>
</body>