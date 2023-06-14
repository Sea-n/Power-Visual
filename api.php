<?php
$data = file_get_contents('php://input');
$data = json_decode($data, true);

$result = [
	'date' => $data['year'],
];

header('Content-Type: application/json');

$year = $_GET['year'] ?? 110;
$month = $_GET['month'] ?? 1;
$sqlQuery = "SELECT * FROM `table_name` WHERE `year` = $year AND `month` = $month";

echo json_encode([
	'ok' => true,
	'result' => [
		'sqlQuery' => $sqlQuery,
	]
], JSON_PRETTY_PRINT);
