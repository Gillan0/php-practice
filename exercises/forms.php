<!DOCTYPE php>
<html>
<head>
	<title>Forms in PHP</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="/css/main_style.css">
</head>
<body>
	<?php 
		include "../ressources/php/header.php";
	?>

	<div class="content">
		<div class = "form_management">
			<h2> Test for GET / POST method in PHP form </h2>

			<h3>GET Method</h3>
			<form name="form" action="" method="GET" autocomplete="off">
				<label>Input : </label>
				<input type="text" name="get_prompt">
				<input type="submit">
			</form>

			<?php
				if (isset($_GET["get_prompt"])){
					$answer = $_GET["get_prompt"];
					echo "You entered {$answer} <br>";
				} else {
					echo "Please enter a prompt";
				}
			?>


			<h3>POST Method</h3>
			<form name="form" action="" method="POST" autocomplete="off">
				<label>Input : </label>
				<input type="text" name="post_prompt">
				<input type="submit">
			</form>

			<?php
				if (isset($_POST["post_prompt"])){
					$answer = $_POST["post_prompt"];
					echo "You entered {$answer} <br>";
				} else {
					echo "Please enter a prompt";
				}
			?>

			<h3>Radio Buttons</h3>

			<form name="form" action="" method="POST" autocomplete="off">
				<label>What game video game company do you prefer ?</label><br>
				<input type="radio" name="game_company" value="Nintendo"> <label> Nintendo Switch </label><br>
				<input type="radio" name="game_company" value="Playstation"> <label> Playstation </label><br>
				<input type="radio" name="game_company" value="Microsoft"> <label> Microsoft </label><br>
				<input type="radio" name="game_company" value="Other"> <label> Other</label><br> 
				<input type="submit" name="confirm">
			</form>

			<?php 

			if (isset($_POST["confirm"])) {
				if (isset($_POST["game_company"])) {
					$game_company = $_POST["game_company"];	
					echo "<b>You selected {$game_company}</b>";
				} else {
					echo "Please select a game company";
				}
			}
		
			?>

			<h3> Input sanitization </h3>

			<form name="form" action="" method="POST" autocomplete="off">
				<label>Input : </label>
				<input type="text" name="sanitize_prompt">
				<input type="submit">
			</form>

			<?php
			if (isset($_POST["sanitize_prompt"])) {
				$input = filter_input(INPUT_POST, "sanitize_prompt", FILTER_SANITIZE_STRING);
				$input = htmlspecialchars($input, ENT_QUOTES, "UTF-8");
				echo "Here is your sanitized prompt : " . $input; 
			} else {
				echo "Please send an input";
			}

			?>

		</div>

		<div class="example"> 

			<h2> Example : Age verification </h2>

			<form name="age_verification" action="" method="POST" autocomplete="off">
				<label>Enter your age :</label>
				<input name="age" type="number" required>
				<input type="submit" name="submit" value="Submit">
			</form>

			<?php 
			if (isset($_POST["age"])) {
				$age = intval($_POST["age"]);
				if ($age < 0 || $age > 122) {
					echo "Invalid age";
				} elseif ($age >= 18) {
					echo "Welcome to the website!";
				} else {
					echo "You are not allowed on this website.";
				}
			}
			?>

		</div>

	</div>

	<?php

		include "../ressources/php/footer.php";
	?>

</body>
</html>
