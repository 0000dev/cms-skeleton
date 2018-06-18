 <? $this->loadView('header', $z); ?>

<center><img src="<?=HTML_RESOURCES_FOLDER?>/img/waiting_icon.gif"/> Loading...</center>

<script type="text/javascript">
	$(document).ready(function () {
	    // Handler for .ready() called.
	    window.setTimeout(function () {
	        location.href = "<?=$z['url']?>";
	    }, 4000);
	});
</script>

<? $this->loadView('footer', $z); ?>