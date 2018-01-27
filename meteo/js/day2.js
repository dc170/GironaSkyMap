$(document).ready(function(){
	$.ajax({
		url: "http://185.61.148.168/graph/api/data_hour.php?dia=2",
		method: "GET",
		success: function(data) {
			console.log(data);
			var data1 = data;
			
			
			var hours1 = [];
			var hscore1 = [];

			for(var i in data1) {
				hours1.push("" + data1[i].hora);
				hscore1.push(data1[i].apariciones);
			}
			
			

			var chartdata = {
				labels: hours1, 
				datasets : [
					{	type: 'line',
						label: 'Paquetes - 31 de diciembre',
						data: hscore1,
						pointRadius: 0.01,
						borderColor: "blue"
					}
				]
			};

			var ctx = $("#hours2");
			
			var lineGraph = new Chart(ctx, {
				type: 'line',
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
								autoSkip: true
}
							}]
								}
							},
				});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
