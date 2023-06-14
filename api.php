<?php
$data = file_get_contents('php://input');
$data = json_decode($data, true);

$result = [
	'date' => $data['year'],
];

header('Content-Type: application/json');

$year = $_POST['year'] ;
$month = $_POST['month'] ;
$year_int = intval($_POST['year']);
$month_int = intval($_POST['month']);
$city = $_POST['city'] ;
$dist = $_POST['dist'] ;
/*
$district = $_POST['district'] ;
$district_int = intval($_POST['district']);
 */
$date = $year . '-' . $month . '-01';
$formatDate = date('Y-m', strtotime($date));

$schema = array('electricity_by_village', 'zip_map', 'past_5_year', '2_month_prediction', 'industry_per');

foreach($schema as $value){
    switch($value){
		case 'electricity_by_village';
		    if($year != "" && $month != "" && $district != "")
		        $sqlQuery = "SELECT * FROM `electricity_by_village` JOIN `zip_map` ON `zip_map.zip_code` = `electricity_by_village.zip_code`
				WHERE `year` = ($year_int - 1911) AND `month` = $month_int AND `zip_map.dist` = $dist";
	        else
		        $sqlQuery = "SELECT * FROM $value WHERE `year` = 110 AND `month` = 1 AND `zip_code` = '中正區'";
			break;
		case 'zip_map';
		    if($dist != "")
		        $sqlQuery = "SELECT * FROM `zip_map` WHERE `zip_dist` = $dist";
	        else
		        $sqlQuery = "SELECT * FROM `zip_map` WHERE `zip_dist` = '中正區'";
		    break;
		case 'past_5_year';
		    if($year != "")
		        $sqlQuery = "SELECT * FROM `past_5_year` WHERE `year` = $year_int";
	        else
		        $sqlQuery = "SELECT * FROM `past_5_year` WHERE `year` = 2021";
			break;
		case '2_month_prediction';
		    if($year != "" && $month != "")
		        $sqlQuery = "SELECT * FROM `2_month_prediction` WHERE DATE_FORMAT(`date`, '%Y-%m') = $formatDate";
	        else
		        $sqlQuery = "SELECT * FROM `2_month_prediction` WHERE DATE_FORMAT(`date`, '%Y-%m') = 2021-01";
			break;	
		case 'industry_per';
		    if($year != "" && $month != "" && $city != "")
		        $sqlQuery = "SELECT * FROM `industry_per` WHERE `city` = $city AND DATE_FORMAT(`industry_per.date`, '%Y-%m') = $formatDate";
	        else
			    $sqlQuery = "SELECT * FROM `industry_per` WHERE `city` = '台北市' AND DATE_FORMAT(`industry_per.date`, '%Y-%m') = 2021-01";
			break;
	}
	echo json_encode([
		'ok' => true,
		'result' => [
			'sqlQuery' => $sqlQuery,
		]
	], JSON_PRETTY_PRINT);
}