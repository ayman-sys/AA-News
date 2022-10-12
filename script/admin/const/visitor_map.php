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

try {
$conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM tbl_blog_views WHERE v_date BETWEEN ? AND ? ORDER BY country_domain");
$stmt->execute([$between_date_1, $between_date_2]);
$result = $stmt->fetchAll();

$regions = [];
$latlong = [];
$country = [];
$current_region = "";


foreach($result as $row)
{
if ($current_region == $row[3]) {

}else{
if ($row[3] == "N/A") {

}else{
array_push($regions, $row[3]);
array_push($latlong, $row[6]);
array_push($country, $row[4]);
$current_region = $row[3];

}

}
}
}catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}

?>


<script>


$(function() {
	"use strict";

	if( $('#world_map_marker_1').length > 0 ){
		$('#world_map_marker_1').vectorMap(
		{
			map: 'world_mill_en',
			backgroundColor: 'transparent',
			borderColor: '#fff',
			borderOpacity: 0.25,
			borderWidth: 0,
			color: '#e6e6e6',
			regionStyle : {
				initial : {
				  fill : 'rgba(86,111,201,.4)'
				}
			  },

			markerStyle: {
			  initial: {
							r: 4,
							'fill': '#fff',
							'fill-opacity':1,
							'stroke': '#000',
							'stroke-width' : 1,
							'stroke-opacity': 0.4
						},
				},

			markers : [
        <?php
        $the_regions = count($regions);
        $viewd_regions = 0;
        try {
        $conn = new PDO('mysql:host='.DBHost.';dbname='.DBName.';charset='.DBCharset.';collation='.DBCollation.';prefix='.DBPrefix.'', DBUser, DBPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach($regions as $region) {
          $current_views = 0;

          $stmt = $conn->prepare("SELECT * FROM tbl_blog_views WHERE v_date BETWEEN ? AND ? AND country_domain = ?");
          $stmt->execute([$between_date_1, $between_date_2, $region]);
          $result = $stmt->fetchAll();

          foreach($result as $row)
          {
            $current_views++;
            $country = $row[4];
            $latlong = $row[6];
          }

          if ($the_regions == $viewd_regions) {
            ?>
            {
            latLng : [<?php echo $latlong; ?>],
            name : '<?php echo $country; ?> : <?php echo $current_views; ?>'

            }
            <?php
          }else{
            ?>
            {
            latLng : [<?php echo $latlong; ?>],
            name : '<?php echo $country; ?> : <?php echo $current_views; ?>'

            },
            <?php
          }

          $viewd_regions++;

        }


        }catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
        ?>

      ],

			series: {
				regions: [{
					values: {
            <?php
            foreach($regions as $region)
            {
              ?>
              "<?php echo $region; ?>": '#ff2a00',
              <?php
            }
            ?>
					},
					attribute: 'fill'
				}]
			},
			hoverOpacity: null,
			normalizeFunction: 'linear',
			zoomOnScroll: false,
			scaleColors: ['#000000', '#000000'],
			selectedColor: '#000000',
			selectedRegions: [],
			enableZoom: false,
			hoverColor: '#fff',
		});
	}

});


</script>
