<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" rel="jquery" type="text/javascript"></script>
<script src="http://code.highcharts.com/highcharts.js" rel="jquery" type="text/javascript"></script>
<script src="http://code.highcharts.com/modules/exporting.js" rel="jquery" type="text/javascript"></script>
<script src="http://code.highcharts.com/highcharts-3d.js" rel="jquery" type="text/javascript"></script>
<div id="container" ></div>
    <script>
	
		$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
				enabled: true,
                alpha: 15,
                beta: 0,
                depth: 110
            }
        },
        plotOptions: {
            column: {
                depth: 40,
                stacking: true,
                grouping: true,
                groupZPadding: 10
            }
        },
        series: [{
            data: [1, 2, 4, 3, 2, 4],
            stack: 0
        }, {
            data: [5, 6, 3, 4, 1, 2],
            stack: 2
        }, {
            data: [7, 9, 8, 7, 5, 8],
            stack: 1
        }]
    });
});
	
	</script>
  
