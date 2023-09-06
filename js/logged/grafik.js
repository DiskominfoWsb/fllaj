$.ajax({
    url: jbase+'giadmin/grafik/data1',
    mimeType:"multipart/form-data",
    dataType:"json",
    success: function(data)
    {
    	chart1(data);
    }          
});  
$.ajax({
    url: jbase+'giadmin/grafik/data2',
    mimeType:"multipart/form-data",
    dataType:"json",
    success: function(data)
    {
    	chart2(data);
    }          
});  
$.ajax({
    url: jbase+'giadmin/grafik/data3',
    mimeType:"multipart/form-data",
    dataType:"json",
    success: function(data)
    {
    	chart3(data);
    }          
}); 

function chart1(data){
	Highcharts.chart('chart1', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: judul1
	    },
	    subtitle: {
	        text: 'Wahyu Febriyana'
	    },
	    xAxis: {
	        type: 'category'
	    },
	    yAxis: {
	        title: {
	            text: 'Pelanggaran'
	        }

	    },
	    legend: {
	        enabled: false
	    },
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y:f}'
	            }
	        }
	    },

	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> Pelanggaran<br/>'
	    },

	    series: [
	        {
	            name: "Pelanggaran",
	            colorByPoint: true,
	            data: data
	        }
	    ]
	});
}

function chart2(data){
	Highcharts.chart('chart2', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: judul2
	    },
	    subtitle: {
	        text: 'Wahyu Febriyana'
	    },
	    xAxis: {
	        categories: data.x,
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Pelanggaran'
	        }
	    },
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y:f} Pelanggaran</b></td></tr>',
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
	    series: data.y
	});
}

function chart3(data){
	Highcharts.chart('chart3', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: judul3
	    },
	    subtitle: {
	        text: 'Wahyu Febriyana'
	    },
	    xAxis: {
	        type: 'category'
	    },
	    yAxis: {
	        title: {
	            text: 'Pelanggaran'
	        }

	    },
	    legend: {
	        enabled: false
	    },
	    plotOptions: {
	        series: {
	            borderWidth: 0,
	            dataLabels: {
	                enabled: true,
	                format: '{point.y:f}'
	            }
	        }
	    },

	    tooltip: {
	        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
	        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f}</b> Pelanggaran<br/>'
	    },

	    series: [
	        {
	            name: "Pelanggaran",
	            colorByPoint: true,
	            data: data
	        }
	    ]
	});
}