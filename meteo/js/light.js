$(document).ready(function(){
	$.ajax({
		url: "http://gironaskymap.com/api/api.php?dumptable=llum&data=2017-12-18&sensor=1",
		method: "GET",
		success: function(data) {
			console.log(data);
			var hora = [];
			var llum = [];

			for(var i in data) {
				hora.push("" + data[i].data);
				llum.push(data[i].llum);
			}

			var chartdata = {
				labels: hora,
				datasets : [
					{
						label: 'Espectre visible de llum 2017-12-18 (en lumens)',
						backgroundColor: '#F8FFD1',
						borderColor: '#FBFF63',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: llum
					}
				]
			};

			var ctx = $("#llum1");

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
