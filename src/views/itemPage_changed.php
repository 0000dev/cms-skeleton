<? $this->loadView('header', $z); ?>
<div class="pd-search">
    <div class="container">
       <input id="headerSearchForm" type="text" placeholder="Enter any website and hit enter" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
       <img src="<?=HTML_RESOURCES_FOLDER?>/img/search.png"/>
    </div>
</div>

<? 

$img_string = '<img src="'.HTML_RESOURCES_FOLDER.'/img/at.png"/>';

/* Content blocks:

	zBasicInfo
	zWhois
	zLoadSpeed
	zPageInsights
	zChartsTrafficAndCountries
	zMainPageContent
	zavailableDomains
	zServerLocation
	zSitesOnThisIP
	zAdditionalTools
	zSimilarDomains


*/
	?>

		<!-- AD:
		<div class="row">
			<div class="col-sm-12">
				<center>
					<img src="https://dummyimage.com/728x90/ddd/fff.jpg&text=responsive+ad+space" />
				</center>
			</div>
		</div>
		-->
        <div class="container pad-40">
            <div class="row">
                <div class="eight columns">
                    <h1><?=ucfirst($z['name'])?></h1>
                    <p><b>Title:</b> <?=$z['title']?></p>
                    <p><b>IP:</b> <?=$z['ip']?></p>
                    <p><b>Last update:</b> <?=$z['last_updated']?> 
                    <? if ($z['last_updated_days_back']>7): ?>
                    <a href="<?=APP_FOLDER.'/'.$z['name'].'/'.$z['route_vars']['update_page']?>" style="font-size: 13px;font-weight: bold;">Update Now</a>
                    <?endif;?>
                    </p>
                    <?if (isset($z['register_date'])):?>
                    <p><b>Registration date: </b> <?=$z['register_date']?></p>
                    <?endif;?>

                    <?if (isset($z['expire_date'])):?>
                    <p><b>Expiration date: </b> <?=$z['expire_date']?></p>
                    <?endif;?>
                    <!--<a rel="nofollow" class="button button-primary" href="<?=$z['name']?>/go">Visit <?=ucfirst($z['name'])?></a>-->
                    
                </div>
                <div class="four columns">
                    <? if (isset($z['screenshot_desktop']) and $z['nsfw_score']<0.1): ?>
                    <div class="pd-web-secshot">
                        <img alt="Screenshot of <?=ucfirst($z['name'])?> main page" src="http://images.ppdd.me/screenshots<?=$z['screenshot_desktop']?>">
                    </div> 
                    <? else: ?>
                    <div class="pd-web-secshot">
                        <p><b><?=ucfirst(preg_replace('#\..+?#', '', $z['name']))?></b><br>Screenshot Coming Soon</p>
                    </div> 
                    <? endif; ?>
                </div>
                <?php /*
                <div class="three columns">
                    <div class="pd-r-links">
                        <a href="<?=APP_FOLDER.'/'.$z['name'].'/'.$z['route_vars']['whois_raw']?>">
                            <span>Whois data information for <?=$z['name']?></span><br>
                            <img src="<?=HTML_RESOURCES_FOLDER?>/img/r-arrow.png"/>
                        </a>
                    </div>
                    <div class="pd-r-links">
                        <a href="<?=APP_FOLDER.'/'.$z['name'].'/'.$z['route_vars']['tld_alternatives']?>">
                            <span>Cheapest alternatives for <?=$z['name']?></span><br>
                            <img src="<?=HTML_RESOURCES_FOLDER?>/img/r-arrow.png"/>
                        </a>
                    </div>
                </div> 
                 */ ?>
            </div>
        </div> 
        
