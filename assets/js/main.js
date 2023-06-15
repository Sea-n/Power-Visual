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
		console.log(resp);
	});

	return false;  // Don't submit the HTML form
}

const queryForm = document.getElementById('query');
queryForm.onsubmit = fetchApi;
