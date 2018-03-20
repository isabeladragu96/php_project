<?php

	$variable = "";
	$variable1 = "";
	$variable2 = "";
	$variable3 = "";
	$variable4 = "";

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
	
	
	
	
	
?>	

<style type="text/css">

	html { 
		  background: url(festival-fundal.jpg) no-repeat center center fixed; 
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
		
	#tip {
		
		font-size: 20px;
		
	}



</style>

<?php include("navbar.php") ?>


<div class="container">
	
	<h1>Sponsorii evenimentelor</h1>
	
	<br>
	
	<div id="tip">
			
		<p><strong>Sponsorii spectacolelor de teatru sunt: </strong></p>
		
		<?php
		
			$query = "SELECT DISTINCT B.NumeSponsor 
					  FROM `eveniment` A INNER JOIN (`sponsori` B INNER JOIN `eveniment_sponsor` C ON B.IdSponsori = C.IdSponsori) 
					  ON A.IdEveniment = C.IdEveniment 
					  WHERE A.`IdCategorie` = (SELECT D.`IdCategorie` 
                                     FROM `categorie` D 
                                     WHERE D.`NumeCategorie` = 'Teatru')";
					 
			$result = mysqli_query($link, $query);
			
			if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				while($row = mysqli_fetch_array($result)) {
				
					$variable .= " ".$row[0].".";

				}
				
			}
			
			$names = explode('.',trim($variable));
			
			 echo '<ol class="tip">';
                 
				 for ($i = 0; $i < (sizeof($names)) - 1 ; $i++) {
					 
					 echo "<li>".$names[$i]."</li>";
					 
				 }
    
		    echo  "</ol>";
		
		?>
		
		<p><strong>Sponsorii spectacolelor de opera sunt:</strong> </p>
		
		<?php
		
			$query = "SELECT DISTINCT B.NumeSponsor 
					  FROM `eveniment` A INNER JOIN (`sponsori` B INNER JOIN `eveniment_sponsor` C ON B.IdSponsori = C.IdSponsori) 
					  ON A.IdEveniment = C.IdEveniment 
					  WHERE A.`IdCategorie` = (SELECT D.`IdCategorie` 
                                     FROM `categorie` D 
                                     WHERE D.`NumeCategorie` = 'Opera')";
					 
			$result = mysqli_query($link, $query);
			
			if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				while($row = mysqli_fetch_array($result)) {
				
					$variable1 .= " ".$row[0].".";

				}
				
			}
			
			$names = explode('.',trim($variable1));
			
			 echo "<ol>";
                 
				 for ($i = 0; $i < (sizeof($names)) - 1 ; $i++) {
					 
					 echo "<li>".$names[$i]."</li>";
					 
				 }
    
		    echo "</ol>";
			
			
		
		?>
		
		<p><strong>Sponsorii evenimentelor tip concerte sunt: </strong></p>
		
		<?php
		
			$query = "SELECT DISTINCT B.NumeSponsor 
					  FROM `eveniment` A INNER JOIN (`sponsori` B INNER JOIN `eveniment_sponsor` C ON B.IdSponsori = C.IdSponsori) 
					  ON A.IdEveniment = C.IdEveniment 
					  WHERE A.`IdCategorie` = (SELECT D.`IdCategorie` 
                                     FROM `categorie` D 
                                     WHERE D.`NumeCategorie` = 'Concert')";
					 
			$result = mysqli_query($link, $query);
			
			if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				while($row = mysqli_fetch_array($result)) {
				
					$variable2 .= " ".$row[0].".";

				}
				
			}
			
			$names = explode('.',trim($variable2));
			
			 echo "<ol>";
                 
				 for ($i = 0; $i < (sizeof($names)) - 1 ; $i++) {
					 
					 echo "<li>".$names[$i]."</li>";
					 
				 }
    
		    echo "</ol>";
		
		?>
		
		<p><strong>Sponsorii evenimentelor tip festival sunt: </strong></p>
		
		<?php
		
			$query = "SELECT DISTINCT B.NumeSponsor 
					  FROM `eveniment` A INNER JOIN (`sponsori` B INNER JOIN `eveniment_sponsor` C ON B.IdSponsori = C.IdSponsori) 
					  ON A.IdEveniment = C.IdEveniment 
					  WHERE A.`IdCategorie` = (SELECT D.`IdCategorie` 
                                     FROM `categorie` D 
                                     WHERE D.`NumeCategorie` = 'Festival')";
					 
			$result = mysqli_query($link, $query);
			
			if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				while($row = mysqli_fetch_array($result)) {
				
					$variable3 .= " ".$row[0].".";

				}
				
			}
			
			$names = explode('.',trim($variable3));
			
			 echo "<ol>";
                 
				 for ($i = 0; $i < (sizeof($names)) - 1 ; $i++) {
					 
					 echo "<li>".$names[$i]."</li>";
					 
				 }
    
		     echo "</ol>";
		
		?>
		
		<p><strong>Sponsorii evenimentelor tip expozitii sunt: </strong></p>
		
		<?php
		
			$query = "SELECT DISTINCT B.NumeSponsor 
					  FROM `eveniment` A INNER JOIN (`sponsori` B INNER JOIN `eveniment_sponsor` C ON B.IdSponsori = C.IdSponsori) 
					  ON A.IdEveniment = C.IdEveniment 
					  WHERE A.`IdCategorie` = (SELECT D.`IdCategorie` 
                                     FROM `categorie` D 
                                     WHERE D.`NumeCategorie` = 'Expozitie')";
					 
			$result = mysqli_query($link, $query);
			
			if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				while($row = mysqli_fetch_array($result)) {
				
					$variable4 .= " ".$row[0].".";

				}
				
			}
			
			$names = explode('.',trim($variable4));
			
			 echo "<ol>";
                 
				 for ($i = 0; $i < (sizeof($names)) - 1 ; $i++) {
					 
					 echo "<li>".$names[$i]."</li>";
					 
				 }
    
		    echo "</ol>";
		
		?>
		
		
	
	</div>



</div>
