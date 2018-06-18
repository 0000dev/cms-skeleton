<?php // -------------- CHARTS.Traffic ?>

<?php if (isset($z['sweb_traffic_by_months'])): ?>
    <div class="container pad-40">
        <h3><?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_TRAFFIC_BY_MONTHS)?> <span>(estimated)</span></h3>
            
        <div class="row">
            <div class="twelve columns">
<?php

         	$traffic_array = json_decode($z['sweb_traffic_by_months'], true);
         	$labels = $data = '';
         	$chartdatan = '';
         	$tension = 0.5;

	        foreach ($traffic_array as $key => $value) {

	        	if ($value == 0)
	        		$tension = 0.1;

	        	$correction_rate = strlen($z['name']);

	        	if ($traffic_array[$key] < 50000)
		     		$correction_rate = $correction_rate*2;
		     	elseif ($traffic_array[$key] < 10000)
		     		$correction_rate = $correction_rate*3;

	        	$labels = ''.date('F', strtotime($key)).'';
	        	$data = ceil($value/100*(100-$correction_rate)).'';

	        	$last_key = $key;
                        $chartdatan .= "['".$labels."', ".$data."], ";
	        }
         ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'X');
      data.addColumn('number', 'Visitors');

      data.addRows([
        <?=$chartdatan?>
      ]);

      var options = {
        series: {
            0: { color: '#ff7743' }
          },
        hAxis: {
          title: ''
        },
        vAxis: {
          title: ''
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
    </script>
    <div id="chart_div" class="pd-web-gray-bdr" style="height: 250px">
        <div class="loadergif"><img src="<?= HTML_RESOURCES_FOLDER ?>/img/waiting_icon.gif"/></div>
    </div>

                </div> 
            </div>
        </div>

<?php endif; ?>


<?php // -------------- CHARTS.countries ?>

<?php if (isset($z['2compete_traffic_by_countries'])): ?>
	
    <div class="container pad-40">
            <div class="small-12 medium-4 large-3 cell">
                <h3 class="zoo-det-h3"><?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_TRAFFIC_BY_COUNTRIES)?></h3>
            </div>
            <div class="small-12 medium-8 large-9 cell">
                <div class="zoo-det-conts">
                    <table class="zoo-table">
 
			<th>Country</th>
			<th>Visits %</th>
			<th>Pageviews %</th>

			<?php


				$traffic_countries_array = json_decode($z['2compete_traffic_by_countries'], true);
				$labels = $data = '';
				$total_visits_percent = 0;
				$total_pv_percent = 0;
				$google_map_data = '';
				$jquery_map = '';

				foreach ($traffic_countries_array as $key => $value) {

		         	$labels .= '"'.$key.'",';
		         	$data .= $value['visits_percent'].',';

		         	$total_visits_percent += $value['visits_percent'];
		         	$total_pv_percent += $value['pageviews_percent'];

		         	$google_map_data .= "['".$key."',".ceil(($value['visits_percent']/100)*$traffic_array[$last_key]*(1-$correction_rate/100))."],\n\t\t\t";

		         	$jquery_map .= '"'.strtoupper($value['flag']).'":'.ceil(($value['visits_percent']/100)*$traffic_array[$last_key]*(1-$correction_rate/100)).",\n";

					echo '<tr>
								 
								<td><img src="'.HTML_RESOURCES_FOLDER.'/css/blank.gif" class="flag flag-'.$value['flag'].'"   /> &nbsp;'.$key.'</td>
								<td>'.$value['visits_percent'].'</td>
								<td>'.$value['pageviews_percent'].'</td>
						  </tr>';
				}

			?>

			<tr>
				<td>Other</td> <td><?=(100-$total_visits_percent)?></td> <td><?=(100-$total_pv_percent)?></td>
			</tr>

		</table>
            <br><br>
	    <div id="world-map" style="height:300px"></div>


		<script>
		$(document).ready(function () {
			$(function(){
				var gdpData = {
				<?=$jquery_map?>
				"UNDEFINED": 5.73,

			};

			$('#world-map').vectorMap({
				map: 'world_mill',
				backgroundColor: '#0000000',
				zoomOnScroll: false,
				series: {
				regions: [{
					values: gdpData,
					scale: ['#a0a0a0', '#2f363e'],
					normalizeFunction: 'polynomial'
					}]
				},
					onRegionTipShow: function(e, el, code){
						el.html(el.html()+' (Visits - '+gdpData[code]+')');
					}
				});

			});
		});
		</script>

                </div>
            </div>
        </div>


<?php endif; ?>
