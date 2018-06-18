<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags always come first -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<?=(isset($z['header_addon']) ? $z['header_addon'] : '' )?>
        
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
	<link rel="stylesheet" href="<?=HTML_RESOURCES_FOLDER?>/css/normalize.css">
        <link rel="stylesheet" href="<?=HTML_RESOURCES_FOLDER?>/css/skeleton.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Loading speed -->
        <script src="<?=HTML_RESOURCES_FOLDER?>/js/dx.all.js"></script>
	<!--<script src="<?=HTML_RESOURCES_FOLDER?>/js/justgage.js"></script>-->
        <script src="<?=HTML_RESOURCES_FOLDER?>/js/raphael-2.1.4.min.js"></script>

    <!-- Traffic charts -->
        <link rel="stylesheet" href="<?=HTML_RESOURCES_FOLDER?>/css/jquery-jvectormap-2.0.3.css" type="text/css" media="screen"/>
 	<link rel="stylesheet" href="<?=HTML_RESOURCES_FOLDER?>/css/flags.css">
   	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>

   	<!-- OpenLayers -->
   	<script src="<?=HTML_RESOURCES_FOLDER?>/js/OpenLayers.js"></script>

   	<title><?=$z['page_title']?></title>
    <meta name="description" content="<?=$z['page_descr']?>">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="four columns">
                    <h2><img src="<?=HTML_RESOURCES_FOLDER?>/img/logo.png"/><?=PROJECT_NAME?></h2>
                </div>
                <div class="eight columns right-align ar-c">
                    <a href="<?=APP_FOLDER?>/">Главная</a>
                    <!-- <a href="<?=APP_FOLDER.'/'.$z['route_vars']['articles_page']?>/about">About</a> -->
                    <a href="<?=APP_FOLDER.'/'.$z['route_vars']['articles_page']?>/tools">Инструменты</a>
    <!--                <a href="<?=APP_FOLDER.'/'.$z['route_vars']['articles_page']?>/privacy-policy">Policy</a>
                    <a href="<?=APP_FOLDER.'/'.$z['route_vars']['articles_page']?>/contact">Contact</a>-->
                </div>
            </div>
        </div>
    </header>
    
 

 