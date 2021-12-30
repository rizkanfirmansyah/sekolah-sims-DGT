<?php
$select=new select;

$data = '';
$i=0;
/*$sql1=mysql_query("select 'sssss' clncde, 1 clnid, 'xxxxxxxx' clndcr
					union all
					select 'aaaa' clncde, 2 clnid, 'dddddddddd' clndcr"); */
$sql=$select->list_order_status();
//$result1 = odbc_exec(condb,$sql);
while ($row_data=odbc_fetch_object($sql)) {
	echo $row_data->total_order."<br>";	
}
										
while ($row_do=odbc_fetch_object($result1)) {
	//$sql2=mysql_query("select count(delordcde) jmldo from delord where clncde='$row_do->clncde'");
	$sql2 = "select 2 jmldo";
	$result = odbc_exec(condb,$sql2);
	
	$row_jml=odbc_fetch_object($result);
	if ($row_jml->jmldo > 0) {
		$do_count = $row_jml->jmldo;
	} else {
		$do_count = 0;
	}
	
	if ($i==0) {
		if(empty($row_do->clnid)) {
			$data = '{
					"country": "'.$row_do->clncde.'",
					"value": '.$do_count.'
				}';
		} else {
			$data = '{
					"country": "'.$row_do->clnid.'",
					"value": '.$do_count.'
				}';
		}
		
	} else {
		if(empty($row_do->clnid)) {
			$data = $data . ', {
					"country": "'.$row_do->clncde.'",
					"value": '.$do_count.'
				}';
		} else {
			$data = $data . ', {
					"country": "'.$row_do->clnid.'",
					"value": '.$do_count.'
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

	var chartData = [
		'.$data.'
	];
</script> ';
?>

<script type="text/javascript">
	AmCharts.ready(function () {
		// PIE CHART
		chart = new AmCharts.AmPieChart();
		chart.dataProvider = chartData;
		chart.titleField = "country";
		chart.valueField = "value";
		chart.outlineColor = "#FFFFFF";
		chart.outlineAlpha = 0.8;
		chart.outlineThickness = 2;
		chart.balloonText = "[[title]]<br><span style='font-size:10px'><b>[[value]]</b> ([[percents]]%)</span>";
		// this makes the chart 3D
		chart.depth3D = 15;
		chart.angle = 30;

		// WRITE
		chart.write("chartdiv");
	});
</script>

<div id="chartdiv" style="width: 100%; height: 300px;"></div>
