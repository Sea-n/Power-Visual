-- 行政區 郵遞區號 對應
DROP TABLE IF EXISTS zipcode;
CREATE TABLE zipcode (
	zipcode INT,
	city VARCHAR(10),
	dist VARCHAR(10)
);

-- 鄉鎮市(郵遞區)別用電統計資料 https://data.gov.tw/dataset/14135
DROP TABLE IF EXISTS by_type;
CREATE TABLE by_type (
	year INT,
	month INT,
	zipcode INT,
	type VARCHAR(30),
	`usage` INT
);

-- 各縣市住宅、服務業及機關用電統計資料 https://data.gov.tw/dataset/29935
DROP TABLE IF EXISTS by_industry;
CREATE TABLE by_industry (
	year INT,
	month INT,
	city VARCHAR(10),
	total_usage INT,
	city_rate FLOAT,
	resident INT,
	service INT,
	first_industry INT,
	second_industry INT
);

-- 過去電力供需資訊_近5年系統概況 https://data.gov.tw/dataset/103046
DROP TABLE IF EXISTS overview;
CREATE TABLE overview (
	year INT,
	peak DATE,
	capacity FLOAT,
	`load` FLOAT
);

-- 近期電力資訊_未來二個月電力供需預測 https://data.gov.tw/dataset/103262
DROP TABLE IF EXISTS prediction;
CREATE TABLE prediction (
	year INT,
	month INT,
	period ENUM ('early', 'mid', 'late'),
	capacity FLOAT,
	`load` FLOAT
);
