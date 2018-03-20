<?php

	$names = "";
	$duration = "";
	$date = "";
	$hour = "";
	$error = "";
	$location = "";
	$street = "";
	$number = "";
	
	session_start();
	
	if (array_key_exists("id", $_COOKIE)) {
		
		$_SESSION['id'] = $_COOKIE['id'];
		
	}
	
	if (array_key_exists("id", $_SESSION)) {
		
		
	} else {
		
		header("Location: index.php");
		
	}
	
	include("header.php");
	
	include("connection.php");
	

	
		$query_toate_numele = "SELECT A.`NumeEveniment` FROM `eveniment` A INNER JOIN `categorie` B 
					 ON A.IdCategorie = B.IdCategorie 
					 WHERE B.`NumeCategorie` = 'Teatru'";
					 
		$query_toate_duratele = "SELECT B.`Data`, B.`Ora`, B.`Durata` FROM `eveniment` A INNER JOIN `durata` B 
						 ON A.IdDurata = B.IdDurata INNER JOIN `categorie` C 
						 ON (A.`IdCategorie` = C.`IdCategorie`) 
						 WHERE C.NumeCategorie = 'Teatru' "  ;
						 
		$query_toate_locatiile = "SELECT B.`NumeLocatie`, B.`Strada`, B.`Numarul` FROM `eveniment` A INNER JOIN `locatie` B 
								  ON A.IdLocatie = B.IdLocatie INNER JOIN `categorie` C 
								  ON A.IdCategorie = C.IdCategorie 
								  WHERE C.NumeCategorie = 'Teatru' " ;
		
	if (array_key_exists("submit", $_POST)) {
		
		if ($_POST['sector'] == "toate") {
			
			$result = mysqli_query($link, $query_toate_numele);
		
			if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				while($row = mysqli_fetch_array($result)) {
				
					$names .= " ".$row[0].".";

				}
				
			}
			
			
					
			$result = mysqli_query($link, $query_toate_duratele);
			
			if(!$result){
					
				echo mysqli_error($link);
					
					
			} else {
					
				while($row = mysqli_fetch_array($result)) {
					
					$date .= " ".$row[0].",";
						
					$hour .= " ".$row[1].",";
						
					$duration .= " ".$row[2].",";

				}
					
			}
			
			$result = mysqli_query($link, $query_toate_locatiile);
			
			if(!$result){
					
				echo mysqli_error($link);
					
					
			} else {
					
				while($row = mysqli_fetch_array($result)) {
					
					$location .= " ".$row[0].",";
						
					$street .= " ".$row[1].",";
						
					$number .= " ".$row[2].",";

				}
					
			}
				
				
		}
	
		$query_sector_nume = "SELECT A.`NumeEveniment` FROM `eveniment` A INNER JOIN `categorie` B 
					 ON A.IdCategorie = B.IdCategorie 
					 WHERE B.`NumeCategorie` = 'Teatru' AND '".$_POST['sector']."' = (SELECT C.`Sectorul` 
																						 FROM `locatie` C 
																						 WHERE C.`IdLocatie` = A.`IdLocatie`)" ;
				
		$result = mysqli_query($link, $query_sector_nume);
	
		if(!$result){
			
			echo mysqli_error($link);
			
		} else {
			
				while($row = mysqli_fetch_array($result)) {
			
						$names .= " ".$row[0].".";

					}
					
				if ($names == "") {
					
					$error = "Nu exista evenimente in acest sector!";
					
				}
				
			
		}
		
		$query_sector_durata = "SELECT B.`Data`, B.`Ora`, B.`Durata` FROM `eveniment` A INNER JOIN `durata` B 
					 ON A.IdDurata = B.IdDurata  
					 WHERE 'Teatru' = (SELECT C.NumeCategorie 
										FROM `categorie` C
										WHERE C.`IdCategorie` = A.`IdCategorie`) AND '".$_POST['sector']."' = (SELECT D.`Sectorul` 
																						 FROM `locatie` D
																						 WHERE D.`IdLocatie` = A.`IdLocatie`)" ;
		
		$result = mysqli_query($link, $query_sector_durata);
		
		if(!$result){
				
				echo mysqli_error($link);
				
		} else {
					
					while($row = mysqli_fetch_array($result)) {
				
						$date .= " ".$row[0].",";
						
						$hour .= " ".$row[1].",";
						
						$duration .= " ".$row[2].",";

					}
					
					if ($date == "" AND $hour == "" AND $duration = "") {
					
					$error = "Nu exista evenimente in acest sector!";
					
				}
					
				
			}
			
		$query_sector_locatie = "SELECT B.`NumeLocatie`, B.`Strada`, B.`Numarul` FROM `eveniment` A INNER JOIN `locatie` B 
								  ON A.IdLocatie = B.IdLocatie 
								  WHERE 'Teatru' = (SELECT C.NumeCategorie 
														FROM `categorie` C
														WHERE C.`IdCategorie` = A.`IdCategorie`) 
										AND B.`Sectorul` = '".$_POST['sector']."'";
								  
		$result = mysqli_query($link, $query_sector_locatie);
								  
		if(!$result){
					
				echo mysqli_error($link);
					
					
			} else {
					
				while($row = mysqli_fetch_array($result)) {
					
					$location .= " ".$row[0].",";
						
					$street .= " ".$row[1].",";
						
					$number .= " ".$row[2].",";

				}
					
			}
			
	} else 	{
		
		
		$result = mysqli_query($link, $query_toate_numele);
	
		if(!$result){
			
			
				
			echo mysqli_error($link);
			
			
			
			
		} else {
			
			
			while($row = mysqli_fetch_array($result)) {
			
				$names .= " ".$row[0].".";

			}
			
		}
				
			$result = mysqli_query($link, $query_toate_duratele);
		
			if(!$result){
				
				echo mysqli_error($link);
				
				
			} else {
				
				while($row = mysqli_fetch_array($result)) {
				
					$date .= " ".$row[0].",";
					
					$hour .= " ".$row[1].",";
					
					$duration .= " ".$row[2].",";

				}
				
			}
			
			$result = mysqli_query($link, $query_toate_locatiile);
			
			if(!$result){
					
				echo mysqli_error($link);
					
					
			} else {
					
				while($row = mysqli_fetch_array($result)) {
					
					$location .= " ".$row[0].",";
						
					$street .= " ".$row[1].",";
						
					$number .= " ".$row[2].",";

				}
					
			}
	
	
	}
		
	
	
