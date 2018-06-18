	<div id="progress_wrapper">
		<div class="progress">
		  <div id="FPloadingBar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
		    <span class="sr-only">40% Complete (success)</span>
		  </div>
		</div>
	</div>

	<div id="after_progress">
		<br><br>
	</div>

	<script type="text/javascript">
		
		var elem = document.getElementById("FPloadingBar"); 
	    var width = 1;
	    var id = setInterval(frame, 1);
	    function frame() {

	        if (width >= 100) {
	            clearInterval(id);

	            setTimeout(function () {
					
					$('#after_progress').html('<center>Detailed review is ready. <a href="">Click here to see it</a></center> <br>');

				}, 800);


	        } else {
				width++; 
				setTimeout(function () {
					elem.style.width = width + '%';
					$('#FPloadingBar').html('Loading ' + width + '%');
				}, Math.floor(Math.random() * 2500));
	        }
	    }


	</script>