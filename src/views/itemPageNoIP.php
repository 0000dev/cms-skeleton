<? $this->loadView('header', $z); 

$img_string = '<img src="'.HTML_RESOURCES_FOLDER.'/img/at.png"/>';
?>
<div class="container gap-tb-50">
    <div class="row">
        <div class="five columns">
            <h1 class="head-a"><?=(strstr('www.', $z['name'])? $z['name'] : 'www.'.$z['name'])?></h1>
            
            <div class="side-white">
                <h3 class="head-d clr-d">Contact Information</h3>
                <p class="nom">
                    <span class="clr-p">Willing to contact <?php echo($z['whois_detailed']['registrant_name'])?>?</span><br> You can use email <span><?php echo(str_replace("@", $img_string, $z['whois_detailed']['registrant_email'])) ?></span> or you can call on <span><?php echo($z['whois_detailed']['registrant_phone'])?></span>.
                </p>
            </div>
            <div class="whois-detailed">
                <h3 class="head-d clr-w">Registration Information</h3>
                <p class="nom">
                    <span class="bb"><?=$z['name']?></span> is registered by <?php echo($z['whois_detailed']['registrant_name'])?> on <?php echo($z['whois_detailed']['create_date'])?> and it will expire on <?php echo($z['whois_detailed']['expiry_date'])?>. The hosting server location of <?=$z['name']?> is <?php echo($z['whois_detailed']['registrant_city'])?>, <?php echo($z['whois_detailed']['registrant_country'])?>.
                </p>
            </div>
        </div>
        
        <div class="seven columns pad-top-conts">
            
<div class="border-block">
                <span class="head-d clr-d bdr-h">Whois Information</span>
                <div class="row">
                    <?php
                    $number = 0;
                    foreach($z['whois_detailed'] as $keyz => $valuez) {
                    if($valuez!=''){
                        if ($number % 2 == 0) {
                          echo('</div><div class="row wd-lst">');
                        }
                    ?>
                    <div class="six columns">
                        <span class="clr-p"><?php echo(str_replace("_"," ",$keyz)) ?></span>
                        <?php echo(str_replace("@", $img_string, $valuez)) ?>
                    </div>
                <?php $number++;  } }  ?>
                </div>
            </div>
    <? // --- zSimilarDomains ?>
                <?php
        if (isset($z['similarDomains']) and is_array($z['similarDomains']) and count($z['similarDomains'])>0)
        { ?>
        
                
            <div class="border-block simdo">
                <span class="head-d clr-d bdr-h ">Similar Domains</span>
        <?php
            if (isset($z['similarDomains']) and is_array($z['similarDomains']) and count($z['similarDomains'])>0)
            {
                    foreach ($z['similarDomains'] as $row) {

                            echo '<a href="'.APP_FOLDER.'/'.$row['name'].'"><span>'.$row['name'].'</span>';
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

</div>
</div>
</div>
<div class="well2" id="hometop">
    <input id="headerSearchForm" type="text" placeholder="Enter any website and hit enter" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
</div>
<? $this->loadView('footer', $z); ?>