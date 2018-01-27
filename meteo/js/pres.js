$(document).ready(function(){
	$.ajax({
		url: "http://gironaskymap.com/api/api.php?dumptable=presio&data=2017-12-18&sensor=1",
		method: "GET",
		success: function(data) {
			console.log(data);
			var hora = [];
			var presio = [];

			for(var i in data) {
				hora.push("" + data[i].data);
				presio.push(data[i].presio);
			}

			var chartdata = {
				labels: hora,
				datasets : [
					{
						label: 'Presio ATM 2017-12-18 (en Pa)',
						backgroundColor: '#D1DAFF',
						borderColor: '#6363FF',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: presio
					}
				]
			};

			var ctx = $("#pres1");

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
