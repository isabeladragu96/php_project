<?php

	$names="";
	$data="";
	$tip="";
	
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
	
	$query = "SELECT A.NumeEveniment, (
				SELECT C.NumeCategorie
				FROM categorie C
				WHERE A.IdCategorie = C.IdCategorie
				) AS Categorie, (    
					SELECT B.Data 
					FROM durata B
					WHERE A.IdDurata = B.IdDurata
					) AS Data
				FROM eveniment A
                ORDER BY Data 
				";
				
	$result = mysqli_query($link, $query);
	
	if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				while($row = mysqli_fetch_array($result)) {
				
					$names .= " ".$row[0].".";
					$tip .= " ".$row[1].".";
					$data .= " ".$row[2].".";

				}
				
			}
			
	$even = explode('.',trim($names));
	
	$date = explode('.',trim($data));
	
	$type = explode('.',trim($tip));
	
	
	
?>	

<style type="text/css">

	html { 
		  background: url(festival-fundal.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
	
	.container {
		
		font-size: 18px;
		font-weight : bold;
		
	}
	
	#button { 
			
			margin-top: 10px;
			margin-left: 110px;
		
		}



</style>

<?php include("navbar.php") ?>


<div class="container">

	<h2>Cele mai recente evenimente din Bucuresti</h2>
	
	<br><br>
	
	<?php
	
		 echo "<ol>";
                 
				 for ($i = 0; $i < (sizeof($even)) - 1 ; $i++) {
					 
					 echo "<li>Numele: ".$even[$i]."<br> Categoria: ".$type[$i]."<br> Data: ".$date[$i]."</li>";
					 
				 }
    
		    echo "</ol>";
			
		echo '<br><br><br><br>
				  <form action="bilete.php" method="post" class="form-inline" >
					<input type="submit" class="btn btn-success" id="button"  value="Cumpara bilete">
					 </form><br><br>';
			
	
	?>

	
	


</div>


