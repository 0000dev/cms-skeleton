<!DOCTYPE html>
<html>
<head>
<meta name="robots" content="noindex, nofollow">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<title><?=$z['page_title']?></title>

<style type="text/css">
#layoutContainer 
{
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    position: fixed;
}

#topFix{
    width: 100%;
    height: 50px;
    border-bottom: 5px solid #eaeaea;
    overflow: hidden;
}

#topFix2{
    position: absolute;
    top: 0px;
    left: 0px;
    overflow: hidden;
    display: none;
}

#iframeHeader
{
    width: 100%;
    height: 100%;
    border: 0;
}

.insidediv{
    display: inline-block;
    padding: 15px 15px 15px 15px;
    color: #2f363e;
}

.backurl{
    text-decoration: none;
    color: #2f363e;
    padding: 5px;
    background: #eaeaea;
    border-radius: 4px;
}
.logo_box {
    display: block;
    margin-top: 2px;
   
}
.logo{
  display: inline-block;

}
.logo_name{
  display: inline-block;

} 

.logo_name a{
    text-decoration: none;
    color: #2f363e;
}

.showbutton{
    text-decoration: none;
    color: #2f363e;
    padding: 5px;
    margin: 5px;
    background: #eaeaea;
    border-radius: 4px;
    cursor:pointer;
    
}
</style>
</head>
<body>

<div id="layoutContainer">

<div id="topFix2">
<div class="insidediv showbutton" onclick="removediv('#topFix2','#topFix')">
 >>
</div>
</div>

    <div id="topFix"> 

        <div class="insidediv">
             <?=ucfirst($z['name'])?>
        </div>



        <? if (isset($z['alexa_rank'])): ?>
            <div class="insidediv">
            <img src="<?=HTML_RESOURCES_FOLDER?>/img/alexa.gif"/> Alexa Rank: <?=$z['alexa_rank']?>
            </div>
        <? endif; ?>


        <? if (isset($z['ip'])): ?>
            <div class="insidediv">
            <img src="<?=HTML_RESOURCES_FOLDER?>/img/globe-sm.jpg"/> IP: <?=$z['ip']?>
            </div>
        <? endif; ?>

         
        <div class="insidediv">
            <a class="backurl" href="/<?=str_ireplace(array('http',':','/'), '', $z['url'])?>"> <img src="<?=HTML_RESOURCES_FOLDER?>/img/back_arrow_small_icon.png" /> Обратно на страницу <?=$z['name']?> </a>
        </div>


        <div class="insidediv" onclick="removediv('#topFix','#topFix2')" style="cursor:pointer">
             <img src="<?=HTML_RESOURCES_FOLDER?>/img/close-icon.png"/> Закрыть эту панель 
        </div>


    </div>


    <iframe id="iframeHeader" src="<?=$z['url']?>" frameborder="0" hspace="0" vspace="0" marginheight="0" marginwidth="0"></iframe>
</div>

<script type="text/javascript">
    
function removediv(id1,id2){

    $(id1).animate({width:'toggle'},350);
    $(id2).show();
    

}



</script>

</body>
</html>