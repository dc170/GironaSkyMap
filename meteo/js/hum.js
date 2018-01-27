$(document).ready(function(){
	$.ajax({
		url: "http://gironaskymap.com/api/api.php?dumptable=humitat&data=2017-12-18&sensor=1",
		method: "GET",
		success: function(data) {
			console.log(data);
			var hora = [];
			var humitat = [];

			for(var i in data) {
				hora.push("" + data[i].data);
				humitat.push(data[i].humitat);
			}

			var chartdata = {
				labels: hora,
				datasets : [
					{
						label: 'Humitat 2017-12-18 en %',
						backgroundColor: '#D1F5FF',
						borderColor: '#63DDFF',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: humitat
					}
				]
			};

			var ctx = $("#hum1");

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
