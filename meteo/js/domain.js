$(document).ready(function(){
	$.ajax({
		url: "http://185.61.148.168//graph/api/get_domains.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var domain = [];
			var dscore = [];

			for(var i in data) {
				domain.push("" + data[i].domain);
				dscore.push(data[i].apariciones);
			}

			var chartdata = {
				labels: domain,
				datasets : [
					{
						label: 'Packets',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: dscore
					}
				]
			};

			var ctx = $("#domains");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: {
					scaleShowValues: true,
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
								}
							}],
						xAxes: [{
							ticks: {
								autoSkip: false
}
							}]
								}
							}
				});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
