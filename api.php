<?php
$data = file_get_contents('php://input');
$data = json_decode($data, true);

$result = [
	'date' => $data['year'],
];

header('Content-Type: application/json');

$year = $_POST['year'] ;
$month = $_POST['month'] ;
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
else if($year != "" && $month != "")
	$sqlQuery = "SELECT * FROM $table_name WHERE `year` = $year AND `month` = $month AND 'city' = $city AND 'district' = $district";
else
	$sqlQuery = "SELECT * FROM $table_name WHERE `year` = 110 AND `month` = 1"; // default?


echo json_encode([
	'ok' => true,
	'result' => [
		'sqlQuery' => $sqlQuery,
	]
], JSON_PRETTY_PRINT);
