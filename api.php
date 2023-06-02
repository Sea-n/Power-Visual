<?php
header('Content-Type: application/json');

echo json_encode([
	'ok' => true,
	'result' => [
		'date' => 2023,
	]
], JSON_PRETTY_PRINT);
