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
                                
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                   <?php
                                    if ($szTestType == '' || $szTestType == 'A')
                                    {
                                        ?>
                                            <div id="alcohal"></div>
                                        <?php
                                    }
                                    if ($szTestType == '' || $szTestType == 'U')
                                    {
                                        ?>
                                             <div id="Urine"></div>
                                        <?php
                                    }
                                    if ($szTestType == '' || $szTestType == 'O')
                                    {
                                        ?>
                                            <div id="oral"></div>
                                        <?php
                                    }
                                    ?>
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
$alcohalCat='';
$totalAlcohalDoner='';
$totalPositiveAlcohol='';
$totalNegativeAlcohol='';
$totalDonarUrine='';
$totalPositiveUrine='';
$totalDonarOral='';
$totalPositiveDonarOral='';
$totalNegativeOral='';
if(!empty($getSosAndClientDetils))
{
    $totalPositiveDonarOralNeg='';
    $totalPositiveUrine='';
    foreach ($getSosAndClientDetils as $getSosAndClientData) 
    {
        $industryname = $this->Admin_Model->getIndustryNameByid($getSosAndClientData['industry']);
        $alcohalCat[] = $industryname['szName'];
	$totalAlcohalDoner[]=$getSosAndClientData['totalAlcohol'];
	$totalPositiveAlcohol[]=$getSosAndClientData['totalPositiveAlcohol'];
	$totalNegativeAlcohol[]=$getSosAndClientData['totalNegativeAlcohol'];
	$totalDonarUrine[]=$getSosAndClientData['totalDonarUrine'];
	$totalPositiveUrineNeg = ($getSosAndClientData['totalDonarUrine'] - $getSosAndClientData['totalNegativeUrine']);
	$totalPositiveUrine[]=$totalPositiveUrineNeg < 0 ? 0 : $totalPositiveUrineNeg;
	$totalNegativeUrine[]=$getSosAndClientData['totalNegativeUrine'];
	$totalDonarOral[]=$getSosAndClientData['totalDonarOral'];
	$totalPositiveDonarOralNeg = ($getSosAndClientData['totalDonarOral'] - $getSosAndClientData['totalNegativeOral']);
	$totalPositiveDonarOral[]=$totalPositiveDonarOralNeg < 0 ? 0 : $totalPositiveDonarOralNeg;
        $totalNegativeOral[]= $getSosAndClientData['totalNegativeOral'];
    }
	$alcohalCat = "'" . implode("','",  $alcohalCat) . "'";
	$totalAlcohalDoner = "" . implode(",",  $totalAlcohalDoner) . "";
	$totalPositiveAlcohol = "" . implode(",",  $totalPositiveAlcohol) . "";
	$totalNegativeAlcohol = "" . implode(",",  $totalNegativeAlcohol) . ""; 
	$totalDonarUrine = "" . implode(",",  $totalDonarUrine) . "";
	$totalPositiveUrine = "" . implode(",",  $totalPositiveUrine) . "";
	$totalNegativeUrine = "" . implode(",",  $totalNegativeUrine) . "";
	$totalDonarOral = "" . implode(",",  $totalDonarOral) . ""; 
	$totalPositiveDonarOral = "" . implode(",",  $totalPositiveDonarOral) . ""; 
        $totalNegativeOral = "" . implode(",",  $totalNegativeOral) . "";
}
 

?>

<script type="text/javascript">
   $(function () {

    $('#alcohal').highcharts({
        colors: ['#2f7ed8','#D2691E','#A9A9A9'],

        chart: {
            type: 'column',
            margin: 75,
            marginBottom: 100,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 0,
                depth: 110
            }
        },
        title: {
                        text: 'Alcohol Test, Industry Comparison'
                    },
        xAxis: {
                categories: [<?php echo $alcohalCat ;?>],
                
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
            name: 'Alcohol Total Donors',
            data: [<?php echo $totalAlcohalDoner ;?>],
            stack: 0
            
        }, {
             name: 'Alcohol Positive Result',
            data: [<?php echo $totalPositiveAlcohol;?>],
            stack: 2
        }, {
            name: 'Alcohol Negative Result',
            data: [<?php echo $totalNegativeAlcohol;?>],
            stack: 1
        }]



    });
    $('#Urine').highcharts({
         colors: ['#6495ED','#98FB98','#483D8B'],
        chart: {
            type: 'column',
            margin: 75,
            marginBottom: 120,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 0,
                depth: 110
            }
        },
        title: {
                    text: 'Urine AS/NZA 4308:2001/ As/NZA 4308:2008'
        },
		xAxis: {
                categories: [<?php echo $alcohalCat ;?>]
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
            name: 'Urine AS/NZA 4308:2001/ As/NZA 4308:2008 Total Donors',
            data: [<?php echo $totalDonarUrine;?>],
            stack: 0
        }, {
            name: 'Urine AS/NZA 4308:2001/ As/NZA 4308:2008 Positive Result',
            data: [<?php echo $totalPositiveUrine;?>],
            stack: 2
        }, {
            name: 'Urine AS/NZA 4308:2001/ As/NZA 4308:2008 Negative Result',
            data: [<?php echo $totalNegativeUrine;?>],
            stack: 1
        }]

    });
    $('#oral').highcharts({
          colors: ['#696969','#DAA520','#4169E1'],
        chart: {
            type: 'column',
             margin: 75,
             marginBottom: 100,
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 0,
                depth: 110
            }
        },
        title: {
                text: 'Oral Fluid AS 4760:2006'
        },
        xAxis: {
                categories: [<?php echo $alcohalCat ;?>]
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
            name: 'Oral Fluid AS 4760:2006 Total Donors',
            data: [<?php echo $totalDonarOral;?>],
            stack: 0
        }, {
            name: 'Oral Fluid AS 4760:2006 Positive Result',
            data: [<?php echo $totalPositiveDonarOral;?>],
            stack: 2
        }, {
            name: 'Oral Fluid AS 4760:2006 Negative Result',
            data: [<?php echo $totalNegativeOral;?>],
            stack: 1
        }]

    });
});
</script>
