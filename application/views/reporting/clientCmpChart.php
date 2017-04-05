<script type='text/javascript'>
    $(function () {
        $("#szIndustry").customselect();
        $("#szTestType").customselect();
    });
</script>


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
                        <span class="active">Client Comparison Chart</span>
                    </li>
                </ul>

                <div class="portlet light bordered about-text" id="user_info">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">
                                    Client Comparison Chart
                                </span>
                        </div>
                       
                    </div>
                    <div class="portlet-body alert">
                        <div class="row">
                            <div>
                                
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <div id="comparesionchart"></div>
                                       
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
<?php

if(!empty($compareresultarr))
{
    foreach ($compareresultarr as $comparisondata) 
    {
        $comparesionCat[]=($comparetype == 1 ? $comparisondata['month'] : $comparisondata['year']);
        $TotalDonors[]=($testtype == '1'?$comparisondata['totalAlcohol']:($testtype == '3'?$comparisondata['totalDonarUrine']:($testtype == '2'?$comparisondata['totalDonarOral']:($testtype=='4'?$comparisondata['totalDonarUrine']:'0'))));
        $Positive[]=($testtype == '1'?$comparisondata['totalPositiveAlcohol']:($testtype == '3'?($comparisondata['totalDonarUrine']-$comparisondata['totalNegativeUrine']):($testtype == '2'?($comparisondata['totalDonarOral']-$comparisondata['totalNegativeOral']):($testtype=='4'?($comparisondata['totalDonarUrine']-$comparisondata['totalNegativeUrine']):'0'))));
        $Negative[]=($testtype == '1'?$comparisondata['totalNegativeAlcohol']:($testtype == '3'?$comparisondata['totalNegativeUrine']:($testtype == '2'?$comparisondata['totalNegativeOral']:($testtype=='4'?$comparisondata['totalNegativeUrine']:'0'))));
       
    }
    $comparesionCat = "'" . implode("','",  $comparesionCat) . "'";
    $TotalDonors = "" . implode(",",  $TotalDonors) . "";
    $Positive = "" . implode(",",  $Positive) . "";
    $Negative = "" . implode(",",  $Negative) . "";
	
}
 $testType=($testtype == '1'?'Alcohol':($testtype == '3'?'Urine AS/NZA 4308:2001':($testtype == '2'?'Oral Fluid AS 4760:2006':($testtype=='4'?'As/NZA 4308:2008':''))));
?>
<input type="hidden" id="charttesttype" value="<?php echo $testType;?>" />
<script type="text/javascript">
   $(function () {
var testtypeval = $('#charttesttype').val();
    $('#comparesionchart').highcharts({
        yAxis: {
        	allowDecimals: false,
        labels: {
            formatter: function () {
                //return Highcharts.numberFormat(this.value,0);
                return this.value;
            }
        }
    },
        colors: ['#2f7ed8','#D2691E','#A9A9A9'],

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
        title: {
                        text: '<?php echo $testType;?>'
                    },
        xAxis: {
                categories: [<?php echo $comparesionCat ;?>],
                
            },
        plotOptions: {
            column: {
                depth: 40,
                stacking: true,
                grouping: true,
                groupZPadding: 100,
				dataLabels: {
                enabled: true,
                crop: false,
                overflow: 'none',
				verticalAlign: 'top'
            }
            }
        },
        series: [{
            name: 'Total Donors Screenings/Collection at Clients sites',
            data: [<?php echo $TotalDonors;?>],
            stack: 0
            
        }, {
             name: 'Positive Test Result',
            data: [<?php echo $Positive;?>],
            stack: 2
        }, {
            name: 'Negative Test Result',
            data: [<?php echo $Negative;?>],
            stack: 1
        }]



    });
    
});
</script>
