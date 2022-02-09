<?php
declare(strict_types = 1);

require('models/room.php');
require('helper.php');

if ($_SERVER['REQUEST_METHOD'] !=  'GET'){
  error_response('Method is not allowed', 405);
}

$room1 = new Room('Comique', 'description du Comique', 45, false, [], 3, 6, "Difficile", "RAS");
$room2 = new Room('Sherlock', 'description Sherlock', 90, false, [], 6, 12, "Difficile", "RAS");
$room3 = new Room('Back to Future', 'description Back To Future', 70, false, [], 4, 12, "Facile", "RAS");
$room4 = new Room('Horreur', 'description nouvelle salle Horreur', 90, true, [], 6, 12, "Difficile", "Ames sensibles, s'abstenir !");

$rooms = [ 
  'data' => [$room1->toArray(), $room2->toArray(), $room3->toArray(), $room4->toArray()],
  'meta' => [
    'page_number' => 1,
    'max_page' => 12,
  ]
];

echo json_encode($rooms);
