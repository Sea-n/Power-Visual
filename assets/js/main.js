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
			console.error(resp);
			return;
		}

		renderResult(resp.results);
	});

	return false;  // Don't submit the HTML form
}

function renderResult(results) {
	console.log(results);
}
