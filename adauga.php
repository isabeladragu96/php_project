<?php

	$form = "";
	$message = "";
	$error = "";
	$nume= "";
	$catg = "";
	$loc = "";
	$date = "";
	$part = "";
	
	
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
	
	$query_nume_spectacole = "SELECT A.`NumeEveniment` 
								  FROM `eveniment` A  
								  ";
								  
	$query_categorii = "SELECT A.`NumeCategorie` 
								  FROM  `categorie` A
								  ";
								  
	$query_locatie = "SELECT A.`NumeLocatie` 
								  FROM `locatie` A  
								  ";
								  
	$query_data = "SELECT A.`Data` 
								  FROM `durata` A  
								  ";
	
		$result_nume = mysqli_query($link, $query_nume_spectacole);
		
		if(!$result_nume){
			
			echo mysqli_error($link);
			
		} else {
			
				while($row = mysqli_fetch_array($result_nume)) {
			
						$nume .= " ".$row[0].".";
						

					}
					
		}
		
		$result_nume = mysqli_query($link, $query_categorii);
		
		if(!$result_nume){
			
			echo mysqli_error($link);
			
		} else {
			
				while($row = mysqli_fetch_array($result_nume)) {
			
						$catg .= " ".$row[0].".";
						

					}
					
		}
		
		$result_nume = mysqli_query($link, $query_locatie);
		
		if(!$result_nume){
			
			echo mysqli_error($link);
			
		} else {
			
				while($row = mysqli_fetch_array($result_nume)) {
			
						$loc .= " ".$row[0].".";
						

					}
					
		}
		
		$result_nume = mysqli_query($link, $query_data);
		
		if(!$result_nume){
			
			echo mysqli_error($link);
			
		} else {
			
				while($row = mysqli_fetch_array($result_nume)) {
			
						$date .= " ".$row[0].".";
						

					}
					
		}
		
		
		$spectacol = explode('.',trim($nume));
		$categorie = explode('.', trim($catg));
		$locatie = explode('.', trim($loc));
		$data = explode('.', trim($date));
	
	

	
	if(array_key_exists("adauga", $_POST)) {
		
		
		
		if (!$_POST["nume"]) {
				
				$error .= "Numele este necesar!<br>";
			
			}
		
			if (!$_POST["buget"]) {
				
				$error .= "Bugetul este necesar!<br>";
			
			}
			
			if (!$_POST["categorie"]) {
				
				$error .= "Categoria este necesara!<br>";
			
			}
			
			if (!$_POST["locatie"]) {
				
				$error .= "Locatia este necesara!<br>";
			
			}
			
			
			
			
			if ($error != "") {
			
			$error = "<p>Trebuie completate toate campurile!<p>".$error;
		
			} else {
				
				$query = "INSERT INTO `eveniment` (`NumeEveniment`, `Buget`, `IdCategorie`, `IdLocatie`, `IdDurata`) VALUES ('".mysqli_real_escape_string($link, $_POST['nume'])."', 
				'".mysqli_real_escape_string($link, $_POST['buget'])."', '".$_POST['categorie']."', '".$_POST['locatie']."', '".$_POST['data']."')";
				
				$result = mysqli_query($link, $query);
				
				
				
					if(!$result ){ 
						echo mysqli_error($link);
						
					} else {
						
						$message = "A fost adaugat evenimentul ".$_POST['nume'];
						
					}
			}
			
			
		
	} else if(array_key_exists("sterge", $_POST)) {
		
		$query = "DELETE 
				 FROM `eveniment`
				 WHERE `NumeEveniment` = '".$_POST['eveniment']."'";
				 
				 $result = mysqli_query($link, $query);
				
				
				
					if(!$result ){ 
						echo mysqli_error($link);
						
					} else {
						
						$message = "A fost sters evenimentul ".$_POST['eveniment'];
						
					}
		
		
		
		
	} else if (array_key_exists("adaugalocatie", $_POST)) { 
	
	
	
	
			if (!$_POST["numeLoc"]) {
				
				$error .= "Numele este necesar!<br>";
			
			}
		
			if (!$_POST["strada"]) {
				
				$error .= "Strada este necesara!<br>";
			
			}
			
			if (!$_POST["numar"]) {
				
				$error .= "Numarul este necesar!<br>";
			
			}
			
			if (!$_POST["sector"]) {
				
				$error .= "Sectorul este necesar!<br>";
			
			}
			
			if (!$_POST["numarOcupanti"]) {
				
				$error .= "Numarul de ocupanti este necesar!<br>";
			
			}
			
			
			
			
			if ($error != "") {
			
			$error = "<p>Trebuie completate toate campurile!<p>".$error;
		
			} else {
				
			$query = "INSERT INTO `locatie` (`NumeLocatie`, `Strada`, `Numarul`, `Sectorul`, `NumarMaximOcupanti`) VALUES ('".mysqli_real_escape_string($link, $_POST['numeLoc'])."', 
				'".mysqli_real_escape_string($link, $_POST['strada'])."', '".$_POST['numar']."', '".$_POST['sector']."', '".$_POST['numarOcupanti']."')";
			

			$result = mysqli_query($link, $query);
				
				
				
					if(!$result ){ 
						echo mysqli_error($link);
						
					} else {
						
						$message = "A fost adaugata locatia ".$_POST['numeLoc'];
						
					}
				
			}
	
	} else if(array_key_exists("stergeLoc", $_POST)) {
		
		$query = "DELETE 
				 FROM `locatie`
				 WHERE `NumeLocatie` = '".$_POST['locatieSters']."'";
				 
				 $result = mysqli_query($link, $query);
				
				
				
					if(!$result ){ 
						echo mysqli_error($link);
						
					} else {
						
						$message = "A fost stearsa locatia ".$_POST['locatieSters'];
						
					}
		
		
		
		
	}
	