<div class="pd-gray">
    <div class="container pad-40">
        <div class="row">
        <?php if ($z['whois_detailed']) { ?>
            <div class="six columns">
                <h3>Registration Information</h3>
                <p>
                    <b><?=$z['name']?></b> is registered by <span><?php echo($z['whois_detailed']['registrant_name'])?></span> on <span><?php echo($z['whois_detailed']['create_date'])?></span> and it will expire on <span><?php echo($z['whois_detailed']['expiry_date'])?></span>. The hosting server location of <span><?=$z['name']?></span> is <span><?php echo($z['whois_detailed']['registrant_city'])?></span>, <span><?php echo($z['whois_detailed']['registrant_country'])?></span>.
                </p>
            </div>
        <?php } ?>
            <div class="six columns">
                <h3>Contact Information</h3>
                <p>
                    Willing to contact <span><?php echo($z['whois_detailed']['registrant_name'])?></span>? You can use email <span><?php echo(str_replace("@", $img_string, $z['whois_detailed']['registrant_email'])) ?></span> or you can call on <span><?php echo($z['whois_detailed']['registrant_phone'])?></span>.
                </p>
            </div> 
        </div> 
    </div> 
</div> 
<div class="container pad-40">
    <div class="row">
        <div class="six columns">
            <h3>About Domain [<?=$z['name']?>]</h3>
            <?php
//$me = $z['name'];
//$scripts = array('Greek', 'Cyrillic', 'Hebrew', 'Arabic', 'Hangul');
//foreach ($scripts as $script) {
//    echo "$me is " . str_transliterate($me, 'Latin', $script) . " in $script.\n";
//}
//echo "$me is " . transliterator_transliterate ("Latin-$script", $me) . " in $script.\n";
                $vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
                $numbs = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
                $consonants = Array('b','c','d','f','g','h','j','k','l','m'
                ,'n','p','q','r','s','t','v','w','x','y','z'
                ,'B','C','D','F','G','H','J','K','L','M'
                ,'N','P','Q','R','S','T','V','W','X','Y','Z');
                $consonants2C = str_replace($consonants, "C", $z['name']);
                $vovals2v = str_replace($vowels, "V", $consonants2C);
                $numbs2N = str_replace($numbs, "N", $vovals2v);
            ?>
            <table>
                <tr>
                    <td><b>Domain Name Length:</b></td><td><?php echo(strlen($z['name'])) ?></td>
                </tr>
                <tr>
                    <td><b>Hyphens:</b></td><td><?php echo(substr_count($z['name'], '-')) ?></td>
                </tr>
                <tr>
                    <td><b>Domain without Vowels:</b></td><td><?php echo(str_replace($vowels, "", $z['name'])) ?></td>
                </tr>
                <tr>
                    <td><b>Domain without Consonants:</b></td><td><?php echo(str_replace($consonants, "", $z['name'])) ?></td>
                </tr>
                <tr>
                    <td><b>Domain name pattern:</b><br><b>V:</b> Vowel, <b>C:</b> Consonant, <b>N:</b> Number</td><td><?php echo($numbs2N) ?></td>
                </tr>
            </table>
        </div> 
        <div class="six columns">
                <h3><?=$z['name']?> Founded By Keywords</h3>
                <p>
                    <?
                        if (!strstr($z['name'], 'www'))
                                echo 'www.'.$z['name'];
                        else 
                                echo str_replace('www.', '', $z['name']);

                        echo '<br>';

                        echo preg_replace('#\..+#', '', $z['name']);

                        ?>
                </p>
                Below are few frequent alternatives of <?=$z['name']?><br>
                <ul class="pd-typo">
                    	<?php $misspells = $this->getTypos($z['name']); ?>



                    	<?php 

                        $misspells = @array_slice($misspells, 0, 4);

                    	foreach ($misspells as $key => $value) {
                    		echo '<li> <span>-</span> '.$value.'</li> ';
                    	}


                    	?>
                    	</ul>
        </div> 
    </div> 
</div> 
        

<? if ($z['show_full_version'] == false): ?>
		
		<!-- <div class="row">
			<div class="col-sm-12">
				<center><a href="<?=APP_FOLDER.'/'.$z['name'].'/'.$z['route_vars']['full_review']?>" class="btn btn-success">
				<h4>Load detailed review</h4></a></center>
			</div>
		</div>

		<hr>
 -->
