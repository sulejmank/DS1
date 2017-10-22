<?php

$recnik = explode(" ", file_get_contents("reci.txt"));

$max_pokusaj = 7;

$velicina_recnika = count($recnik);

if(!isset($_SESSION['rec_id'])) {

	$random_id = rand(0, $velicina_recnika-2);
	$_SESSION['rec_id'] = 	$random_id ;
	$_SESSION['brPogresnihPokusaja']= 0;
	$_SESSION['user_guesses']= array();

} else
	 $random_id = $_SESSION['rec_id'];



$rec = $recnik[$random_id];
$rec_id = $random_id;
$rec= strtoupper($rec);

$word_size = strlen($rec);
$word_chars = str_split($rec);
$word_char_unique = array_unique($word_chars);
$rezultat = 0;


if(isset($_POST['guess_it'])){

	$user_guess = $_POST['guess'];
	array_push($_SESSION['user_guesses'], $user_guess);
	$guessed_char = $_SESSION['user_guesses'];

	if(!in_array($user_guess, $word_chars)){
		$_SESSION['brPogresnihPokusaja']++;
	}
	$rezultat = vidi_rezultat();
}


function vidi_rezultat(){
	global $word_char_unique;
	global $max_pokusaj;

	$rezultat = array_intersect($_SESSION['user_guesses'], $word_char_unique);
	if(count($rezultat) == count($word_char_unique))
		return $rezultat = 1;

	if($_SESSION['brPogresnihPokusaja'] < $max_pokusaj )
		return $rezultat =0;
	 else
		return $rezultat = -1;
}