?>	

<style type="text/css">
		
		html { 
		  background: url(festival-fundal.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		
		p { 
		
			font-size: 25px;
		
		}
		
</style>

<?php include("navbar.php") ?>


<div class="container">



	<p> Adaugati un eveniment</p>
	
	<div ><?php if ($error != "") {
			
					echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
					
				}
	
	?></div>
	
	<div ><?php if ($message != "") {
			
					echo '<div class="alert alert-info" role="alert">'.$message.'</div>';
					
				}
	
	?></div>

	 <form method = 'post'>
		
		<div class='form-group'>
		
			<input class='form-control' name='nume' placeholder='Nume Eveniment'>
		
		</div>
		
		<div class='form-group'>
		
			<input class='form-control' name = 'buget' placeholder='Buget'>
		
		</div>

		
			<?php
	
		echo '	  
				  <label class="mr-sm-2" for="inlineFormCustomSelect" id="sector_dorit">Alegeti categoria </label>
				  <br>
				  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="categorie">';
				  
					for($i = 0; $i < sizeof($categorie)-1; $i++) {
						echo '<option value='.$i.' >'.$categorie[$i].'</option>';
					}
				
		echo '</select>';


		echo '	<br><br>  
				  <label class="mr-sm-2" for="inlineFormCustomSelect" id="sector_dorit">Alegeti locatia</label>
				  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="locatie">';
				  
					for($i = 0; $i < sizeof($locatie)-1; $i++) {
						echo '<option value='.$i.'>'.$locatie[$i].'</option>';
				}
		
		echo '</select>';
					 
					 
		
			
			echo '<br><br>	  
				  <label class="mr-sm-2" for="inlineFormCustomSelect" id="sector_dorit">Alegeti data</label>
				  <br>
				  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="data">';
				  
						for($i = 0; $i < sizeof($data)-1; $i++) {
							echo '<option value='.$i.'>'.$data[$i].'</option>';
						}
			echo '</select>';
				
		
		?>	
	
		<br><br>
		
		<div class='form-group'>				
									
			
			<input type = 'submit' class='btn btn-success' name = 'adauga' value = 'Adauga'>
							
		
		</div>
		
		<p> Adaugati o noua locatie</p>
		
		<form method = 'post'>
		
		<div class='form-group'>
		
			<input class='form-control' name='numeLoc' placeholder='Nume Locatie'>
		
		</div>
		
		<div class='form-group'>
		
			<input class='form-control' name = 'strada' placeholder='Strada'>
		
		</div>
		
		<div class='form-group'>
		
			<input class='form-control' name='numar' placeholder='Numarul'>
		
		</div>
		
		<div class='form-group'>
		
			<input class='form-control' name = 'sector' placeholder='Sector'>
		
		</div>
		
		<div class='form-group'>
		
			<input class='form-control' name = 'numarOcupanti' placeholder='Numar maxim ocupanti'>
		
		</div>
		
		<div class='form-group'>				
									
			
			<input type = 'submit' class='btn btn-success' name = 'adaugalocatie' value = 'Adauga'>
							
		
		</div>
		
		
		
	
		<p> Stergeti un eveniment</p>
		
		<?php
	
		echo '	  
				  <label class="mr-sm-2" for="inlineFormCustomSelect" id="sector_dorit">Alegeti spectacolul dorit</label>
				  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="eveniment">';
				  
			for($i = 0; $i < sizeof($spectacol)-1; $i++) {
				echo '<option >'.$spectacol[$i].'</option>';
			}
				
				echo '</select>
					<input type="submit" class="btn btn-success" id="button" name="sterge" value="Sterge">
					 <br><br>';
		
		?>	
		
		<p> Stergeti o locatie</p>
		
		<?php
	
		echo '	  
				  <label class="mr-sm-2" for="inlineFormCustomSelect" id="sector_dorit">Alegeti locatia dorita</label>
				  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="locatieSters">';
				  
			for($i = 0; $i < sizeof($locatie)-1; $i++) {
				echo '<option >'.$locatie[$i].'</option>';
			}
				
				echo '</select><br><br>
					<input type="submit" class="btn btn-success" id="button" name="stergeLoc" value="Sterge">
					 <br><br>';
		
		?>	
		
		
		
		
	</form>
	
	<br><br>
	
	
			
			
	
	
	
	
	
	
	

	

</div>





<?php

	include("footer.php");


?>	