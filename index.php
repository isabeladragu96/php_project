<?php

	session_start();
	
	$error = "";
	
	if(array_key_exists("Logout", $_GET)) {
		
		unset($_SESSION);
		setcookie("id", "", time() - 60*60);
		$_COOKIED["id"] = "";
		
	} else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
		
		
		header ("Location: home.php");
		
		
	}

	if (array_key_exists("submit", $_POST)) {
		
		include("connection.php");
		
		
		if (!$_POST['email']) {
				
			$error .= "Adresa de email este necesara!<br>";
			
		}
		
		if (!$_POST['password']) {
				
			$error .= "Parola este necesara!<br>";
			
		}
		
		if ($error != "") {
			
			$error = "<p>Trebuie completate toate campurile!<p>".$error;
		
		} else {
			
			if ($_POST['signUp'] == '1') {
				
				$query = "SELECT id FROM `utilizatori` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1 ";
				
				$result = mysqli_query($link, $query);
				
				if (mysqli_num_rows($result) > 0) {
						
					$error =  "Adresa de email este deja utilizata.";
					
				} else {
				
					$query = "INSERT INTO `utilizatori`(`email`, `parola`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', 
					'".mysqli_real_escape_string($link, $_POST['password'])."') ";
					
					if (!mysqli_query($link, $query)) {
						
						$error = "<p>Nu s-a putut produce inregistrarea! Incearca mai tarziu!</p>";
						
					} else {
						
						$query = "UPDATE `utilizatori` SET parola = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
						
						$id = mysqli_insert_id($link);
                        
                        mysqli_query($link, $query);

                        $_SESSION['id'] = $id;
						
						if ($_POST['stayLoggedIn'] == '1') {
						
							setcookie("id", $id, time() + 60*60*24*365);
							
						}
					
						header("Location: home.php");
						
					}
					
				} 
			
			} else {
					
					$query = "SELECT * FROM `utilizatori` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
					
					$result = mysqli_query($link, $query);
					
					$row = mysqli_fetch_array($result);
					
					if (isset($row)) {
					
						$hashedPassword = md5(md5($row['id']).$_POST['password']);
						
						if ($hashedPassword == $row['parola']) {
							
							$_SESSION['id'] = $row['id'];
							
							if ($_POST['stayLoggedIn'] == '1') {
						
							setcookie("id", $row['id'], time() + 60*60*24*365 );
							
							}
					
							header("Location: home.php");
						
						} else {
						
							$error = "Email-ul/parola nu au putut fi gasite in baza de date";
							
						}
							
					} else {
					
						$error = "Email-ul/parola nu au putut fi gasite in baza de date";
						
					}
						
					
				}
		
		}
		
	}

?>

<?php include("header.php")?>

	<style type="text/css">
		
		html { 
		  background: url(two.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
	
		#intro {
			
			margin-top: -60px;
			font-size: 18px;
			
		}
		
	
	</style>
  
		<h1>Ghid oras. Organizare evenimente</h1>
		
		<div class="container">
			
			<p id="intro"><strong>Un nou mod de a cunoaste un oras! Firma noastra organizeaza diverse tipuri de evenimente pentru a oferi posibilitatea turistilor
					de a vedea principalele atractii ale Bucurestiului printr-un mod cultural si distractiv. </strong></p>
			
			<div id="error"><?php if ($error != "") {
			
				echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

			}?></div>

			<form method = "post" id = "signUpForm">
			
				<p>Interesat? Inregistreaza-te acum!</p>
				
				<div class="form-group">
				
					<input type = "email" class="form-control" name = "email" placeholder = "Email">
				
				</div>
				
				<div class="form-group">
				
					<input type = "password" class="form-control" name = "password" placeholder = "Parola">
				
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type = "checkbox" class="form-check-input" name="stayLoggedIn"  value = 1>
						Ramai inregistrat
					</label>
				</div>
				
				<div class="form-group">
				
					<input type="hidden" name = "signUp" value="1">
				
				</div>
				
				<div class="form-group">				
					
					<input type = "submit" class="btn btn-success" name = "submit" value = "Sign Up!">
			
				</div>
				
				<p><a class="toggleForms">Log In</a></p>
				
			</form>

			<form method = "post" id = "logInForm">
			
				<p>Esti deja membru? Log in aici.</p>
				
				<div class="form-group">
					
					<input type = "email" class="form-control" name = "email" placeholder = "Email">
				</div>
				
				<div class="form-group">
				
					<input type = "password" class="form-control" name = "password" placeholder = "Parola">
				
				</div>
				
				<div class="form-check">
					<label class="form-check-label">
						<input type = "checkbox" class="form-check-input" name="stayLoggedIn"  value = 1>
						Ramai inregistrat
					</label>
				</div>
				
				<div class="form-group">
				
					<input type="hidden" name = "signUp" value="0">
				
				</div>
				
				<div class="form-group">
				
					<input type = "submit" class="btn btn-success" name="submit" value = "Log In!">
				
				</div>
					
				<p><a class="toggleForms">Sign up</a></p>
				
			</form>
			
			
			
		</div>

    <?php include("footer.php")?>

