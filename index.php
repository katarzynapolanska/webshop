<?php
$host = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";

$pdo = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" style="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<title> Webshop </title>
</head>
<body>
<form method="post">
		<div id="columns" class="row">
			<div class="left">
				<h1>Hello hier!</h1>
				<p>Het is al geruime tijd een bekend gegeven dat een lezer,</br> tijdens het bekijken van de layout van een pagina.</p>
				<!--login-->
				<div class="loginform">
					<input type="text" name="gebruiker" placeholder="Gebruikernaam"/>
					<input type="password" name="wachtwoord" placeholder="Wachtwoord"/></br>
					<input type="submit" name="btnLogin" value="Login"/>
				</div>
			</div>
			<?php
			if(isset($_POST['btnLogin'])){
				session_start();
				$gebruiker = $_POST['gebruiker'];
				$wachtwoord = $_POST['wachtwoord'];

				$query = "SELECT * FROM login WHERE gebruiker = '$gebruiker' AND wachtwoord = '$wachtwoord'";
				$stm = $pdo->prepare($query);
				$stm->execute();
				$login = $stm->fetch(PDO::FETCH_OBJ);
			}
			?>
			<!--Webshop form-->
			<div class="form">
				Aanhef:
				<select class="aanhef" name="aanhef">
					<option name="dhr">Dhr.</option>
					<option name="mevr">Mevr.</option>
				</select></br>
				<input type="text" name="naam" placeholder="Uw naam"/> <br/>
				<input type="text" name="postcode" placeholder="Postcode"/> <br/>
				<input type="text" name="straat" placeholder="Straat"/> <br/>
				<input type="text" name="woonplaats" placeholder="Woonplaats"/> <br/>
				Geslacht:
				<input type="radio" name="geslacht" value="vrouw"/>Vrouw
				<input type="radio" name="geslacht" value="man"/>Man
				<br/>
				<input type="text" name="telefoon" placeholder="Telefoon nummer"/> <br/>
				<input type="text" name="email" placeholder="E-mail"/> <br/>
				Datum workshop: </br>
				<select name="datum">
					<option>Dinsdag 12 februari 2019 van 09:00u - 13:30u</option>
					<option>Woensdag 13 feruari 2019 van 13:00u - 17:30u</option>
				</select> </br>
				<div>
					<input type="submit" name="button" value="send"/>
					<input type="submit" name="button1" value="show me"/>
				</div>
			</div>
		</div>
	</form>
	
	<?php 
	echo "<div class='echo'>";
	if(isset($_POST['button1'])){

		$sQuery = "SELECT * FROM webshop WHERE webshop.datum='Woensdag 13 feruari 2019 van 13:00u - 17:30u' LIMIT 20";
				$stm = $pdo->prepare($sQuery);
				if($stm->execute()){
					$result = $stm->fetchAll(PDO::FETCH_OBJ);
					echo "Antaal inschrijven voor Woensdag: ".$stm->rowCount()."<br/>";
					foreach($result as $prod){
						echo $prod->aanhef." | ". 
						$prod->naam.  " | ". 
						$prod->postcode. " | ". 
						$prod->straat. " | ". 
						$prod->woonplaats. " | ". 
						$prod->geslacht. " | ".
						$prod->telefoon. " | ".
						$prod->email. " | ".
						$prod->datum. " | ".
						"<br/>";
					}
				}
			$sQuery = "SELECT * FROM webshop WHERE webshop.datum='Dinsdag 12 februari 2019 van 09:00u - 13:30u' LIMIT 20";
			$stm = $pdo->prepare($sQuery);
			if($stm->execute()){
				$result = $stm->fetchAll(PDO::FETCH_OBJ);
					echo "Antaal inschrijven voor Dinsdag: ".$stm->rowCount()."<br/>";
					foreach($result as $prod){
						echo $prod->aanhef." | ". 
						$prod->naam.  " | ". 
						$prod->postcode. " | ". 
						$prod->straat. " | ". 
						$prod->woonplaats. " | ". 
						$prod->geslacht. " | ".
						$prod->telefoon. " | ".
						$prod->email. " | ".
						$prod->datum. " | ".
						"<br/>";
					}
			}
	}	
	
	if(isset($_POST['button'])) {
		$webshop = array("Aanhef" => $_POST['aanhef'],
						"Naam" => $_POST['naam'],
						"Postcode" => $_POST['postcode'],
						"Straat" => $_POST['straat'],
						"Woonplaats" => $_POST['woonplaats'],
						"Geslacht" => $_POST['geslacht'],
						"Telefoon" => $_POST['telefoon'],
						"Email" => $_POST['email'],
						"Datum" => $_POST['datum']);
						
						foreach($webshop as $key => $value) {
						echo $key.": ".$value."<br/>";
						}
						$query = "INSERT INTO webshop VALUES".
						"('{$webshop['Aanhef']}',
						'{$webshop['Naam']}',
						'{$webshop['Postcode']}',
						'{$webshop['Straat']}',
						'{$webshop['Woonplaats']}',
						'{$webshop['Geslacht']}',
						'{$webshop['Telefoon']}',					
						'{$webshop['Email']}',
						'{$webshop['Datum']}')";
						//Query inlezen om hem te zetten naar een statement
						//die database begrijpt
						$stm = $pdo->prepare($query);
						//Statement uitvoeren op de database
						$stm->execute();
						}
						
	echo "</div>";
	?>
	
	<div class="footer-container">
		<div class="vert-align">
			<p class="headline">
				<small class="block">Copyright &copy; 2019 - All Rights Reserved. Images: <a href="https://unsplash.com/" class="link">Unsplash</a></small>
			</p>
		</div>
	</div>

</body>
</html>