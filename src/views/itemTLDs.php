<? $this->loadView('header', $z); ?>

<div class="container gap-tb-50">
    <div class="border-block">
<h3 class="head-b"> TLD Alternatives for <?=$z['name']?>? </h3>

    
<ul class="accordion" data-accordion data-allow-all-closed="true">
    <li id="avlfond" class="accordion-item is-active" data-accordion-item>
    <a href="#" class="accordion-title" id="available_domains_heading" onclick="AvDomainsUnfold()"><?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_AVAILABLE_DOMAINS)?></a>

    <div class="accordion-content" data-tab-content>
      <div id="available_domains">
          <center><img src="<?=HTML_RESOURCES_FOLDER?>/img/waiting_icon.gif"/><br>Loading...</center>
      </div>
    </div>
  </li>
</ul>

<!--<div class="row">
	<div class="col-sm-12">

		<div id="available_domains_heading" class="panel panel-default cursor-pointer" data-toggle="collapse" href="#collapse_available_domains" aria-expanded="true" aria-controls="collapse_available_domains" onclick="AvDomainsUnfold()">
			<div class="panel-body greybg">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> 
			<img style="float: right" src="https://cdn4.iconfinder.com/data/icons/glyphs/24/icons_add-20.png"/> </div>
		</div>

		<div id="collapse_available_domains" class="collapse" role="tabpanel">
			<div id="available_domains">
				<div class="loader"><center><img src="https://chillopedia.com/waiting_icon.gif"/> Loading...</center></div>
			</div>
		</div>

	</div>
</div>-->

<script type="text/javascript">

	var fired_available_domains = false;

	function AvDomainsUnfold () {
		if (fired_available_domains === false) {

			$.ajax({
				'type': 'GET',
				'url': '<?=LIBS_FOLDER?>/godaddy_api.php?d=<?=$z['name']?>&p=<?=$z['sname']?>',
				'dataType': 'html',
				'success': function (data) {
					$( "#available_domains" ).html(data);
				}
			});

			fired_available_domains = true;
		}
	}

</script>
</div>   
</div>   


<? $this->loadView('footer', $z); ?>