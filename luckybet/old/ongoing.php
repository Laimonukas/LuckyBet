<html>
<head>
</head>
<body>


<div class="whiteDiv">
	
	<h3>Dabar vykstantys ivykiai:</h3>
	
	<?php
		date_default_timezone_set("Europe/Vilnius");
		$servername = "localhost";
		$username = "root";
		$password = "usbw";
		$dbname = "luckybet";
		
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$sql="SELECT * FROM ivykiai";
		
		
		
		
		
		
		
		
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$result=	mysqli_query($conn,$sql);
		$count = 0;
		if (mysqli_num_rows($result)>0) {
			
			while($row = mysqli_fetch_assoc($result)) {
				
				
				if(strtotime($row["pabaiga"])>strtotime(date("Y-m-d H:i:s"))){
					echo "IvykioID: " . $row["ivykioID"]. " KomandaX: ".$row["komandaX"] ;
					echo " KomandaY: " . $row["komandaY"]. " KoeficientasX: ".$row["koefX"] ;
					echo " KoeficientasY: " . $row["koefY"]. " State uz X: ".$row["statytaX"] ;
					echo " State uz Y: " . $row["statytaY"]. " Ivykio pradzia: ".$row["pradzia"] ;
					echo " Ivykio pabaiga: " . $row["pabaiga"]. "<br>" ;
					$count++;
				}else{
					if($row["laimetojas"]==NULL&&strtotime($row["pabaiga"])<strtotime(date("Y-m-d H:i:s"))){
						$randomNum = mt_rand(1,2);
						if($randomNum==2){
							mysqli_query($conn,"UPDATE ivykiai SET laimetojas = \"".$row["komandaX"]."\" WHERE ivykioID =".$row["ivykioID"]);
						}else{
							mysqli_query($conn,"UPDATE ivykiai SET laimetojas = \"".$row["komandaY"]."\" WHERE ivykioID =".$row["ivykioID"]);
						}
						
						
					}
					
				}
				
				
				
				
				
			}
					
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
			if($count==0){
					echo "<h3>No ongoing events</h3><br>";
			}
		
		mysqli_close($conn);
		
	 
	?>
	
</div>






</body>
</html>