<?php include 'connection.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<!--<link rel = "icon" href = "/~mofr1108/Oblig6_bilbutikk/bilshappe.png">-->

		<!-- Bootstrap: http://www.w3schools.com/bootstrap/bootstrap_get_started.asp -->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

		<title>Spillfigurer</title>
  </head>
  <body>
		<?php include 'menybar.php';?>
		<div class="container">
			<br>
			<h1>Figurer</h1>
			<table>
			<tr>
			<th>Navn</th>
			<th></th>
			</tr>
			<?php
					$ql = "SELECT * FROM figur";
					$resultat = $connection->query($ql);

					while ($rad = $resultat->fetch_assoc()) {
							$figur_id = $rad['figur_id'];
							echo "<tr>";
							echo "<td>";
							echo 		"<form method='post'>";
							echo			"<input type='text' name='navn_$figur_id' placeholder='navn' value='$rad[navn]' required>";
							echo 			"<button type='submit' class='btn btn-primary' name='endre_$figur_id'>Endre</button>";
							echo 		"</form>";
							echo "</td>";
							echo "<td>";
							echo 		"<form method='post'>";
							echo 			"<button type='submit' class='btn btn-danger' name='slett_$figur_id'>Slett</button>";
							echo 		"</form>";
							echo "</td>";
							echo "</tr>\n";
							//update spørring
							if(isset($_POST['endre_'.$figur_id])) {
									$navn = $_POST["navn_$figur_id"];
									$sql = "UPDATE figur SET navn='$navn'
				 									WHERE figur_id='$figur_id'";
									if($connection->query($sql)) {
										echo "Figuren er slettet";
										header("Location: #");
									} else {
										echo "<p>Noe gikk galt <br>
										Spørring: $sql <br>Feilmelding: $connection->error";
									}
							}

							if(isset($_POST['slett_'.$figur_id])) {
										$sql = "DELETE FROM figur WHERE figur_id = $figur_id";
									if($connection->query($sql)) {
										echo "Figuren er slettet";
										header("Location: #");
									} else {
										echo "<p>Noe gikk galt <br>
										Spørring: $sql <br>Feilmelding: $connection->error";
									}
							}
					}
			?>
			</table>
			<br>
				<form method="post">
				Figur: <input type="text" name="navn" placeholder="Bowser" required>
				<input type="submit" value="Legg til!" name="leggtil">
				</form>
			<?php
				if(isset($_POST["leggtil"])) {
							$navn = $_POST ["navn"];

							$sql = "INSERT INTO figur (navn)
											VALUES ('$navn')";

						if($connection->query($sql)) {
							echo "$navn ble lagt til!";
							header("Location: #");
						} else {
							echo "<p>Noe gikk galt <br>
							Spørring: $sql <br>Feilmelding: $connection->error</p>";
						}
				}
			?>
		<?php include 'footer.php';?>
		</div>
	</body>
</html>
