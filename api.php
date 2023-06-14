<?php
require_once('config.php');

$pdo = new PDO('mysql:host=localhost;dbname=xnctu', 'xnctu', MYSQL_PASSWORD);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = file_get_contents('php://input');
$data = json_decode($data, true);

$result = [
	'date' => $data['year'],
];

header('Content-Type: application/json');

$year = $_POST['year'] ;
$month = $_POST['month'] ;
$city = $_POST['city'] ;
$dist = $_POST['dist'] ;
/*
$district = $_POST['district'] ;
$district_int = intval($_POST['district']);
 */
$date = $year . '-' . $month . '-01';
$formatDate = date('Y-m', strtotime($date));

$schema = array('electricity_by_village', 'zip_map', 'past_5_year', '2_month_prediction', 'industry_per');

switch($choice){
	case 1:
		$table_name = "electricity_by_village";
		break;
	case 2:
		$table_name = "industry_per";
		break;
	case 3:
		$table_name = "2_month_prediction";
		break;
	case 4:
		$table_name = "past_5_year";
		break;
	default:
		$table_name = "electricity_by_village";
		break;
}



if($year != "" && $month != "" && $table_name == "electricity_by_village")
	$sqlQuery = "SELECT * FROM electricity_by_village JOIN zip_map ON electricity_by_village.zip_code = zip_map.zip_code WHERE `year` = $year AND `month` = $month";
else if($year != "" && $month != "")
	$sqlQuery = "SELECT * FROM $table_name WHERE `year` = $year AND `month` = $month AND 'city' = $city AND 'district' = $district";
else
	$sqlQuery = "SELECT * FROM $table_name WHERE `year` = 110 AND `month` = 1"; // default?

$stmt = $pdo->prepare($sql);
$stmt->execute([
	'year' => $year,
]);

$results = [];
while ($item = $stmt->fetch()) {
	$results[] = $item;
}

echo json_encode([
	'ok' => true,
	'result' => [
		'sqlQuery' => $sqlQuery,
	]
], JSON_PRETTY_PRINT);
