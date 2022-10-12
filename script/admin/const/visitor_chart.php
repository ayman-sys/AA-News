<?php
$today = date('l');
$todate = date('Y-m-d');

switch($today) {
case 'Saturday';
$sat_this = $todate;
$sun_this = date('Y-m-d', strtotime($todate. ' + 1 days'));
$mon_this = date('Y-m-d', strtotime($todate. ' + 2 days'));
$tue_this = date('Y-m-d', strtotime($todate. ' + 3 days'));
$wed_this = date('Y-m-d', strtotime($todate. ' + 4 days'));
$thu_this = date('Y-m-d', strtotime($todate. ' + 5 days'));
$fri_this = date('Y-m-d', strtotime($todate. ' + 6 days'));
break;

case 'Sunday';
$sat_this = date('Y-m-d', strtotime($todate. ' - 1 days'));
$sun_this = $todate;
$mon_this = date('Y-m-d', strtotime($todate. ' + 1 days'));
$tue_this = date('Y-m-d', strtotime($todate. ' + 2 days'));
$wed_this = date('Y-m-d', strtotime($todate. ' + 3 days'));
$thu_this = date('Y-m-d', strtotime($todate. ' + 4 days'));
$fri_this = date('Y-m-d', strtotime($todate. ' + 5 days'));
break;

case 'Monday';
$sat_this = date('Y-m-d', strtotime($todate. ' - 2 days'));
$sun_this = date('Y-m-d', strtotime($todate. ' - 1 days'));
$mon_this = $todate;
$tue_this = date('Y-m-d', strtotime($todate. ' + 1 days'));
$wed_this = date('Y-m-d', strtotime($todate. ' + 2 days'));
$thu_this = date('Y-m-d', strtotime($todate. ' + 3 days'));
$fri_this = date('Y-m-d', strtotime($todate. ' + 4 days'));
break;

case 'Tuesday';
$sat_this = date('Y-m-d', strtotime($todate. ' - 3 days'));
$sun_this = date('Y-m-d', strtotime($todate. ' - 2 days'));
$mon_this = date('Y-m-d', strtotime($todate. ' - 1 days'));
$tue_this = $todate;
$wed_this = date('Y-m-d', strtotime($todate. ' + 1 days'));
$thu_this = date('Y-m-d', strtotime($todate. ' + 2 days'));
$fri_this = date('Y-m-d', strtotime($todate. ' + 3 days'));
break;

case 'Wednesday';
$sat_this = date('Y-m-d', strtotime($todate. ' - 4 days'));
$sun_this = date('Y-m-d', strtotime($todate. ' - 3 days'));
$mon_this = date('Y-m-d', strtotime($todate. ' - 2 days'));
$tue_this = date('Y-m-d', strtotime($todate. ' - 1 days'));
$wed_this = $todate;
$thu_this = date('Y-m-d', strtotime($todate. ' + 1 days'));
$fri_this = date('Y-m-d', strtotime($todate. ' + 2 days'));
break;

case 'Thursday';
$sat_this = date('Y-m-d', strtotime($todate. ' - 5 days'));
$sun_this = date('Y-m-d', strtotime($todate. ' - 4 days'));
$mon_this = date('Y-m-d', strtotime($todate. ' - 3 days'));
$tue_this = date('Y-m-d', strtotime($todate. ' - 2 days'));
$wed_this = date('Y-m-d', strtotime($todate. ' - 1 days'));
$thu_this = $todate;
$fri_this = date('Y-m-d', strtotime($todate. ' + 1 days'));
break;

case 'Friday';
$sat_this = date('Y-m-d', strtotime($todate. ' - 6 days'));
$sun_this = date('Y-m-d', strtotime($todate. ' - 5 days'));
$mon_this = date('Y-m-d', strtotime($todate. ' - 4 days'));
$tue_this = date('Y-m-d', strtotime($todate. ' - 3 days'));
$wed_this = date('Y-m-d', strtotime($todate. ' - 2 days'));
$thu_this = date('Y-m-d', strtotime($todate. ' - 1 days'));
$fri_this = $todate;
break;
}

$sat_last = date('Y-m-d', strtotime($sat_this. ' - 7 days'));
$sun_last = date('Y-m-d', strtotime($sat_this. ' - 6 days'));
$mon_last = date('Y-m-d', strtotime($sat_this. ' - 5 days'));
$tue_last = date('Y-m-d', strtotime($sat_this. ' - 4 days'));
$wed_last = date('Y-m-d', strtotime($sat_this. ' - 3 days'));
$thu_last = date('Y-m-d', strtotime($sat_this. ' - 2 days'));
$fri_last = date('Y-m-d', strtotime($sat_this. ' - 1 days'));

$between_date_1 = date('Y-m-d', strtotime($sat_last. ' - 1 days'));
$between_date_2 = date('Y-m-d', strtotime($fri_this. ' + 1 days'));


$last_week_sat = 0;
$last_week_sun = 0;
$last_week_mon = 0;
$last_week_tue = 0;
$last_week_wed = 0;
$last_week_thu = 0;
$last_week_fri = 0;

