<!DOCTYPE html>
<html lang="zh-TW" data-scheme="dark">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>用電資料視覺化 :: 資料庫 期末專案</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/4.2.3/tocas.min.css">
	<link rel="stylesheet" href="/assets/css/main.css">
</head>
<body>
	<div class="ts-content">
		<div class="ts-container is-narrow">
		<div class="ts-header is-big is-heavy">電量視覺化</div>

		<form id="query">
			<div class="ts-grid is-4-columns is-relaxed">
				<div class="column">
					<label for="year">年份</label>
					<select id="year" class="ts-select" name="year">
						<option>2023</option>
						<option>2022</option>
						<option>2021</option>
						<option>2020</option>
						<option>2019</option>
						<option>2018</option>
						<option>2017</option>
						<option>2016</option>
						<option>2015</option>
						<option>2014</option>
					</select>
				</div>

				<div class="column">
					<label for="month">月份</label>
					<select id="month" class="ts-select" name="month">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
						<option>9</option>
						<option>10</option>
						<option>11</option>
						<option>12</option>
					</select>
				</div>

				<div class="column">
					<label for="city">縣市</label>
					<select id="city" class="ts-select" name="city">
						<option value="" disabled selected>請選擇縣市</option>
						<option>台北市</option>
						<option>基隆市</option>
						<option>新北市</option>
						<option>宜蘭縣</option>
						<option>桃園市</option>
						<option>新竹市</option>
						<option>新竹縣</option>
						<option>苗栗縣</option>
						<option>台中市</option>
						<option>彰化縣</option>
						<option>南投縣</option>
						<option>嘉義市</option>
						<option>嘉義縣</option>
						<option>雲林縣</option>
						<option>台南市</option>
						<option>高雄市</option>
						<option>澎湖縣</option>
						<option>金門縣</option>
						<option>屏東縣</option>
						<option>台東縣</option>
						<option>花蓮縣</option>
						<option>連江縣</option>
					</select>
				</div>

				<div class="column">
					<label for="dist">鄉鎮市區</label>
					<select id="dist" class="ts-select" name="dist">
						<option value="" disabled>請先選擇縣市</option>
					</select>
				</div>

				<input type="submit" class="ts-button is-fluid">
			</div>
		</form>
	</div>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/city-selector.js"></script>

	<style>
		table, th, td {
			border: 1px white solid;
			border-collapse: collapse;
		}
		.center{
			margin-left: auto;
			margin-right: auto;
		}
	</style>

	<table class="center">
		<tr>
			<th>年份</th>
			<th>月份</th>
			<th>縣市</th>
			<th>鄉鎮市區</th>
			<th>用電量</th>
		</tr>
		
		<script>
			while($result = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				
				echo $result['year'];
				echo $result['month'];
				echo $result['city'];
				echo $result['dist'];
				echo $result['power'];
				
			}

			if($result == null){
				<tr>
					<td>2020</td>
					<td>1</td>
					<td>台北市</td>
					<td>中正區</td>
					<td>輸入資料不齊全</td>
				</tr>
			}
		</script>

		
	</table>
	
	<br>

	<table class="center">
		<tr>
			<th>年份</th>
			<th>月份</th>
			<th>縣市</th>
			<th>縣市用電占比</th>
			<th>合計售電量</th>
			<th>住宅部分</th>
			<th>第一級產業</th>
			<th>第二級產業</th>
			<th>第三級產業(服務業)</th>
		</tr>

		<script>
			while($result = mysqli_fetch_array($r, MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td>".$result['year']."</td>";
				echo "<td>".$result['month']."</td>";
				echo "<td>".$result['city']."</td>";
				echo "<td>".$result['total_usage']."</td>";
				echo "<td>".$result['city_rate']."</td>";
				echo "<td>".$result['resident']."</td>";
				echo "<td>".$result['service']."</td>";
				echo "<td>".$result['first_industry']."</td>";
				echo "<td>".$result['second_industry']."</td>";
				echo "</tr>";
			}
		</script>
	</table>
</body>
</html>
