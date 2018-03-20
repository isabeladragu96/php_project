<?php
	
	$message="";
	$nume = "";
	$ticket_message="";
	$categorie = "";
	$error = "";
	$form = "";
	
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
		
		$query_nume_spectacole = "SELECT A.`NumeEveniment`, B.`NumeCategorie` 
								  FROM `eveniment` A INNER JOIN `categorie` B 
								  ON A.`IdCategorie` = B.`IdCategorie`";
								  
		$result_nume = mysqli_query($link, $query_nume_spectacole);
		
		if(!$result_nume){
			
			echo mysqli_error($link);
			
		} else {
			
				while($row = mysqli_fetch_array($result_nume)) {
			
						$nume .= " ".$row[0].".";
						$categorie .= " ".$row[1].".";

					}
					
		}
		
		$spectacol = explode('.',trim($nume));
		$tip = explode('.',trim($categorie));
		
		if (array_key_exists("buy", $_GET)){
			
			$form = '<form method="post">
					  <div class="form-group" >
						<label class="formular">Numele</label>
						<input type="text" class="form-control" placeholder="Numele" name="nume">
						
					  </div>
					  <div class="form-group" >
						<label  class="formular">Prenumele</label>
						<input type="text" class="form-control"  placeholder="Prenumele" name="prenume">
					  </div>
					  <div class="form-group" >
						<label class="formular">Numar de bilete dorite</label>
						<input type="text" class="form-control" placeholder="Introduceti numarul de bilete dorit" name="bilete">
					  </div>
					  <div class="form-group">				
									
							<input type = "submit" class="btn btn-success" name = "submit" value = "Submit">
							
						</div>
					
					</form>';
		
			$query = "SELECT A.`NumarCurentOcupanti`
					  FROM `eveniment` A
					  WHERE A.`NumeEveniment` = '".$_GET["eveniment"]."' 
					  AND A.`NumarCurentOcupanti` <= (SELECT B.`NumarMaximOcupanti` 
					  FROM `locatie` B
					  WHERE A.`IdLocatie` = B.`IdLocatie`)";
					  
					  
			$result = mysqli_query($link, $query);
		
			$query_maxim = "SELECT B.`NumarMaximOcupanti`
					  FROM `eveniment` A INNER JOIN `locatie` B 
					  ON A.`IdLocatie` = B.`IdLocatie`
					  WHERE A.`NumeEveniment` = '".$_GET["eveniment"]."'";
					  
			$result_maxim = mysqli_query($link, $query_maxim);
		

			
				if(!$result){
					
					echo mysqli_error($link);
					
				} 
				
				if(!$result_maxim){
					
					echo mysqli_error($link);
					
				} else if ($row_maxim = mysqli_fetch_array($result_maxim)){
					
					$diferenta = $row_maxim[0]-$row[0];
					
					$message = "Mai sunt ".$diferenta." locuri disponibile la ". '"'.$_GET["eveniment"].'"';
					
				} 
	
		}
			
		if(array_key_exists("submit", $_POST)){	
			
			if (!$_POST["nume"]) {
				
				$error .= "Numele este necesar!<br>";
			
			}
		
			if (!$_POST["prenume"]) {
				
				$error .= "Prenumele este necesar!<br>";
			
			}
			
			if (!$_POST["bilete"]) {
				
				$error .= "Numarul de bilete este necesar!<br>";
			
			} 
			if ($error != "") {
			
			$error = "<p>Trebuie completate toate campurile!<p>".$error;
		
			} else {
			
			
			
					$query = "UPDATE `eveniment` A INNER JOIN `locatie` B 
							  ON A.`IdLocatie` = B.`IdLocatie`
							  SET `NumarCurentOcupanti` = `NumarCurentOcupanti` + '".$_POST["bilete"]."'
							  WHERE A.`NumeEveniment` = '".$_GET["eveniment"]."'";
					
					
					$result = mysqli_query($link, $query);
					
					if(!$result){
								
						echo mysqli_error($link);
								
					} else {
								
							$ticket_message =  "Numar de bilete rezervate:  ".$_POST["bilete"];
							$locuri_ramase = $diferenta - $_POST["bilete"];
							$message = "Mai sunt ".$locuri_ramase." locuri disponibile la ". '"'.$_GET["eveniment"].'"';
								
					} 
					
					
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
	
	.formular { 
	
		font-size: 30px;
	
	}
	
	#bilet{
			
			margin-left: 60px;
			
		}
		
	#sector_dorit {
			
			margin-left: 45px;
			margin-bottom: 10px;
			
			
		}
	
	#button { 
			
			margin-top: 10px;
			margin-left: 60px;
		
		}

</style>

<?php include("navbar.php") ?>


<div class = "container">
	
	<?php
	
		echo '	  <form method="get" class="form-inline" id="bilet">
				  <label class="mr-sm-2" for="inlineFormCustomSelect" id="sector_dorit">Alegeti spectacolul dorit</label>
				  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="eveniment">';
				  
			for($i = 0; $i < sizeof($spectacol)-1; $i++) {
				echo '<option >'.$spectacol[$i].'</option>';
			}
				
				echo '</select>
					<input type="submit" class="btn btn-success" id="button" name="buy" value="Cumpara bilete">
					 </form><br><br>';
	?>	
		
		
	
	
	
	<div ><?php
		
		if ($error != "") {
				
				echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
			}
	
	?>
	</div>

		<div ><?php
		
		if ($ticket_message != "") {
				
				echo '<div class="alert alert-success" role="alert">'.$ticket_message.'</div>';
			}
	
	?>
	</div>
	
	
	
	<div ><?php if ($message != "") {
			
					echo '<div class="alert alert-info" role="alert">'.$message.'</div>';
					
				}
	
	?></div>
	
	<div ><?php
		
		if ($form != "") {
				
				echo $form;
			}
	
	?>
	</div>

	

	
	
	


</div>



<?php

	include("footer.php");


?>