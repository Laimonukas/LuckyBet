<?php
	if(isset($_POST)){
		
		if($_POST['postCredits']<0&&is_float($_POST['postCredits'])){
			echo "Klaida,kreditų negali būti mažiau už 0";
			return;
		}
		
		if($_POST['postRole']==0||$_POST['postRole']==1){			
		}else{
			
			echo "Klaida,rolė turi būti 0/1";
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
		
		$stmt = $conn->prepare("UPDATE `users` 
								SET `name` = (?),`surname` = (?),
									`username` = (?),`password` = (?),`credits` = (?)
									,`role` = (?)
								WHERE `userID` =".$_POST['postId'].";");
		$stmt->bind_param('ssssii', $name,$lastname,$userUsername,$userPassword,$credits,$role); // 's' specifies the variable type => 'string'
		
		$name=$_POST["postName"];
		$lastname=$_POST["postLastname"];
		$userUsername=$_POST["postUsername"];
		$userPassword=$_POST["postPassword"];
		$credits=$_POST["postCredits"];
		$role=$_POST["postRole"];
		
		$stmt->execute();
		
		$stmt->free_result();
		$stmt->close();
		mysqli_close($conn);
		
	}else{
		echo "Klaida gaunant duomenis";
	}




?>
