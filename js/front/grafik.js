var grafik1 = document.getElementById("grafik1");
if(grafik1){
	$.getJSON('https://demo.simda.net/llaj_wonosobo/api/grafik1', function(data_v){
		Highcharts.chart('grafik1', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: data_v.judul
		    },
		    subtitle: {
		        text: data_v.sumber
		    },
		    xAxis: {
		        categories: data_v.x,
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Jumlah'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            grouping: false,
		            shadow: false,
		            borderWidth: 0
		        }
		    },
		    series: data_v.y
		});
	})
}

var grafik2 = document.getElementById("grafik2");
if(grafik2){
	$.getJSON('https://demo.simda.net/llaj_wonosobo/api/grafik2', function(data_v){
		Highcharts.chart('grafik2', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: data_v.judul
		    },
		    subtitle: {
		        text: data_v.sumber
		    },
		    xAxis: {
		        categories: data_v.x,
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Jumlah'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: data_v.y
		});
	})
}		