<?php
declare(strict_types = 1);
require('models/room.php');
require('helper.php');

if ($_SERVER['REQUEST_METHOD'] !=  'POST'){
  error_response('Method is not allowed', 405);
}

if(!isset($_POST['name']) || 
	$_POST['name'] == '') {
    error_response('name ne doit pas être vide');
}
if(strlen($_POST['name']) <= 5) {
	error_response('name doit comprendre au moins 5 caractères');
}

if(!isset($_POST['description']) || 
	$_POST['description'] == '') {
    error_response('description doit être renseigné');
}
if(strlen($_POST['description']) <= 10) {
	error_response('description doit contenir au moins 10 caractères');
}

$duration = (int)($_POST['duration'] ?? 70);
if(!isset($_POST['duration']) || 
	$_POST['duration'] == '') {
    error_response('duration ne doit pas être vide');
}
if (! is_int($duration) || $duration == 0) {
	error_response('duration doit être un entier');
}

$forbidden = (bool)($_POST['forbidden'] ?? false);
if (! is_bool($forbidden)) {
	error_response('forbidden doit être un booléen');
}

$open = (array)($_POST['open'] ?? array("09h-10h30", "11h-12h30", "13h-14h30", "15h-16h30", "17h-18h30", "19h-20h30", "21h-22h30"));
if (! is_array($open)) {
	error_response('open doit être un tableau');
}
if (sizeof($open)<=0) {
	error_response('open doit contenir des horaires');
}

$minPlayers = (int)($_POST['minPlayers'] ?? 2);
if (! is_int($minPlayers) || $minPlayers < 2 || $minPlayers > 12) {
  error_response('Le nombre minimum de joueurs doit être compris entre 2 et 12');
}
$maxPlayers = (int)($_POST['maxPlayers'] ?? 12);
if (! is_int($maxPlayers) || $maxPlayers < 2 || $maxPlayers > 12) {
  error_response('Le nombre maximum de joueurs doit être compris entre 2 et 12');
}

$levels = array("facile", "normal", "difficile");
// $niveau = (string)($_POST['niveau'] ?? "Normal");
$niveau = (string)($_POST['niveau']);
if(!isset($_POST['niveau']) || 
	$_POST['niveau'] == '') {
    error_response('niveau ne doit pas être vide');
}
if(! in_array($_POST['niveau'], $levels)) {
	error_response('Le niveau doit être: ' . $levels[0] . ' ou '. $levels[1] . ' ou '. $levels[2]);
}

$readme = (string)($_POST['readme'] ?? "RAS");
if(!isset($_POST['readme']) || 
	$_POST['readme'] == '') {
    error_response('readme ne doit pas être vide');
}

$room = new Room(
  $_POST['name'], 
	$_POST['description'], 
	(int)$duration,
	$forbidden,
  $open,
  $minPlayers,
  $maxPlayers,
  $niveau,
  $readme
);

http_response_code(201);
echo($room);

?>
