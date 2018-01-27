$(document).ready(function(){
	$.ajax({
		url: "http://gironaskymap.com/api/api.php?dumptable=temperatura&data=2017-12-18&sensor=1",
		method: "GET",
		success: function(data) {
			console.log(data);
			var hora = [];
			var temperatura = [];

			for(var i in data) {
				hora.push("" + data[i].data);
				temperatura.push(data[i].temp);
			}

			var chartdata = {
				labels: hora,
				datasets : [
					{
						label: 'Temperatura 2017-12-18 en ºC',
						backgroundColor: '#F4B4B3',
						borderColor: '#FF7163',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: temperatura
					}
				]
			};

			var ctx = $("#temp1");

			var barGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				
				});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