<? endif; ?>


        
        <!--zLoadSpeed-->
        <?php if (isset($z['load_time'])){ ?>
            <? require_once VIEWS_PATH.'/content_blocks/loadSpeed.php'; ?>
        <?php } ?>
        
        
<!--zWhois-->
    <div class="container pad-40">
        <h3>Whois Information</h3>
        <ul class="pd-ul-table">
            <?php  foreach($z['whois_detailed'] as $keyz => $valuez) {
                if($valuez!=''){
                    if($keyz=='registrant_city'){ 
                ?>
                <li>
                    <span>
                        <b><?php echo(str_replace("_"," ",$keyz)) ?></b><br>
                        <?php echo($valuez) ?>
                    </span>
                    <div id="registrar-map" style="margin-right: 10px;"></div>
			<script>
                            $(function(){
                                $('#registrar-map').height(250).vectorMap({
                                map: 'world_mill',
                                zoomButtons : false,
                                zoom: false,
                                zoomOnScroll: false,
                                scaleColors: ['#C8EEFF', '#0071A4'],
                                normalizeFunction: 'polynomial',
                                hoverOpacity: 0.7,
                                hoverColor: false,
                                markerStyle: {
                                  initial: {
                                    fill: '#e8ee51',
                                    stroke: '#383f47'
                                  }
                                },
                                backgroundColor: '#ff7743',
                                labels: {
                                    markers:  {
                                            render: function(index){
                                        return '<?php echo($valuez) ?>';
                                      },
                                    }
                                },
                                markers: [
                                  {latLng: [<?=$z['latitude']?>, <?=$z['longitude']?>], name: '<?php echo($valuez) ?>'},
                                ]
                              });

                              map = $('#world-map-markers').vectorMap('get', 'mapObject');

                              map.setFocus({
                                    lat: <?=$z['latitude']?>,
                                    lng: <?=$z['longitude']?>,
                                    scale: 4
                              })
                            });
			</script>
                </li>
            <?php }else{ ?>
                
                <li>
                    <span>
                        <b><?php echo(str_replace("_"," ",$keyz)) ?></b><br>
                        <?php echo(str_replace("@", $img_string, $valuez)) ?>
                    </span>
                </li>
            <?php }  } } ?>
        </ul>
    </div>

        
