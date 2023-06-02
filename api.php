<?php
$data = file_get_contents('php://input');
$data = json_decode($data, true);

$result = [
	'date' => $data['year'],
];

header('Content-Type: application/json');

echo json_encode([
	'ok' => true,
	'result' => $result,
], JSON_PRETTY_PRINT);
