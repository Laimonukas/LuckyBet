<html>
<body>
	<?php 
		
		
		
		$servername = "localhost";
		$username = "root";
		$password = "usbw";
		$dbname = "luckybet";
			
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		
		// Check connection
		
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		date_default_timezone_set("Europe/Vilnius");
		
			if(empty($_POST['komandaX'])){
				echo "Truksta X komandos<br>";
			}
			else{
				$komandaX=$_POST['komandaX'];
			}
			
			if(empty($_POST['komandaY'])){
				echo "Truksta Y komandos<br>";
			}
			else{
				$komandaY=$_POST['komandaY'];
			}
			if(!empty($_POST['komandaX'])&&!empty($_POST['komandaY'])){
				$koefX=1.5;
				$koefY=1.5;
				$statytaUzX=0;
				$statytaUzY=0;
				$pradzia=date("Y-m-d H:i:s");
				$pabaiga=date('Y-m-d H:i:s',strtotime($pradzia.'+ 1 minute'));
			
				$sql = "INSERT INTO ivykiai (komandaX, komandaY,koefX,koefY,statytaX,statytaY,pradzia,pabaiga)
					VALUES ('".$komandaX."', '".$komandaY."', ".$koefX.",".$koefY.", ".$statytaUzX.",
					".$statytaUzY.", '".$pradzia."','".$pabaiga."')";
				
				if (mysqli_query($conn, $sql)) {
					mysqli_close($conn);
					
					
					header('location: index.php');
					
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
		
			}
			
	
		
		
		

		
	
		
		mysqli_close($conn);
	?>
	<br>
	<a href="index.php">Go back</a>
	
</body>
</html>