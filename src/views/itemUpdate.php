<? $this->loadView('header', $z); ?>

<script type="text/javascript" src="//code.jquery.com/jquery-1.7.1.js"></script>
<script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css">


<style type="text/css">
#div1{
  font-size: 24px;
}
.zero-contents {
    min-height: auto!important;
}
</style>

<script type='text/javascript'>//<![CDATA[
window.onload=function(){
function updateProgressbar($bar, value) {
    $bar.progressbar("value", value);
}

function step1() {
    setTimeout(function() {
     
    updateProgressbar($("#progressbar"), 12);
    step2();
  }, Math.random() * 1000 + 250);
}

function step2() {
    setTimeout(function() {
     
    updateProgressbar($("#progressbar"), 25);
    step3();
  }, Math.random() * 3000 + 250);
}

function step3() {
    setTimeout(function() {
   
    updateProgressbar($("#progressbar"), 32);
    step4();
  }, Math.random() * 4000 + 250);
}

function step4() {
    setTimeout(function() {
   
    updateProgressbar($("#progressbar"), 51);
    step5();
  }, Math.random() * 4500 + 250);
}

function step5() {
    setTimeout(function() {
 
    updateProgressbar($("#progressbar"), 74);
    step6();
  }, Math.random() * 4500 + 250);
}

function step6() {
    setTimeout(function() {
    updateProgressbar($("#progressbar"), 100);
    $("#div1").html('Готово! <a href="/<?=$z['name'].(isset($z['title']) && $z['name']!==$z['title'] ? '/'.URLify::filter(mb_substr(trim($z['title']),0,100)):'')?>">Посмотреть результат</a>');
    //$('#loadinggif').fadeOut();
  }, Math.random() * 4500 + 250);

}

$("#progressbar").progressbar();

console.log($("#progressbar").data('value'));

step1();

}//]]> 

$("#progressbar").progressbar();
step1();

</script>

<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
$(document).ready(function() {

    var items = ["скорость загрузки","контент главной страницы", "гео данные", "соседей по IP", "характеристики"],
        $text = $( '#div1 span' ),
        delay = 2; //seconds
    
    function loop ( delay ) {
        $.each( items, function ( i, elm ){
            $text.delay( delay*1E3).fadeOut();
            $text.queue(function(){
                $text.html( items[i] );
                $text.dequeue();
            });
            $text.fadeIn();
            $text.queue(function(){
                if ( i == items.length -1 ) {
                    //loop(delay);   
                }
                $text.dequeue();
            });
        });
    }

    loop( delay );

});
});//]]> 


</script>


<div class="container gap-tb-50">
    <div class="border-block">



 
 
       <center><h1> Обновляем <?= $z['name'] ?></h1></center>
        <br>
        

        <div id="div1">Обновляем <span>регистрационные данные</span></div> 
            <br>
        <div id="progressbar"></div>
        
         <br>

    


 

</div>
   
</div>
<script type="text/javascript">

var whois_udpated = false;
var geo_udpated = false;
var choose_text_present = false;

function updateMe() {
    
    var whois = document.getElementById("whoischeckbox").checked;
    var geoandtraf = document.getElementById("geoandtrafficbox").checked;
 
    if (whois == true) {

        if (whois_udpated == false) {

            $("#whois_status").append(' <div> Fire whois script </div>');
            whois_udpated = true;
        }
    }

    if (geoandtraf == true) {

        if (geo_udpated == false) {

            $("#geo_status").append(' <div> GEO and traf whois script </div>');
            geo_udpated = true;
        }
    }

    if (geo_udpated == true && whois_udpated == true)
    {

        $(".btn").addClass('disabled');
    }
}


</script>


<? $this->loadView('footer', $z); ?>