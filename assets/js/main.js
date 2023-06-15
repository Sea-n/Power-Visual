const queryForm = document.getElementById('query');
queryForm.onsubmit = fetchApi;

function fetchApi() {
	const year = document.getElementById('year').value;
	const month = document.getElementById('month').value;
	const city = document.getElementById('city').value;
	const dist = document.getElementById('dist').value;

	fetch('./api.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			year,
			month,
			city,
			dist,
		}),
	}).then(resp => resp.json())
	.then((resp) => {
		if (!resp.ok) {
			alert(resp.msg);
			return;
		}

		renderResult(resp.results);
	});

	return false;  // Don't submit the HTML form
}

function renderResult(data) {
	for (key of ['industry', 'type', 'prediction', 'overview'])
		document.getElementById(key).style.display = 'none';

	if ('by_industry' in data) {
		document.getElementById('industry').style.display = '';
		for (key in data['by_industry']) {
			let elem = document.getElementById(`industry-${key}`);
			if (elem) elem.innerHTML = data['by_industry'][key];
		}
	}

	if ('by_type' in data) {
		document.getElementById('type').style.display = '';
		for (rank in data['by_type']) {
			for (key in data['by_type'][rank]) {
				let elem = document.getElementById(`type-${rank}-${key}`);
				if (elem) elem.innerHTML = data['by_type'][rank][key];
			}
		}
	}

	if ('prediction' in data) {
		document.getElementById('prediction').style.display = '';
		for (i in data['prediction']) {
			let period = {'early': '上旬', 'mid': '中旬', 'late': '下旬'}[data['prediction'][i]['period']];
			data['prediction'][i]['date'] = `${data['prediction'][i]['year']} 年 ${data['prediction'][i]['month']} 月 ${period}`
			for (key in data['prediction'][i]) {
				let elem = document.getElementById(`prediction-${i}-${key}`);
				if (elem) elem.innerHTML = data['prediction'][i][key];
			}
		}
	}
	if ('overview' in data) {
		document.getElementById('overview').style.display = '';
		for (key in data['overview']) {
			let elem = document.getElementById(`overview-${key}`);
			if (elem) elem.innerHTML = data['overview'][key];
		}
	}

	console.log(data);
}
