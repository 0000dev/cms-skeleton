<? $this->loadView('header', $z); 

$img_string = '<img src="'.HTML_RESOURCES_FOLDER.'/img/at.png"/>';
?>
<div class="pd-search">
    <div class="container">
       <input id="headerSearchForm" type="text" placeholder="Enter any website and hit enter" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
       <img src="<?=HTML_RESOURCES_FOLDER?>/img/search.png"/>
    </div>
</div>
<div class="container pad-40">
    <div class="row">
        <div class="six columns">
            <h1><?=(strstr('www.', $z['name'])? $z['name'] : 'www.'.$z['name'])?> </h1>
            <a class="button button-primary" rel="nofollow" href="<?=$z['name']?>/go">Visit</a>
        </div>
        <div class="six columns">
            <p>
                <b><?= $z['name'] ?></b> is registered by <span><?php echo($z['whois_detailed']['registrant_name']) ?></span> on <span><?php echo($z['whois_detailed']['create_date']) ?></span> and it will expire on <span><?php echo($z['whois_detailed']['expiry_date']) ?></span>. The hosting server location of <span><?= $z['name'] ?></span> is <span><?php echo($z['whois_detailed']['registrant_city']) ?></span>, <span><?php echo($z['whois_detailed']['registrant_country']) ?></span>.<br><br>Willing to contact <span><?php echo($z['whois_detailed']['registrant_name']) ?></span>? You can use email <span><?php echo(str_replace("@", $img_string, $z['whois_detailed']['registrant_email'])) ?></span> or you can call on <span><?php echo($z['whois_detailed']['registrant_phone']) ?></span>.
            </p>
        </div>
    </div>
</div>

<!--zWhois-->
<div class="pd-gray">
    <div class="container pad-40">
        <h3>Whois Information</h3>
        <ul class="pd-ul-table">
            <?php  foreach($z['whois_detailed'] as $keyz => $valuez) {
                if($valuez!=''){
                    $img_string = '<img src="'.HTML_RESOURCES_FOLDER.'/img/at.png"/>';
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
</div>
        
    <? // --- zSimilarDomains ?>
                <?php
        if (isset($z['similarDomains']) and is_array($z['similarDomains']) and count($z['similarDomains'])>0)
        { ?>
        
        <div class="container pad-40">
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
        <?php
        }
        ?>
    <?php/*
<div class="pd-gray">
<div class="container pad-40">
    <? 
    // --- zWhois

    require_once './views/content_blocks/whois.php'; 
    ?>

</div>
</div>
    */ ?>
<div class="pd-gray">
    <div class="container pad-40">
        <?
        if (strlen($z['name'])>15)
                require_once './views/content_blocks/availableDomains.php'; 
        ?>
    </div>
</div>
        
<script type="text/javascript">

	$("#collapseOne").attr('class', 'collapse in');
	<? if (!isset($z['raw_whois'])): ?> whoisUnfold(); <? endif; ?>

	$("#collapse_available_domains").attr('class', 'collapse in');
	AvDomainsUnfold();

</script>

<? $this->loadView('footer', $z); ?>