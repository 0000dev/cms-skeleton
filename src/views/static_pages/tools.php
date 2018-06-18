
<div class="container gap-tb-50">
    <h3 class="head-b">Useful Tools</h3>
    <p>These tool will help you to find the right information about any website.</p>

    <div class="border-block">
        <div class="row pd-kit">
            <div class="four columns">
                <h3>CNAME Lookup</h3>
                <input class="tool-inp bu-f94847d2" id="contact" type="text" onkeydown="if (event.keyCode == 13) document.getElementById('submitit').click()">
                <p id="result">No data entered</p>
                <input class="prime-btn" id="submitit" onclick="myFunction(contact.value)" type="button" value="Submit">
            </div>

            <div class="four columns">
                <h3>IP Lookup</h3>
                <input class="tool-inp bu-f94847d2" id="contact_ip" type="text" onkeydown="if (event.keyCode == 13) document.getElementById('submitit_ip').click()">
                <p id="result_ip">No data entered</p>
                <input class="prime-btn" id="submitit_ip" onclick="myFunction_IP(contact_ip.value)" type="button" value="Submit">
            </div>

            <div class="four columns">
                <h3>NS Lookup</h3>
                <input class="tool-inp bu-f94847d2" id="contact_ns" type="text" onkeydown="if (event.keyCode == 13) document.getElementById('submitit_ns').click()">
                <p id="result_ns">No data entered</p>
                <input class="prime-btn" id="submitit_ns" onclick="myFunction_NS(contact_ns.value)" type="button" value="Submit">
            </div>
       </div>
    </div>
</div>
<script type="text/javascript">

function myFunction(domain) {
var dataString = '';
$("#result").html("<p><pre>Loading...</pre></p>");
$.ajax({
		type: "GET",
        url: "<?=LIBS_FOLDER?>/tools/cname.php?domain="+domain,
        data: dataString,
        cache: false,
        success: function(html) {
        $("#result").html("<p>"+html+"</p>");
    }
});
}

function myFunction_IP(domain) {
var dataString = '';
$("#result_ip").html("<p><pre>Loading...</pre></p>");
$.ajax({
		type: "GET",
        url: "<?=LIBS_FOLDER?>/tools/ip.php?domain="+domain,
        data: dataString,
        cache: false,
        success: function(html) {
        $("#result_ip").html("<p>"+html+"</p>");
    }
});
}

function myFunction_NS(domain) {
var dataString = '';
$("#result_ns").html("<p><pre>Loading...</pre></p>");
$.ajax({
		type: "GET",
        url: "<?=LIBS_FOLDER?>/tools/ns.php?domain="+domain,
        data: dataString,
        cache: false,
        success: function(html) {
        $("#result_ns").html("<p>"+html+"</p>");
    }
});
}


</script>

<div class="well2" id="hometop">
    <input id="headerSearchForm" type="text" placeholder="Enter any website and hit enter" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
</div>