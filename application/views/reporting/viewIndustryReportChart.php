<script type='text/javascript'>
    $(function () {
        $("#szIndustry").customselect();
        $("#szTestType").customselect();
    });
</script>
<script src="<?php echo __BASE_JS_URL__;?>/jquery.min.js" rel="jquery" type="text/javascript"></script>
<script src="<?php echo __BASE_JS_URL__;?>/highcharts.js" rel="jquery" type="text/javascript"></script>
<script src="<?php echo __BASE_JS_URL__;?>/exporting.js" rel="jquery" type="text/javascript"></script>
<script src="<?php echo __BASE_JS_URL__;?>/highcharts-3d.js" rel="jquery" type="text/javascript"></script>
<div class="page-content-wrapper">
    <div class="page-content">
        <?php //test ?>

        <div id="page_content" class="row">
            <div class="col-md-12">
                <ul class="page-breadcrumb breadcrumb">

                    <li>
                        <a href="<?php echo __BASE_URL__; ?>">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>

                    <li>
                        <span class="active">Industry Chart</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">
                                    Industry Chart
                                </span>
                        </div>
                       
                    </div>

                    
                   
                    <div class="portlet-body alert">
                        <div class="row">
                            <div>
                                <div class="portlet green-meadow box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-users"></i>Industry Chart
                                        </div>

                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                            <tbody>
											
												<script>
	$(function () {
    $('#chart').highcharts({
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
                groupZPadding: 100
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
	 <div id="chart"></div>
	
                                           </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                

            </div>

        </div>

    </div>

</div>
</div>
</div>
</div>
</div>
<div id="popup_box"></div>