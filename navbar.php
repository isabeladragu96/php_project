<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php">Home</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="expozitie.php">Expozitie</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="concert.php">Concert</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teatru.php">Teatru</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="opera.php">Opera</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="festival.php">Festival</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="sponsor.php">Sponsori</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="recente.php">Recente</a>
      </li>
	  <?php
		
		
		
		include("connection.php");
	
		if (array_key_exists("id", $_COOKIE)) {
			
			$_SESSION['id'] = $_COOKIE['id'];
			
		}
		
		if (array_key_exists("id", $_SESSION)) {
			
			$query = "SELECT `IsAdmin`
					  FROM `utilizatori` 
					  WHERE `id` = '".$_SESSION['id']."'";
			
			$result = mysqli_query($link, $query);
			
			$row = mysqli_fetch_array($result);
			
			if($row[0] == '1'){
				
				 
				echo "<li class='nav-item'>
						<a class='nav-link' href='adauga.php'>Editati evenimente</a>
					  </li>";
				
			}
		
			
			
			
		} 
		
	?>
    
	</ul>
    
	<div class="form-inline my-2 my-lg-0">
    
		<a href='index.php?Logout=1'><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button></a>
    
	</div>
  
  </div>

  </nav>