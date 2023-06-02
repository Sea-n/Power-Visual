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
					<select id="year" class="ts-select">
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
					<select id="month" class="ts-select">
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
					<select id="city" class="ts-select">
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
					<select id="dist" class="ts-select">
						<option value="" disabled>請先選擇縣市</option>
					</select>
				</div>

				<input type="submit" class="ts-button is-fluid">
			</div>
		</form>
	</div>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/city-selector.js"></script>
</body>
</html>
