<!-- ------ Page insights BEGIN ------ -->

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 ">
		<h4>
			<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
			<?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_PAGE_INSIGHTS)?>
		</h4> 

		<ul class="nav nav-tabs">
			<li><a data-toggle="tab" href="#desktop" class="bold">Desktop</a></li>
			<? if (isset($z['google_insights_mobile'])): ?>
			<li class="active"><a id="autoclick" data-toggle="tab" href="#mobile" class="bold">Mobile</a></li>
			<? endif; ?>
		</ul>

		<br>
	</div>
</div>

<div class="row">

	<div class="tab-content">

		<!-- ------ Desktop tab ------ -->

		<div id="desktop" class="tab-pane fade">

			<? if ($z['nsfw_score']<0.1): ?>

				<?  
				if ( 	
					$z['google_insights_desktop']['gzip'] == 1
					and $z['google_insights_desktop']['MinifyCss'] == 1
					and $z['google_insights_desktop']['MinifyHTML'] == 1
					and $z['google_insights_desktop']['MinimizeRenderBlockingResources'] == 1
					and $z['google_insights_desktop']['LeverageBrowserCaching'] == 1
					)
				$z['google_insights_desktop']['speed'] = 100;
				?>
				<div class="col-lg-6 col-md-6 col-sm-6">

					<div class="imagescontainer">

						<img class="macbgimg" src="<?=HTML_RESOURCES_FOLDER?>/img/desktop_dummy.png">

						<img alt="Screenshot of <?=ucfirst($z['name'])?> main page" class="macfrontimg" src="http://images.ppdd.me/screenshots<?=$z['screenshot_desktop']?>">

					</div> 

				</div>

				<!-- ------ IMPORTANT. Following col-lg-6  is changed to col-lg-12 when nsfw score is high ------ -->

				<div class="col-lg-6 col-md-6 col-sm-6">

			<? else: // screenshot contains adult image and should be hidden [1] 

				echo '<div class="col-lg-12 col-md-12 col-sm-12">';
			
			?>

			<? endif; // nsfw_score  ?>

				<!-- row inside row #1 BEGIN -->

				<div id="row">
					<div class="col-lg-4 col-md-5 col-sm-6">
						<div id="desktopspeedscore"></div>
					</div>

					<div class="col-lg-8 col-md-7 col-sm-6">
						<div class="alert alert-success suggestionpannel summaryscore

						" role="alert" style="text-align:left;font-size:13px;">
						<span class="glyphicon glyphicon-info-sign insidepannel" aria-hidden="true"></span> 
						<?=$this->tagReplacer(PAGE_INSIGHTS_SUMMARY_SCORE,$z)?>
						</div>
					</div>
				</div>

				<!-- row inside row #1 END -->

			<script>
				var desktopspeedscore = new JustGage({
					id: "desktopspeedscore",
					value: <?=$z['google_insights_desktop']['speed']?>,
					min: 0,
					max: 100,
					title: "Summary Score",
					levelColors: ['#CE1B21', '#D0532A', '#FFC414', '#85A137']
				});
			</script>

			<!-- row inside row #2 BEGIN -->

			<div id="row">
				<div class="col-lg-12 col-md-12 col-sm-12">

					<?  $destop_opt = $z['google_insights_desktop']; ?>

					<? // Gzip check

					if ($destop_opt['gzip'] == 1)
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> Gzip compression is enabled';
					else
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Gzip compression is not enabled';
					?>

					<br>

					<? // MinifyCss check

					if ($destop_opt['MinifyCss'] == 1) echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> CSS code is minified <br>';
					elseif (is_array($destop_opt['MinifyCss'])) {

						echo '
							<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_minifycss">
								<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Consider minifying your CSS code
							</div>';

						echo '<ul id="ul_collapsed_minifycss" class="collapse ulstyled">';

						foreach ($destop_opt['MinifyCss'] as $value) {

							echo '<li>'.$value[0].' -> '.$value[1].' -> '.$value[2].'</li>';

						}

						echo '</ul>';

					} 
					else
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Consider minifying your CSS code';
					?>

					<? // MinifyHTML

					if ($destop_opt['MinifyHTML'] == 1)
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> HTML code is minified <br>';
					elseif (is_array($destop_opt['MinifyHTML'])) {

						echo '<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_minifyhtml">
								<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Consider minifying your HTML code
							</div>';

						echo '<ul id="ul_collapsed_minifyhtml" class="collapse ulstyled">';

						foreach ($destop_opt['MinifyHTML'] as $value) {

							echo '<li>'.$value[0].' -> '.$value[1].' -> '.$value[2].'</li>';

						}

						echo '</ul>';

					} 
					else
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Consider minifying your HTML code';
					?>

					<? // Minimize Render Blocking Resources

					if ($destop_opt['MinimizeRenderBlockingResources'] == 1)
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> There are no files that block page rendering <br>';
					elseif (is_array($destop_opt['MinimizeRenderBlockingResources'])) {

						echo '<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_mbr">
							<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> There are files that block page rendering
							</div>';

						echo '<ul id="ul_collapsed_mbr" class="collapse ulstyled">';

						foreach ($destop_opt['MinimizeRenderBlockingResources'] as $value) {

							echo '<li>'.$value.'</li>';

						}

						echo '</ul> ';

					} 
					else
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> There are some files that block  page rendering until all of these blocking files are loaded <br>';

					?>

					<? // LeverageBrowserCaching

					if ($destop_opt['LeverageBrowserCaching'] == 1) 
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> Browser caching is enabled and configured';
					elseif (is_array($destop_opt['LeverageBrowserCaching'])) {

						echo '<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_lbc">
								<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Leverage browser caching for the following urls:
							  </div>';

						echo '<ul id="ul_collapsed_lbc" class="collapse ulstyled">';

						foreach ($destop_opt['LeverageBrowserCaching'] as $value) {

							echo '<li>'.$value[0].' -> '.(isset($value[1]) ? $value[1] : 'expiration not set').'</li>';
						}

						echo '</ul>';

					} 
					else
						echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> LeverageBrowserCaching is not minified';

					?>
				</div>
			</div>
			<!-- row inside row #2 END -->

		</div>

	</div>

	<? if (isset($z['google_insights_mobile'])): ?>

	<!--  ------- mobile tab ------- -->

	<div id="mobile" class="tab-pane fade in active">

		<? if ($z['nsfw_score']<0.1): // if NSFW rate is low (not adult image) ?>

		<?

		if (
			$z['google_insights_mobile']['SizeTapTargetsAppropriately'] == 1
			and $z['google_insights_mobile']['SizeContentToViewport'] == 1
			and $z['google_insights_mobile']['OptimizeImages'] == 1
			)
		
		$z['google_insights_mobile']['usability'] = $z['google_insights_mobile']['speed'] = 100;

		?>
			<div class="col-lg-6 col-md-6 col-sm-6">

				<div class="cell_imagescontainer">

					<img class="cellphonebgimg" src="<?=HTML_RESOURCES_FOLDER?>/img/mobile_dummy.png">

					<img alt="Mobile screenshot of <?=ucfirst($z['name'])?>" class="cellphonefrontimg" src="http://images.netho.me/screenshots<?=$z['screenshot_mobile']?>">

				</div> 

			</div>

			<!-- ------ IMPORTANT. Following col-lg-6  is changed to col-lg-12 when nsfw score is high ------ -->

			<div class="col-lg-6 col-md-6 col-sm-6">

		<? else: // image is adult and will be hidden, so we should change the grid from col-..-6 to col-..-12: [1]

			echo '<div class="col-lg-12 col-md-12 col-sm-12">';
		?>

		<? endif; ?>

			<? $mob_data = $z['google_insights_mobile']; ?>

			<div>
				<center>
					<div id="gaugespeedscore" style="width:180px; height:100px;display: inline-block;"></div>
					<div id="usabilityscore" style="width:180px; height:100px;display: inline-block;"></div>
				</center>
			</div>

			<script>
				var gaugespeedscore = new JustGage({
					id: "gaugespeedscore",
					value: <?=$mob_data['speed']?>,
					min: 0,
					max: 100,
					title: "Speed Score",
					levelColors: ['#CE1B21', '#D0532A', '#FFC414', '#85A137']
				});

				var usabilityscore = new JustGage({
					id: "usabilityscore",
					value: <?=$mob_data['usability']?>,
					min: 0,
					max: 100,
					title: "Usability Score",
					levelColors: ['#CE1B21', '#D0532A', '#FFC414', '#85A137']
				});
			</script>

			<div class="alert alert-success suggestionpannel" role="alert" style="text-align:left;font-size:12px;">
				<span class="glyphicon glyphicon-info-sign insidepannel" aria-hidden="true"></span>
				Speed and usability scores by Google PageSpeed Insights.
				<a id="learnmorescores" onclick="javascript:learn_more_toggle('#learnmorescores')">Show More</a>
				<p class="greenbackground" id="learnmorescoresp">
					&#8226; Speed Score<br>
					<?=$this->tagReplacer(PAGE_INSIGHTS_SPEED_SCORE,$z)?>
					<br><br>
					&#8226; Usability Score<br>
					<?=$this->tagReplacer(PAGE_INSIGHTS_USABILITY_SCORE,$z)?>
					<br><br>
					&#8226; For more explanation and detailed report please visit https://developers.google.com/speed/pagespeed/insights/
				</p>
			</div>

			<? // Gzip 

			if ($destop_opt['gzip'] == 1) 
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> Gzip is enabled';
			else
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Gzip is not enabled';

			?>

					<br>

			<? // MinifyCss check

			if ($destop_opt['MinifyCss'] == 1)
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> CSS is minified <br>';
			elseif (is_array($destop_opt['MinifyCss'])) {

				echo '<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_minifycss_mob">		<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> CSS could be minified
					  </div>';

				echo '<ul class="collapse ulstyled" id="ul_collapsed_minifycss_mob">';

				foreach ($destop_opt['MinifyCss'] as $value) {

					echo '<li>'.$value[0].' -> '.$value[1].' -> '.$value[2].'</li>';
				}

				echo '</ul>';

			} 
			else
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> CSS is not minified <br>';
			?>

			<? // MinifyHTML

			if ($destop_opt['MinifyHTML'] == 1)
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> HTML is minified <br>';
			elseif (is_array($destop_opt['MinifyHTML'])) {

				echo '<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_minifyhtml_mob">
						<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> HTML could be minified
					  </div>';

				echo '<ul id="ul_collapsed_minifyhtml_mob" class="collapse ulstyled">';

				foreach ($destop_opt['MinifyHTML'] as $value) {

					echo '<li>'.$value[0].' -> '.$value[1].' -> '.$value[2].'</li>';
				}

				echo '</ul>';
			} 
			else
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> HTML is not minified <br>';
			?>

			<? // OptimizeImages

			if (is_array($mob_data['OptimizeImages'])) {	
			//echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Consider compressing these images: <br>';

				echo '<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_imagcopmress_mob">
						<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Consider compressing these images
					  </div>';

				echo '<ul id="ul_collapsed_imagcopmress_mob" class="collapse ulstyled">';

				foreach ($mob_data['OptimizeImages'] as $value) {
					echo '<li>'.$value[0].' could be reduced in size by '.$value[1].' ('.$value[2].') </li>';
				}

				echo '</ul>';
			} 
			else
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> All used images are compressed.<br>';
			
			?>

			<? // MinimizeRenderBlockingResources

			if ($destop_opt['MinimizeRenderBlockingResources'] == 1)
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> There are no files that block page rendering <br>';
			elseif (is_array($destop_opt['MinimizeRenderBlockingResources'])) {

				echo '<div class="collapsed_data_header" data-toggle="collapse" data-target="#ul_collapsed_mbr_mob"><img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> There are files that block page rendering</div>';

				echo '<ul id="ul_collapsed_mbr_mob" class="collapse ulstyled">';

				foreach ($destop_opt['MinimizeRenderBlockingResources'] as $value) {

					echo '<li>'.$value.'</li>';
				}

				echo '</ul> ';

			} 
			else
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> There are some files that block the page rendering until all of the blocking files are loaded <br>';
			?>

			<? // SizeTapTargetsAppropriately

			if ($mob_data['SizeTapTargetsAppropriately'] == 1)
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> All elements on the page are located comfortably for mobile usage.';
			else 
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Some elements on the page are too close to each other. This may cause confusion while browsing.';

			echo '<br>';

			if ($mob_data['SizeContentToViewport'] == 1)
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/> The size of all elements on the page fits the mobile viewport.';
			else 
				echo '<img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> Some elements on the page are bigger than the size of mobile viewport';

			?>


		</div>

	</div>

<? endif; // mobile tab  ?>  

</div>

</div>

<!-- ------ Page insights END ------ -->


<?
/*

[1] screenshot contains adult image and should be hidden, so are just do not displaying the div with image and resizing the neighboring div to occupy the whole space (including the screenshot div)

*/

?>