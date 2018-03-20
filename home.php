<?php

	
	$error = "";
	$detalii = "";
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
	
	if (array_key_exists("submit", $_POST)){
	
	
		$query = "SELECT A.`NumeCategorie`, B.`Data`, B.`Ora`, B.`Durata`, C.`NumeLocatie`, C.`Strada`, C.`Numarul`, C.`Sectorul`
				  FROM `categorie` A INNER JOIN `eveniment` D 
				  ON A.`IdCategorie`  = D.`IdCategorie` 
				  INNER JOIN `durata` B 
				  ON B.`IdDurata` = D.`IdDurata`
				  INNER JOIN `locatie` C
				  ON C.`IdLocatie` = D.`IdLocatie`
				  WHERE D.`NumeEveniment` = '".$_POST['cauta']."'";
				  
		$result = mysqli_query($link, $query);
		
		if(!$result){
				
				echo mysqli_error($link);
				
			} else {
				
				
				$row = mysqli_fetch_array($result);
				
				if($row) {
				
					$detalii = "Detaliile despre ".$_POST["cauta"]." sunt urmatoarele:  <br>
							Numele categoriei: ".$row[0]."<br> Data: ".$row[1]."<br> Ora: ".
							$row[2]."<br> Durata eveniment: ".$row[3]."h<br> Numele locatiei: ".
							$row[4]."<br> Strada: ".$row[5]."<br> Numarul: ".$row[6].
							"<br> Sectorul: ".$row[7];
				
				} else {
					
					$error = "Nu exista acest eveniment in baza de date!";
				
				}
				
			}
	
	
	
	}
	
?>	

	<style type="text/css">
		
		html { 
		  background: url(one.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
		
		.images{
			
			width: 250px;
			height: 200px;
			border-style: outset;
			border-color: #808080;
			margin: 30px;
			
			
			
		}
		
		#first { 
		
			
			position: relative;
			left: -400px;
			top: -30px;
		
		}
		
		#second {
		
			position: relative;
			top: -290px;
		
		}
		
		#third {
			
			position: relative;
			left: -400px;
			top: -310px;
		
		}
		
		#forth {
			
			position: relative;
			top: -570px;
		
		}
		
		#fifth {
		
			position: relative;
			left: 400px;
			top: -930px;
		
		}
		
		#cauta { 
		
			margin-top: -50px;
			margin-bottom: 20px;
		
		}
	
	</style>

  <?php include("navbar.php") ?>
	


<div class = "container">

	<nav id="cauta" class="navbar navbar-toggleable-md navbar-light bg-faded" >
	
		 <form class="form-inline my-2 my-lg-0" method="post">
			<input class="form-control mr-sm-2" type="text" name="cauta" placeholder="Cauta un spectacol">
			
			<div class="form-group">				
					
				<input type = "submit" class="btn btn-success" name = "submit" value = "Cauta">
			
			</div>
		</form>
	
	
	</nav>
	
	<div id="error"><?php if ($error != "") {
			
				echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

			}?></div>
			
			
	<div ><?php if ($detalii != "") {
			
					echo '<div class="alert alert-info" role="alert">'.$detalii.'</div>';
					
				}
	
	?></div>
		
	<a href="expozitie.php"><img src="expozitie.jpg " class = "images" id="first"></a>
	
	<a href="concert.php"><img src="concert.jpg" class = "images" id="second"></a>
	
	<a href="teatru.php"><img src="teatru.jpg" class = "images" id="third"></a>
	
	<a href="opera.php"><img src="opera.jpg" class = "images" id="forth"></a>
	
	<a href="festival.php"><img src="festival.jpg" class = "images" id="fifth"></a>
	
		
	
</div>

<?php

	include("footer.php");


?>	