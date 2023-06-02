function fetchApi() {
	fetch('./api.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			date: 2023,
		}),
	}).then(resp => resp.json())
	.then((resp) => {
		console.log(resp);
	});

	return false;  // Don't submit the HTML form
}
