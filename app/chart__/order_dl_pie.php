<?php
//include("app/include/sambung.php");

$data2 = '';
$i=0;
/*$sql1=mysql_query("select 'sssss' clncde, 1 clnid, 'xxxxxxxx' clndcr
					union all
					select 'aaaa' clncde, 2 clnid, 'dddddddddd' clndcr"); */
$sql1="select 'sssss' clncde, 1 clnid, 'xxxxxxxx' clndcr
					union all
					select 'aaaa' clncde, 2 clnid, 'dddddddddd' clndcr
					union all
					select 'bbbbb' clncde, 3 clnid, 'wwwwwwww' clndcr";
$result1 = odbc_exec(condb,$sql1);
										
while ($row_do=odbc_fetch_object($result1)) {
	//$sql2=mysql_query("select count(delordcde) jmldo from delord where clncde='$row_do->clncde'");
	$sql2 = "select 3 jmldo";
	$result = odbc_exec(condb,$sql2);
	
	$row_jml=odbc_fetch_object($result);
	if ($row_jml->jmldo > 0) {
		$do_count = $row_jml->jmldo;
	} else {
		$do_count = 0;
	}
	
	if ($i==0) {
		if(empty($row_do->clnid)) {
			$data2 = '{
					"country2": "'.$row_do->clncde.'",
					"value2": '.$do_count.'
				}';
		} else {
			$data2 = '{
					"country2": "'.$row_do->clnid.'",
					"value2": '.$do_count.'
				}';
		}
		
	} else {
		if(empty($row_do->clnid)) {
			$data2 = $data2 . ', {
					"country2": "'.$row_do->clncde.'",
					"value2": '.$do_count.'
				}';
		} else {
			$data2 = $data2 . ', {
					"country2": "'.$row_do->clnid.'",
					"value2": '.$do_count.'
				}';
		}
		
	}
	
	$i++;
}
?>

<?php
echo '
<script type="text/javascript">
	var chart;
	var legend;

	var chartData2 = [
		'.$data2.'
	];
</script> ';
?>

<script type="text/javascript">
	AmCharts.ready(function () {
		// PIE CHART
		chart = new AmCharts.AmPieChart();
		chart.dataProvider = chartData2;
		chart.titleField = "country2";
		chart.valueField = "value2";
		chart.outlineColor = "#FFFFFF";
		chart.outlineAlpha = 0.8;
		chart.outlineThickness = 2;
		chart.balloonText = "[[title]]<br><span style='font-size:10px'><b>[[value2]]</b> ([[percents]]%)</span>";
		// this makes the chart 3D
		chart.depth3D = 15;
		chart.angle = 30;

		// WRITE
		chart.write("chartdiv2");
	});
</script>

<div id="chartdiv2" style="width: 100%; height: 300px;"></div>
