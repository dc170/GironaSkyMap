$(document).ready(function(){
	$.ajax({
		url: "http://185.61.148.168/graph/api/data_hour.php?dia=1",
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
						label: 'Paquetes - 30 de diciembre',
						data: hscore1,
						pointRadius: 0.01,
						borderColor: "red"
					}
				]
			};

			var ctx = $("#hours");
			
			var lineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
		
				});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
