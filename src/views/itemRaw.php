<? $this->loadView('header', $z); ?>

<div class="container gap-tb-50">
    <div class="border-block">
<h3 class="head-b"> Detailed Information for  <?=$z['name']?>? </h3>


    <ul class="accordion" data-accordion data-allow-all-closed="true">
        <li id="whosfond" class="accordion-item is-active" data-accordion-item>
          <a href="#" class="accordion-title" id="whois_click" onclick="whoisUnfold()"><?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_WHOIS)?></a>

          <div class="accordion-content" data-tab-content>
            <?if(isset($z['whois_last_updated_days_back']) and $z['whois_last_updated_days_back']>7):?>
             <a class="whoisUpdateLink" href="<?=APP_FOLDER.'/'.$z['name'].'/'.$z['route_vars']['update_page']?>">Update</a>
            <?endif;?>  
            <div id="whois_data">
                <center><img src="<?=HTML_RESOURCES_FOLDER?>/img/waiting_icon.gif"/><br>Loading...</center>
            </div>
          </div>
        </li>
    </ul>
<!--<div class="row">
		<div class="col-sm-12">

			<div class="panel panel-default cursor-pointer" data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="whois_click" onclick="whoisUnfold()">
				<div class="panel-body greybg">
					<?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_WHOIS)?> <img style="float: right" src="https://cdn4.iconfinder.com/data/icons/glyphs/24/icons_add-20.png"/>
				</div>
			</div>

			<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
				
				<?if(isset($z['whois_last_updated_days_back']) and $z['whois_last_updated_days_back']>7):?>
					<div>
						<a class="whoisUpdateLink" href="<?=APP_FOLDER.'/'.$z['name'].'/'.$z['route_vars']['update_page']?>">Update</a>
					</div>
				<?endif;?>

				<div id="whois_data">
				<?=isset($z['raw_whois']) ? '<pre>'.$z['raw_whois'].'</pre>' : '<center><img src="https://chillopedia.com/waiting_icon.gif"/> Loading...</center>'?>
				</div>
			</div>
		</div>
	</div>-->


<? if (isset($z['raw_whois']) === false): ?>
	<script type="text/javascript">
		
	var fired_whois = false;

	function whoisUnfold() {
	  	if (fired_whois === false) {
	    	$.ajax({
			    'type': 'GET',
			    'url': 'http://app.<?=$_SERVER['HTTP_HOST']?>/whoiser.php?d=<?=$z['name']?>&p=<?=$z['sname']?>',
			    'dataType': 'html',
			    'success': function (data) {
			        $( "#whois_data" ).html('<pre>'+data+'</pre>');
			    }
			});

	    	fired_whois = true;
		}
	  }

	</script>
<? endif; ?>

</div>   
</div>   

<? $this->loadView('footer', $z); ?>