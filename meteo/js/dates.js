$(document).ready(function(){
	$.ajax({
		url: "http://gironaskymap.com/api/api.php?getdates=1&count=1&sensor=1",
		method: "GET",
		success: function(data) {
			console.log(data);
			var dt = [];
			var values = [];

			for(var i in data) {
				dt.push("" + data[i].data);
				values.push(data[i].values);
			}

			var chartdata = {
				labels: dt,
				datasets : [
					{
						label: 'Registres trobats',
						backgroundColor: '#C9D3D6',
						borderColor: '#64CCE9',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: values
					}
				]
			};

			var ctx = $("#values");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				
				});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
