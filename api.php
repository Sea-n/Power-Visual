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

switch($choice){
	case 1:
		$table_name = "by_type";
		break;
	case 2:
		$table_name = "by_industry";
		break;
	case 3:
		$table_name = "over_view";
		break;
	case 4:
		$table_name = "prediction";
		break;
	default:
		$table_name = "by_type";
		break;
}



if($year != "" && $month != "" && $dist != "" && $table_name == "by_type"){
	$sql = "SELECT * FROM `by_type` JOIN `zip_map`
	ON `by_type`.`zip_code` = `zip_map`.`zip_code`
	WHERE `year` = :year AND `month` = :month AND `dist` = :dist";
	$stmt = $pdo->prepare($sql);
    $stmt->execute([
        'year' => $year,
        'month' => $month,
        'dist' => $dist,
    ]);
	$results = [];
    while ($item = $stmt->fetchAll()) {
	    $results[] = $item;
    }
}
else if($year != "" && $month != "" && $city != "" && $table_name == "by_industry"){
	$sql = "SELECT * FROM `by_industry` WHERE `year` = :year AND `month` = :month AND 'city' = :city";
	$stmt = $pdo->prepare($sql);
    $stmt->execute([
        'year' => $year,
        'month' => $month,
        'city' => $city,
    ]);
	$results = [];
    while ($item = $stmt->fetchAll()) {
	    $results[] = $item;
    }
}
else if($year != "" && $table_name == "overview"){
	$sql = "SELECT * FROM `overview` WHERE `year` = :year";
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
?>