<?php
declare(strict_types = 1);

require('models/room.php');
require('helper.php');

if ($_SERVER['REQUEST_METHOD'] !=  'DELETE'){
  error_response('Method is not allowed', 405);
}

// supprimer une salle à partir de son id
if (isset($_GET['room_id']) && $_GET['room_id'] == 1) {
  http_response_code(204);
} else {
  error_response('la salle n\'existe pas', 404);
}

?>
