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

		<div id="results">
			<div id="industry" style="display: none;">
				<h2>產業別</h2>
				<table class="ts-table is-relaxed">
					<thead>
						<tr><th>行業</th><th>用電量</th></tr>
					</thead>
					<tbody>
						<tr><td>住宅部門</td><td id="industry-resident">...</td></tr>
						<tr><td>服務業</td><td id="industry-service">...</td></tr>
						<tr><td>農林漁牧</td><td id="industry-first_industry">...</td></tr>
						<tr><td>工業</td><td id="industry-second_industry">...</td></tr>
						<tr><td>總計</td><td id="industry-total_usage">...</td></tr>
						<tr><td>縣市佔比</td><td id="industry-city_rate">...</td></tr>
					</tbody>
				</table>
			</div>

			<div id="type" style="display: none;">
				<h2>各類排行</h2>
				<table class="ts-table is-relaxed">
					<thead>
						<tr><th>排名</th><th>類別</th><th>用電量</th></tr>
					</thead>
					<tbody>
						<tr><td>1</td><td id="type-0-type">...</td><td id="type-0-usage">...</td></tr>
						<tr><td>2</td><td id="type-1-type">...</td><td id="type-1-usage">...</td></tr>
						<tr><td>3</td><td id="type-2-type">...</td><td id="type-2-usage">...</td></tr>
						<tr><td>4</td><td id="type-3-type">...</td><td id="type-3-usage">...</td></tr>
						<tr><td>5</td><td id="type-4-type">...</td><td id="type-4-usage">...</td></tr>
					</tbody>
				</table>
			</div>

			<div id="prediction" style="display: none;">
				<h2>未來預估</h2>
				<table class="ts-table is-relaxed">
					<thead>
						<tr><th>日期</th><th>預估淨尖峰供電能力</th><th>預估瞬時尖峰負載</th></tr>
					</thead>
					<tbody>
						<tr><td id="prediction-0-date">...</td><td id="prediction-0-capacity">...</td><td id="prediction-0-load">...</td></tr>
						<tr><td id="prediction-1-date">...</td><td id="prediction-1-capacity">...</td><td id="prediction-1-load">...</td></tr>
						<tr><td id="prediction-2-date">...</td><td id="prediction-2-capacity">...</td><td id="prediction-2-load">...</td></tr>
						<tr><td id="prediction-3-date">...</td><td id="prediction-3-capacity">...</td><td id="prediction-3-load">...</td></tr>
						<tr><td id="prediction-4-date">...</td><td id="prediction-4-capacity">...</td><td id="prediction-4-load">...</td></tr>
						<tr><td id="prediction-5-date">...</td><td id="prediction-5-capacity">...</td><td id="prediction-5-load">...</td></tr>
					</tbody>
				</table>
			</div>

			<div id="overview" style="display: none;">
				<h2>年度數據</h2>
				<table class="ts-table is-relaxed">
					<thead>
						<tr><th>尖峰日期</th><th>尖峰供電能力</th><th>瞬時尖峰負載</th></tr>
					</thead>
					<tbody>
						<tr><td id="overview-peak">...</td><td id="overview-capacity">...</td><td id="overview-load">...</td></tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/city-selector.js"></script>
</body>
</html>
