
<div class="border-block">
    <span class="head-d clr-d bdr-h">Соседи по хостингу (по IP)</span>
    <? $more_str = str_replace('{IP}', ($z['ip'] == 'Not available' ? 'This' : $z['ip']), DOMAIN_PAGE_SAME_IP_WEBSITES_HEADER); ?>

            
    
			<?php

			$ip_info = false;

			if ($z['ip'] !== 'Not available')
			{ 	$rows = $z['neighboringWebsites'];

				if (count($rows)>1)
				{ ?>
<p><?=$more_str?></p>

			<?php	
					echo '<div class="well-fa pad25 of-x-s"><table style="margin:auto;width:100%">
					<tr>
						<th style="text-align:left">Website</th>
						<th style="text-align:center">SFW</th>
						<th style="text-align:center">Load Time</th>
						<th style="text-align:center">Alexa</th>
						<th style="text-align:center">Last Updated</th>
					</tr>';

					$ip_info = true;
					$danger_neighbour_count = 0;
					//$rows[] = array('name'=>'sex.com','title'=>'sex porn fuck'); // for test
					shuffle($rows);

					foreach ($rows as $domain_by_ip) {

						# checking for possible adult or gambling content	
						$danger_neighbour = false;

						if ($this->validateForAdsense($domain_by_ip) === false){

							$danger_neighbour = true;
							$danger_neighbour_count++;
						}

						if ($domain_by_ip['name'] !== $z['name']) 
							echo 
							'<tr>
								<td style="max-width:300px;overflow:hidden;line-height:2;">
									<a href="'.APP_FOLDER.'/'.$domain_by_ip['name'].'">'.ucfirst($domain_by_ip['name']).'</a>
								</td>
								<td>
									<center>'.($danger_neighbour == true ? ' <img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/>' : ' <img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/>').'
									</center>
								</td>
								<td style="text-align:center">
                                                                '.$domain_by_ip['load_time'].'
								</td>
								<td style="text-align:center">
                                                                '.$domain_by_ip['alexa_rank'].'
								</td>
								<td style="text-align:center">
                                                                '.$domain_by_ip['last_updated'].'
								</td>
							 </tr>';
					}
					echo '</table> </div>
					<br>';
				} else
					echo '<div class="grid-x grid-padding-x"><div class="small-7 medium-9 large-9 cell">'.($this->tagReplacer(NO_MORE_WEBSITES_ON_IP, $z)).'</div><div class="small-5 medium-3 large-3 cell"><img src="'.HTML_RESOURCES_FOLDER.'/img/1478644746_network-server.png"/></div></div>';

			} else
				echo '<center>Не был определен IP</center>';
			?>
            
		<? if ($ip_info): ?>
                
            <div class="u-cf">
			<?php if (isset($danger_neighbour_count) and $danger_neighbour_count>0): ?>

				<div class="alert alert-warning suggestionpannel" role="alert">

					<span class="glyphicon glyphicon-exclamation-sign insidepannelwarning" aria-hidden="true"></span> 
                                        <b><?=$this->tagReplacer(NSFW_WEBSITE_DETECTED_SHORT, $z)?></b><br><br>
					
					<p>
						<?=$this->tagReplacer(NSFW_WEBSITE_EXPLANATION, $z)?>
					</p>

				</div>

			<?php else: ?>

				<div class="alert alert-success suggestionpannel" role="alert">
					<span class="glyphicon glyphicon-info-sign insidepannel" aria-hidden="true"></span> 
                                        <b><?=$this->tagReplacer(NO_NSFW_WEBSITES_DETECTED_SHORT, $z)?></b><br>
					
					<p>
						<?=$this->tagReplacer(NSFW_WEBSITE_EXPLANATION, $z)?>
					</p>
				</div>

			<?php endif; ?>
            </div>
		<? endif; ?>	
        
</div>
