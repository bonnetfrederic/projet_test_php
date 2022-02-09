<?php

declare(strict_types = 1);

function error_response(string $message, int $code = 422): void {
  http_response_code($code);
  echo json_encode(['error' => $message]);
  die;
}

?>