$this_week_sat = 0;
$this_week_sun = 0;
$this_week_mon = 0;
$this_week_tue = 0;
$this_week_wed = 0;
$this_week_thu = 0;
$this_week_fri = 0;

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_blog_views WHERE v_date BETWEEN ? AND ?");
$stmt->execute([$between_date_1, $between_date_2]);
$result = $stmt->fetchAll();

foreach($result as $row)
{
	if ($sat_last == $row[2]) {
		$last_week_sat++;
	}

	if ($sun_last == $row[2]) {
		$last_week_sun++;
	}

	if ($mon_last == $row[2]) {
		$last_week_mon++;
	}

	if ($tue_last == $row[2]) {
		$last_week_tue++;
	}

	if ($wed_last == $row[2]) {
		$last_week_wed++;
	}

	if ($thu_last == $row[2]) {
		$last_week_thu++;
	}

	if ($fri_last == $row[2]) {
		$last_week_fri++;
	}


	if ($sat_this == $row[2]) {
		$this_week_sat++;
	}

	if ($sun_this == $row[2]) {
		$this_week_sun++;
	}

	if ($mon_this == $row[2]) {
		$this_week_mon++;
	}

	if ($tue_this == $row[2]) {
		$this_week_tue++;
	}

	if ($wed_this == $row[2]) {
		$this_week_wed++;
	}

	if ($thu_this == $row[2]) {
		$this_week_thu++;
	}

	if ($fri_this == $row[2]) {
		$this_week_fri++;
	}


}
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}



$this_week_final = $this_week_sat + $this_week_sun + $this_week_mon + $this_week_tue + $this_week_wed + $this_week_thu + $this_week_fri;
$last_week_final = $last_week_sat + $last_week_sun + $last_week_mon + $last_week_tue + $last_week_wed + $last_week_thu + $last_week_fri;
$total_Views = $this_week_final + $last_week_final;

?>

<script>
document.getElementById('last_week').innerHTML = <?php echo $last_week_final; ?>;
document.getElementById('this_week').innerHTML = <?php echo $this_week_final; ?>;
document.getElementById('sum_v').innerHTML = <?php echo $total_Views; ?>;

"use strict";
$(document).ready(function(){
	$('#statement').DataTable({
		"bFilter": false,
		"bLengthChange": false,
		"bPaginate": false,
		"bInfo": false,
	});

	if($('#morris_extra_line_chart').length > 0) {
		var data=[{
            period: 'Sat',
            Views: <?php echo $last_week_sat; ?>
        }, {
            period: 'Sun',
            Views: <?php echo $last_week_sun; ?>
        }, {
            period: 'Mon',
            Views: <?php echo $last_week_mon; ?>
        }, {
            period: 'Tue',
            Views: <?php echo $last_week_tue; ?>
        }, {
            period: 'Wed',
            Views: <?php echo $last_week_wed; ?>
        }, {
            period: 'Thu',
            Views: <?php echo $last_week_thu; ?>
        },
         {
            period: 'Fri',
            Views: <?php echo $last_week_fri; ?>
        }];
		var dataNew = [{
            period: 'Sat',
            Views: <?php echo $this_week_sat; ?>
        },
		{
            period: 'Sun',
            Views: <?php echo $this_week_sun; ?>
        },
		{
            period: 'Mon',
            Views: <?php echo $this_week_mon; ?>
        },
		{
            period: 'Tue',
            Views: <?php echo $this_week_tue; ?>
        },
		{
            period: 'Wed',
            Views: <?php echo $this_week_wed; ?>
        },
		{
            period: 'Thu',
            Views: <?php echo $this_week_thu; ?>
        },

		{
            period: 'Fri',
            Views: <?php echo $this_week_fri; ?>
        }
		];
		var lineChart = Morris.Line({
        element: 'morris_extra_line_chart',
        data: data ,
        xkey: 'period',
        ykeys: ['Views'],
        labels: ['Views'],
        pointSize: 2,
        fillOpacity: 0,
		lineWidth:2,
		pointStrokeColors:['#e91e63'],
		behaveLikeLine: true,
		gridLineColor: '#878787',
		hideHover: 'auto',
		lineColors: ['#e91e63'],
		resize: true,
		redraw: true,
		gridTextColor:'#878787',
		gridTextFamily:"Poppins,sans-serif",
        parseTime: false
    });

	}

	var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
	$('#morris_switch').each(function() {
		new Switchery($(this)[0], $(this).data());
	});
	var swichMorris = function() {
		if($("#morris_switch").is(":checked")) {
			lineChart.setData(data);
			lineChart.redraw();
		} else {
			lineChart.setData(dataNew);
			lineChart.redraw();
		}
	}
	swichMorris();
	$(document).on('change', '#morris_switch', function () {
		swichMorris();
	});

});

var sparkResize;
	$(window).resize(function(e) {
		clearTimeout(sparkResize);
		sparkResize = setTimeout(sparklineLogin, 200);
	});
sparklineLogin();

</script>
