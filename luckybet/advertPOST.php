<body>
<?php
//sql connection 
		$serverName='localhost';
		$username = "root";
		$password = "usbw";
		$dbName="luckybet";
		
		$conn = new mysqli($serverName, $username, $password,$dbName);
		if ($conn->connect_error) {
			die("Klaida: " . $conn->connect_error);
		} 
		
		
		$sql = "SELECT * FROM advertisement";
		$adResult = $conn->query($sql);
		
		if ($adResult->num_rows ==0){
			$stmt = $conn->prepare("INSERT INTO `advertisement`(`advertName`,`advertCreatorID`) 
									VALUES((?),(?))");
		}else{
			$stmt = $conn->prepare("UPDATE `advertisement` SET `advertName` = (?),`advertCreatorID` = (?)");
		}
		
		
		$stmt->bind_param('si', $adName,$creatorID); // 's' specifies the variable type => 'string'
		
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
			$creatorID=$_SESSION["userID"];
		}
		
		
		
		if(isset($_POST)){
			if(isset($_POST['advert'])){
				$adName=$_POST['advert'];
				$stmt->execute();
				$stmt->free_result();
				$stmt->close();
				mysqli_close($conn);
				header("Location: admin.php");
			}
			
		}
		
		
		
	
	
	
		mysqli_close($conn);





?>
</body>