?>

<style type="text/css">
		
		html { 
		  background: url(teatru-fundal.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		
		h1 {
		
			
			align: center;
			width: 500px;
			margin-left: -50px;
			margin-top : -40px;
			
		}
		
		#text {
			
			align: center;
		
		}
		
		#error {
			
			align: center;
			margin-top: 40px;
			height: 15px;
			
		}
		
		#nume {
			
			font-size: 30px;
			font-weight: bold;
			
		}
		
		#sector_dorit {
			
			margin-left: 45px;
			
			
		}
		
		#form { 
			
			margin-left: 40px;
		
		}
		
		#button { 
			
			margin-top: 10px;
			margin-left: 110px;
		
		}
		
		
		
</style>

<?php include("navbar.php") ?>

<div class = "container">

	<h1>Piese de teatru din Bucuresti</h1>
	
	<br>
	
	<form method="post" class="form-inline" id="form">
		
		<label class="mr-sm-2" for="inlineFormCustomSelect" id="sector_dorit">Alegeti sectorul dorit</label>
		
		<select class="custom-select mb-2 mr-sm-2 mb-sm-0" name = "sector" id="ceva">
			
			<option   value="1">1</option>
			<option   value="2">2</option>
			<option   value="3">3</option>
			<option   value="4">4</option>
			<option   value="5">5</option>
			<option   value="6">6</option>
			<option value="toate">Afisati toate evenimentele</option>
	
		</select>
		
		<div class="form-group">				
					
			<input type = "submit" class="btn btn-success" name = "submit" value = "Cauta">
			
		</div>
	
	</form>
	
	<div id="error"><?php if ($error != "") {
			
				echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

			}?></div>
			
			
	<div id = "text">
		
		<?php 
		
			$shows = explode('.',trim($names));
			
			$date_one = explode(',',trim($date));
			
			$hour_one = explode(',',trim($hour));
			
			$duration_one = explode(',',trim($duration));
			
			$location_one = explode(',',trim($location));
			
			$street_one = explode(',',trim($street));
			
			$number_one = explode(',',trim($number));
			
			$i = 0;
			
			
			while($i < sizeof($shows) - 1) { 
			
				echo '<div id="nume">'.$shows[$i].
					"</div><br>Data: ".$date_one[$i]."<br>Ora: ".$hour_one[$i]."<br>Durata: ".$duration_one[$i]."h".
					"<br>Locatie: ".$location_one[$i]."<br>Strada: ".$street_one[$i].", ".$number_one[$i]."<br><br><br>";
				
				$i++;
			
			}
			
			echo '<br><br><br><br>
				  <form action="bilete.php" method="post" class="form-inline" >
					<input type="submit" class="btn btn-success" id="button"  value="Cumpara bilete">
					 </form><br><br>';
			
		?>
		
	</div>
	
</div>

<?php include("footer.php")?>