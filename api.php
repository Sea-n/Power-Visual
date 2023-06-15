<?php
require_once('config.php');

/* Database connection */
$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* Input data */
$data = file_get_contents('php://input');
$data = json_decode($data, true);

$year = $data['year'];
$month = $data['month'];
$city = $data['city'];
$dist = $data['dist'];

/* Output result */
header('Content-Type: application/json');
$results = [];

/* Check zipcode */
$sql = "SELECT zipcode FROM zipcode
	WHERE city = :city AND dist = :dist";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	'city' => $city,
	'dist' => $dist,
]);
$zipcode = $stmt->fetch();
if (!$zipcode)
	exit(json_encode([
		'ok' => false,
		'msg' => 'Cannot find zipcode.'
	], JSON_PRETTY_PRINT));
$zipcode = $zipcode['zipcode'];

/* By type */
$sql = "SELECT * FROM by_type
	WHERE year = :year AND month = :month AND zipcode = :zipcode
	ORDER BY `usage` DESC
	LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	'year' => $year,
	'month' => $month,
	'zipcode' => $zipcode,
]);
$results['by_type'] = $stmt->fetchAll();
if (count($results['by_type']) === 0)
	unset($results['by_type']);

/* By industry */
$sql = "SELECT * FROM by_industry
	WHERE year = :year AND month = :month AND city = :city";
$stmt = $pdo->prepare($sql);
$stmt->execute([
	'year' => $year,
	'month' => $month,
	'city' => $city,
]);
$results['by_industry'] = $stmt->fetch();
if ($results['by_industry'] === false)
	unset($results['by_industry']);

/* Prediction or Overview */
if ($year == date("Y")) {  // This year
	$sql = "SELECT * FROM prediction";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$results['prediction'] = $stmt->fetchAll();
} else {  // Past year
	$sql = "SELECT * FROM overview WHERE year = :year";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([
		'year' => $year,
	]);
	$results['overview'] = $stmt->fetch();
	if ($results['overview'] === false)
		unset($results['overview']);
}  // if ($year == date("Y"))


/* Return data */
echo json_encode([
	'ok' => true,
	'results' => $results
], JSON_PRETTY_PRINT);
