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

$year = intval($_POST['year']) ;
$month = intval($_POST['month'] );
$city = $_POST['city'] ;
$district = $_POST['dist'] ;
$choice = $_POST['choice'] ;

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
else if ($year != "" && $month != "" && $table_name == "industry_per")
	$sqlQuery = "SELECT * FROM industry_per WHERE `year` = $year AND `month` = $month AND 'city' = $city AND 'dist' = $district";
else if($year != "" && $month != "")
	$sqlQuery = "SELECT * FROM $table_name WHERE `year` = $year AND `month` = $month AND 'city' = $city AND 'dist' = $district";
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
