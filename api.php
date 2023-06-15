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

echo "年<br>";

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
	echo $year;
	echo "年<br>";
	echo $month;
	echo "月<br>";
	echo $dist;
	echo "區<br>";
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
    $stmt->execute([
        'year' => $year,
    ]);
	$results = [];
    while ($item = $stmt->fetchAll()) {
	    $results[] = $item;
    }
}
else if($year != "" && $month != "" && $table_name == "prediction"){
	$sql = "SELECT * FROM `prediction` WHERE `year` = :year AND `month` = :month";
	$stmt = $pdo->prepare($sql);
    $stmt->execute([
        'year' => $year,
        'month' => $month,
    ]);
	$results = [];
    while ($item = $stmt->fetchAll()) {
	    $results[] = $item;
    }
}
else{
	$sql = "SELECT * FROM `prediction` WHERE `year` = 2020 AND `month` = 1"; // default?

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
	    'year' => $year,
    ]);

    $results = [];
    while ($item = $stmt->fetchAll()) {
	    $results[] = $item;
    }
}

echo json_encode([
	'ok' => true,
	'result' => [
		'sqlQuery' => $sqlQuery,
	]
], JSON_PRETTY_PRINT);
?>