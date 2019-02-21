<?php
require('quotes.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Nathan Hunt</title>
	<meta charset="utf-8">

	<link href='/local.css' rel='stylesheet'>

</head>
<body>
	<div id="roundrect-container">
		<section id="intro">
		  <h1>Musical scales</h1>
		</section>


		<section id="explanation">
		</section>

		<section id="options">
			<form action="./scales.php" method="get">
				<input type="text" name="root" value="C" maxlength="1">Root note
			 <input type="radio" name="solfege" id="solfege">
			 <select name="scale_type">
			  <option value="major">Major</option>
				<option value="minor">Minor</option>
				<option value="modes">Modes</option>
			</select>
			 <input type="submit" value="Submit">
		</form>
		</section>
</div>
</body>
