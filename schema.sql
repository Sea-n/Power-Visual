-- 鄉鎮市(郵遞區)別用電統計資料 https://data.gov.tw/dataset/14135
CREATE TABLE electricity_by_village(
	year INT,
	month INT,
	zip_code INT,
	elect_type VARCHAR(30),
	user INT,
	contract_capacity INT,
	electricity_sales INT
);

-- 行政區 郵遞區號 對應
CREATE TABLE zip_map(
	zip_code INT,
	city VARCHAR(10),
	dist VARCHAR(10)
);

-- 過去電力供需資訊_近5年系統概況 https://data.gov.tw/dataset/103046
CREATE TABLE past_5_year (
	year INT,
	date DATE,
	hour_min VARCHAR(5),
	expected_capacity INT,
	expected_load INT,
	expected_backup INT,
	expected_backup_rate DOUBLE
);

-- 近期電力資訊_未來二個月電力供需預測 https://data.gov.tw/dataset/103262
CREATE TABLE 2_month_prediction (
	date DATE,
	expected_instant_capacity INT,
	expected_instant_load INT,
	expected_instant_backup INT,
	expected_instant_backup_rate DOUBLE
);

-- 各縣市住宅、服務業及機關用電統計資料 https://data.gov.tw/dataset/29935
CREATE TABLE industry_per (
	date DATE,
	city VARCHAR(10),
	resident INT,
	resident_rate DOUBLE,
	service INT,
	service_rate DOUBLE,
	first_industry INT,
	first_industry_rate DOUBLE,
	second_industry INT,
	second_industry_rate DOUBLE,
	total_usage INT,
	city_rate DOUBLE
);
