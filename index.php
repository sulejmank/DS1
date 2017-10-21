<?php
session_start();
require_once("main/main.php");
?>

<!doctype html>
<html>
	<head>

		<title>Vešanje</title>
		<link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="css/style.css">

	</head>
<body>
	<h3 style = "text-align: center;">Vešanje</h3>
	<hr />
	<div class='vesanje jumbotron'>
		<img <?php echo "src='media/".$_SESSION['brPogresnihPokusaja'].".png' width='150px'  "; ?> ><br />
	</div>

<?php
if($rezultat== -1)
	echo "<h6 style='text-align:center'><strong>Igra zavrsena! Trazena rec je bila : ".$rec. "</strong></h6>";
elseif ($rezultat== 1)
	echo "<h5 style='text-align:center'><strong>Bravoo! :) </strong></h5>";

?>

<div class="input_area">

<?php
for($i=0; $i<$word_size; $i++){

	$g="";
	if(isset($guessed_char)){
		if(in_array($word_chars[$i], $guessed_char))
			$g=$word_chars[$i];
	}
	echo "<input type='text' value='$g' size='1' name='$i'  maxlength='1' class='guessed' readonly />";
}
?>

</div>
<div class="tastatura ">
<?php

$tastatura = range('A', 'Z');
foreach($tastatura as $char){
$dbl = "";
	if(isset($_POST['guess_it'])){
		if(in_array($char, $guessed_char))
			$dbl="disabled";
		else
			$dbl="";
}

	if($rezultat== -1 || $rezultat== 1) $dbl="disabled";
	echo "<span><form  action='#' method='post'>
				<input type='hidden' value='$char' name='guess'  />
				<input type='submit' value='$char' name='guess_it' class='buttkey btn-default' $dbl />
				</form></span>";
}

if(isset($_POST['restart'])){
	session_destroy();
	echo "<meta http-equiv='refresh' content='0'>";
}
?>
<br /><br/>
	<form action="#" method="post">
		<input type="submit" value=" Nova Reč " name="restart" class="btn btn-primary btn-lg" />
	</form>
</div>

	</body>
</html>
