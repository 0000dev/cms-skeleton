
<footer>
    <div class="container gap-tb-50">
        <div class="row">
            <div class="eight columns al-c">
                <span class="head-c clr-s"><?=PROJECT_NAME?></span>
                <?=$this->tagReplacer(FOOTER_TEXT,$z)?>
                <p>All Rights Reserved.</p>
            </div>
            <div class="four columns pd-aright ar-c">
                <span class="head-c clr-s">Ссылки</span>
                <a class="clr-w" href="<?=APP_FOLDER?>/">Home</a>
                <a class="clr-w" href="<?=APP_FOLDER.'/'.$z['route_vars']['articles_page']?>/about">About</a>
                <a class="clr-w" href="<?=APP_FOLDER.'/'.$z['route_vars']['articles_page']?>/privacy-policy">Policy</a>
                <a class="clr-w" href="<?=APP_FOLDER.'/'.$z['route_vars']['articles_page']?>/contact">Contact</a>
            </div>
        </div>
    </div>
</footer>

<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<script src="<?=HTML_RESOURCES_FOLDER?>/js/vendor/what-input.js"></script>
<script src="<?=HTML_RESOURCES_FOLDER?>/js/vendor/foundation.js"></script>
<script src="<?=HTML_RESOURCES_FOLDER?>/js/app.js"></script>

<script src="<?=HTML_RESOURCES_FOLDER?>/js/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?=HTML_RESOURCES_FOLDER?>/js/jvectormap/jquery-jvectormap-world-mill.js"></script>

<script type="text/javascript">
    
function headerSearch(domain) {
    $("#result").html('<p><img src="<?=HTML_RESOURCES_FOLDER?>/img/loader.gif"/></p>');  

    $('#headerSearchForm').attr("placeholder", "Searching...").val("").focus().blur(); 


    var dataString = '';
    var url = "<?=APP_FOLDER?>/"+domain;
    $.ajax({
            type: "GET",
            url: url,
            data: dataString,
            cache: false,
		    complete: function(xhr, textStatus) {
		        dsf = xhr.status;
		        if (dsf==200) {
		        	$('#headerSearchForm').attr("value", "Found! Redirecting"); 
		        	$(location).attr('href', url);
		        } else {
		        	$('#headerSearchForm').attr("placeholder", "Nothing found"); 
		        }
		    }
    });	


}


function learn_more_toggle(divid){

	$(divid+"p").toggle("fast");

	var html = $(divid).html();

	if (html == "Show More")
	{
		$(divid).html("Show Less");
	} else{
		$(divid).html("Show More");
	}

}

</script>
</body>
</html>