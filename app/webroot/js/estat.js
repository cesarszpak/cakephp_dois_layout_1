$(function(){
	$.getJSON(base_url+'ajax/estatisticas/visitas', function(data) {
		$('#estatisticas').css({'height':'200px'});
		$.plot("#estatisticas", data, {
			yaxis: {
				min: 0
			},
			xaxis: {
				mode: "time",
				timeformat: "%d/%m/%Y"
			},
			series: {
				lines: {
					show: true
				},
				points: {
					show: true
				}
			}
		});
	});
});