<div class="pd-gray">
    <div class="container pad-40">
        <div class="row">
            <div class="four columns">
             <!--TOOLS > bing -->
                <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['bing'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>

                <div class="pd-tool-block">
                    <span>Useful tool</span>
                    <h4><?=$value['title']?></h4>
                    <div class="zero-toolwrapper">
                        <p><?=$value['descr']?></p>
                        <pre><?=$value['url']?></pre>
                     </div>
                </div>
                <? endforeach; ?>
            </div>
            <div class="four columns">
                 <!--TOOLS > alexa -->
                <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['alexa'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>
                <div class="pd-tool-block">
                    <span>Useful tool</span>
                    <h4><?=$value['title']?></h4>
                    <div class="zero-toolwrapper">
                        <p><?=$value['descr']?></p>
                        <pre><?=$value['url']?></pre>
                     </div>
                </div>
                <? endforeach; ?>
            </div>
            <div class="four columns">
                
                <!--TOOLS > pingdom -->
                <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['pingdom'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>


                <div class="pd-tool-block">
                    <span>Useful tool</span>
                    <h4><?=$value['title']?></h4>
                    <div class="zero-toolwrapper">
                        <p><?=$value['descr']?></p>
                        <pre><?=$value['url']?></pre>
                     </div>
                </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

        
	<?
	// --- zPageInsights

	if (isset($z['google_insights_desktop']))
		//  require_once VIEWS_PATH.'/content_blocks/pageInsights.php'; 

	?>

	<?
	// --- zChartsTrafficAndCountries

	if (isset($z['sweb_traffic_by_months']))
		require_once VIEWS_PATH.'/content_blocks/chartsTrafficAndCountries.php'; 

	?>


       
                

        <!--zMainPageContent-->
        <?php if (isset($z['title']) or isset($z['description']) or isset($z['h1']) or isset($z['h2']) or isset($z['h3'])){ ?>
            <? require_once VIEWS_PATH.'/content_blocks/mainPageContent.php'; ?>
        <?php } ?>


        <!--zSitesOnThisIP-->
        <?php if ($z['ip'] !== 'Not defined') { ?>
                <? require_once VIEWS_PATH.'/content_blocks/sitesOnThisIP.php'; ?>
        <?php } ?>



        
        
        
        <? require_once VIEWS_PATH.'/content_blocks/serverLocation.php'; ?>
        
        

<!--<div class="pd-gray">
    <div class="container pad-40">
        <div class="row">
            <div class="four columns">
        
        TOOLS > whois 
        <?
        $tools = array();
        $tools_ = unserialize(TOOLS); 
        $tools[] = $tools_['whois'];
        ?>
        <? foreach ($tools as $key => $value):
        $value = $this->toolsTagReplacer($value, $z);
        ?>
        <div class="pd-tool-block">
            <span>Useful tool</span>
            <br>
            <h4><?=$value['title']?></h4>
            <div class="zero-toolwrapper">
                <p><?=$value['descr']?></p>
                <pre><?=$value['url']?></pre>
            </div>
        </div>
        <? endforeach; ?>
 
            </div>
            
        <? 

        $tools = unserialize(TOOLS);

        unset($tools['whois']);
                unset($tools['pingdom'],$tools['analytics']);
                unset($tools['bing']);
                unset($tools['alexa']);
                unset($tools['analytics']);
                unset($tools['similarweb']);
                //unset($tools['majestic']);
                //unset($tools['google_index']);

        foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
        ?>

        <div class="four columns">
            <div class="pd-tool-block">
                <span>Useful tool</span>
                <br>
                <h4><?=$value['title']?></h4>
                <div class="zero-toolwrapper">
                    <p><?=$value['descr']?></p>
                    <pre><?=$value['url']?></pre>
                </div>
            </div>
        </div>

        <? endforeach; ?>

        </div>
    </div>
</div>-->
        
<div class="pd-gray">
    <div class="container pad-40">
        <div class="row">
            <div class="six columns">
                <? // --- zSimilarDomains ?>
                <h3>Similar Domains</h3>
                <div class="pd-links">
                            <?php
            if (isset($z['similarDomains']) and is_array($z['similarDomains']) and count($z['similarDomains'])>0)
            {
                    foreach ($z['similarDomains'] as $row) {

                            echo '<a href="'.APP_FOLDER.'/'.$row['name'].'"><h5>'.$row['name'].'</h5>';
//                            echo '<div>';
                            $ll = $row['title'].' '.$row['description'].' '.$row['h1'];
                            if (strlen($ll)<30)
                            {
                                $aa = array('whois_detailed','name','similarDomains','route_vars','sname','last_updated_days_back');
                                foreach ($row as $key => $value) {
                                    if (!in_array($key, $aa) and $value!=='' and $value != 0)
                                        echo '<b>'.str_replace("_"," ",$key).' :</b> '.$value.', ';
                                }
                            }
                            else echo preg_replace("/[^ \s-\.\w]+/", "", $ll);
                            echo '</a>';
                    }


            }
            ?>
                </div>
            </div>
            <div class="six columns">
                
                <!--TOOLS > ANALYTICS -->
                <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['analytics'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>


                <div class="pd-tool-block">
                    <span>Useful tool</span>
                    <br>
                    <h4><?=$value['title']?></h4>
                    <div class="zero-toolwrapper">
                        <p><?=$value['descr']?></p>
                        <pre><?=$value['url']?></pre>
                    </div>
                </div>
                <? endforeach; ?>
        
            </div>
    </div>
</div>
</div>

    <div class="container pad-40">
        <h3>Frequent Alternatives (Misspellings)</h3>
        <? require_once VIEWS_PATH.'/content_blocks/misspel.php'; ?>
    </div>
<? $this->loadView('footer', $z); ?>
