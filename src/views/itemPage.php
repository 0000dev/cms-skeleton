<? $this->loadView('header', $z); ?>




<? 



$easyCommentsLoader = new EasyCommentLoader(
    ['db' => 
        ['db_host' => 'localhost', // EasyComment db host ip
        'db_name' => 'vseotzivy', // EasyComment db name
        'db_user' => 'root', // EasyComment username
        'db_pass' => '', // EasyComment user password
        'limit' => 3 // number of static comments to be loaded, 
        ]
    ]);


$img_string = '<img src="'.HTML_RESOURCES_FOLDER.'/img/at.png"/>';

/* Content blocks:

	zBasicInfo
	zWhois
	zLoadSpeed
	zPageInsights
	zChartsTrafficAndCountries
	zMainPageContent
	zavailableDomains
	zServerLocation
	zSitesOnThisIP
	zAdditionalTools
	zSimilarDomains


*/
 

            $z['title'] = $this -> cleanstr($z['title']);
            $z['description'] = $this -> cleanstr($z['description']);

            $cleaned_title = str_replace(array(';','!','?','@','"',"'",'—'), '', $z['description'] );

            //$str = explode( "\n", wordwrap($cleaned_title, 60));
            //$cleaned_title = $str[0];
            foreach (array('description','h1','h2','h3','title') as $key => $value) 
            {
                if (isset($z[$value])) 
                {   
                    if (isset($z[$value]) and mb_strlen($z[$value])>10)
                       $cleaned_title = $z[$value];
                        
                    $pos=@mb_strpos($z[$value], ' ', 70);

                    if ($pos!==false) 
                    {
                        $cleaned_title = $z[$value];
                        break;
                    }
                }
            }    

            if (mb_stristr($cleaned_title, $z['name']))
            {
                $cleaned_title = str_ireplace($z['name'], '', $cleaned_title);
                $cleaned_title  = str_replace(array(';','!','?','@','"',"'",'—'), '', $cleaned_title );
            }

            if (mb_strlen($cleaned_title) >= 90)
            {
                $pos=mb_strpos($cleaned_title, ' ', 90);
                $cleaned_title = mb_substr($cleaned_title,0,$pos ); 
            }

            $cleaned_title = preg_replace('#\,($|\s+$)#', '', $cleaned_title);
  
?>

        
<div class="container gap-tb-50">
    <div class="row">
        <div class="five columns">
            <div class="side-white min112">

            <? if (strlen($cleaned_title)>0): ?>
                <img scr="https://s2.googleusercontent.com/s2/favicons?domain_url=<?=$z['name']?>"> <?=$z['name']?>
                <h1><?=$this->mb_ucfirst(preg_replace('/^[^a-zа-яА-ЯA-Z]+/u', '', $cleaned_title), 'UTF-8')?> </h1>
            <? else: ?>
                <h1>Обзор сайта <?=$z['name']?></h1>
            <? endif; ?>
            </div>
            <div class="side-white min112">
                <p><span class="bb">Заглавие:</span> <?=$z['title']?></p>
                <p><span class="bb">IP:</span> <?=$z['ip']?></p>
                <?if (isset($z['register_date'])):?>
                <p><span class="bb">Дата регистрации: </span> <?=$z['register_date']?></p>
                <?endif;?>

                <?if (isset($z['expire_date'])):?>
                <p><span class="bb">Завершение регистрации: </span> <?=$z['expire_date']?></p>
                <?endif;?>

                <p class="nom"><span class="bb">Последнее обновление:</span> <?=$z['last_updated']?> 
                <? if ($z['last_updated_days_back']>7): ?>
                <a href="<?=APP_FOLDER.'/'.$z['name'].'/'.$z['route_vars']['update_page']?>" style="font-size: 13px;font-weight: bold;">Update Now</a>
                <?endif;?>
                </p>
            </div>
            <!--<a rel="nofollow" class="button button-primary" href="<?=$z['name']?>/go">Visit <?=ucfirst($z['name'])?></a>-->
            <? if (isset($z['screenshot_desktop']) and $z['nsfw_score']<0.1): ?>
            <div class="whoi-thumb">
                <img alt="Screenshot of <?=ucfirst($z['name'])?> main page" src="http://images.ppdd.me/screenshots<?=$z['screenshot_desktop']?>"> 
            </div> 
            <? else: ?>
            <div class="whoi-thumb">
               <!--  <p><span class="bb"><?=ucfirst(preg_replace('#\..+#', '', $z['name']))?></span><br>Скриншот скоро будет здесь</p> -->

             <img src="http://images.screenshots.com/<?=$z['name']?>/<?=str_replace('.', '-', $z['name'])?>-small.jpg">
            </div> 
            <? endif; ?>

            <?php if (count(array_filter($z['whois_detailed']))>0): ?>
            <div class="side-white">
                <h3 class="head-d clr-d">Контактная информация</h3>
                <p class="nom">
                    <span class="clr-p">Хотите связаться с <?php echo($z['whois_detailed']['registrant_name'])?>?</span><br> Вы можете отправить письмо на <span><?php echo(str_replace("@", $img_string, $z['whois_detailed']['registrant_email'])) ?></span> или позвонить по номеру <span><?php echo($z['whois_detailed']['registrant_phone'])?></span>.
                </p>
            </div>
            <? endif; ?>
            
            
        <!--zLoadSpeed-->
        <?php if (isset($z['load_time'])){ ?>
            <? require_once VIEWS_PATH.'/content_blocks/loadSpeed.php'; ?>
        <?php } ?>
            <div class="side-white">
                <h3 class="head-d clr-d">Детализация имени <?=$z['name']?></h3>
                <?php
                $vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
                $numbs = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
                $consonants = Array('b','c','d','f','g','h','j','k','l','m'
                ,'n','p','q','r','s','t','v','w','x','y','z'
                ,'B','C','D','F','G','H','J','K','L','M'
                ,'N','P','Q','R','S','T','V','W','X','Y','Z');
                $consonants2C = str_replace($consonants, "C", $z['name']);
                $vovals2v = str_replace($vowels, "V", $consonants2C);
                $numbs2N = str_replace($numbs, "N", $vovals2v);
                ?>
                <table style="width: 100%">
                    <tr>
                        <td><b>Длинна:</b></td><td><?php echo(strlen($z['name'])) ?></td>
                    </tr>
                    <tr>
                        <td><b>Дефисы:</b></td><td><?php echo(substr_count($z['name'], '-')) ?></td>
                    </tr>
                    <tr>
                        <td><b>Без гласных:</b></td><td><?php echo(str_replace($vowels, "", $z['name'])) ?></td>
                    </tr>
                    <tr>
                        <td><b>Без согласных:</b></td><td><?php echo(str_replace($consonants, "", $z['name'])) ?></td>
                    </tr>
                    <tr>
                        <td valign="top"><b>Шаблонность:</b></td><td><?php echo($numbs2N) ?><br><b>V:</b> Гласные<br><b>C:</b> Согласные<br><b>N:</b> Цифры</td>
                    </tr>
                </table>
            </div> 
            <div class="side-white">
                <h3 class="head-d clr-d"><?=ucfirst($z['name'])?> находится по таким ключевым фразам</h3>
                <p>
                    <?
                        if (!strstr($z['name'], 'www'))
                                echo 'www.'.$z['name'];
                        else 
                                echo str_replace('www.', '', $z['name']);

                        echo '<br>';

                        echo preg_replace('#\..+#', '', $z['name']);

                        ?>

                        <br>


                        <? //echo $z['alexa_keywords'];
                        if (isset($z['alexa_keywords']) and !preg_match('/[^а-яА-Яa-zA-ZЁё0-9_\{\}\"\:\.,\s-]/u', $z['alexa_keywords'], $ok))
                            $k = json_decode($z['alexa_keywords'], 1);

                        if (isset($k) and count($k)>0)
                        {   
                            $cc = 0;
                            foreach ($k as $key => $value) {
                                    
                                $key = mb_strtolower($key);

                                if ($cc<1)
                                    echo 'На сайте Вы найдете <a href="/'.$z['route_vars']['key_page'].'/'.str_replace(' ', '-', $key).'">'.$key.'</a>';
                                elseif ($cc<2)
                                    echo ', а также <a href="/'.$z['route_vars']['key_page'].'/'.str_replace(' ', '-', $key).'">'.$key.(strstr($key, '.') ? '' : '.').'</a>';
                                elseif ($cc<3)
                                    echo ' Еще на сайте есть <a href="/'.$z['route_vars']['key_page'].'/'.str_replace(' ', '-', $key).'">'.$key.'</a>';
                                else 
                                    echo ', <a href="/'.$z['route_vars']['key_page'].'/'.str_replace(' ', '-', $key).'">'.$key.'</a>';

                                $cc++;
                            }
                            
                            if ($cc > 2)
                                echo '.';
                        }
                        ?>
                </p>
            
                <ul class="pd-typo">
                    <?php $misspells = $this->getTypos($z['name']); ?>



                    <?php 

                    $misspells = @array_slice($misspells, 0, 4);

                    foreach ($misspells as $key => $value) {
                            echo '<li>'.$value.'</li> ';
                    }


                    ?>
                    </ul>
            </div>
            
            
            
            
        </div>
        <div class="seven columns pad-top-conts">

            <div class="border-block">
                <span class="head-d clr-d bdr-h"><h3>Отзывы про <?=$z['name']?></h3></span>
                <div class="row">
                    <div class="col-sm-12">
                    
                    <div class="panel panel-default"> 

                         <div id="easyComment_Content"></div>
                            <div id="easyComment_static_Content"><?php echo $easyCommentsLoader->connect()->loadComments($_SERVER['HTTP_HOST'].'-'.$z['name']); ?></div>


                            <!-- easyComment -->
                            <script type="text/javascript">

                                var easyComment_ContentID = '<?=$_SERVER['HTTP_HOST'].'-'.$z['name']?>';
                                var easyComment_Language = 'ru';

                                var easyComment_autoload_comemnts = 5;
                                var easyComment_load_comemnts_after_post = 1;
                                
                                var easyComment_Domain = 'http://vseotzivy.com/cmts/';
                                
                                var EC = document.createElement('script');
                                EC.type = 'text/javascript';
                                EC.src = easyComment_Domain + 'plugin/manual_embed.js';
                                
                                EC.onload = function(){
                                    easyComment_load_frame(easyComment_autoload_comemnts);
                                    function receiveMessage(event){
                                        if(event.data == 'easycomment_comment_added'){
                                            if(easyComment_load_comemnts_after_post == 1){
                                                easyComment_load_frame(1);
                                                document.getElementById('easyComment_static_Content').remove();
                                            }

                                        }
                                    }
                                    addEventListener("message", receiveMessage, false);
                                };

                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(EC);

                            </script>
                    </div>

                    </div>
                </div>
            </div>


             <!--zMainPageContent-->
                <?php if (isset($z['title']) or isset($z['description']) or isset($z['h1']) or isset($z['h2']) or isset($z['h3'])){ ?>
                    <? require_once VIEWS_PATH.'/content_blocks/mainPageContent.php'; ?>
                <?php } ?>

                    
                <!--TOOLS > pingdom -->
                <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['pingdom'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>

                <div class="useful-options">
                    <div class="row">
                        <div class="columns six pad25">
                            <span class="head-c clr-d"><?=$value['title']?></span>
                            <pre><?=$value['url']?></pre>
                        </div>
                        <div class="columns six pad25 ut-y">
                            <p class="clr-d"><?=$value['descr']?></p>
                        </div>
                    </div>
                </div>
                <? endforeach; ?>

                <!--zSitesOnThisIP-->
                <?php if ($z['ip'] !== 'Not defined') { ?>
                        <? require_once VIEWS_PATH.'/content_blocks/sitesOnThisIP.php'; ?>
                <?php } ?>

                   <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['bing'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>

                <div class="useful-options">
                    <div class="row">
                        <div class="columns six pad25">
                            <span class="head-c clr-d"><?=$value['title']?></span>
                            <pre><?=$value['url']?></pre>
                        </div>
                        <div class="columns six pad25 ut-y">
                            <p class="clr-d"><?=$value['descr']?></p>
                        </div>
                    </div>
                </div>
                <? endforeach; ?>


                <? require_once VIEWS_PATH.'/content_blocks/serverLocation.php'; ?>
        
        
                
                <!--TOOLS > ANALYTICS -->
                <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['analytics'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>


            <? // --- zAdditionalTools ?>
            <? if (isset($z['internalPages']) and count(array_filter($z['internalPages']))>0): ?>

            <div class="border-block">
                <span class="head-d clr-d bdr-h">Анализ страниц</span>
                <div class="row">
                <div class="col-sm-12">
                
                <div class="panel panel-default">   
                    
                    <div class="panel-body">
                    </div>
                
                    <? $iz = 0; ?>
                    <?foreach ($z['internalPages'] as $internal_page):?>

                        <? if ($internal_page['url'] == urlencode('/')) continue; ?>

                        <div class="small-12 medium-12 large-12">


                            <!-- Обзор страницы <b><?=urldecode($internal_page['url'])?></b> -->

                            <p class="highlightblue">
                                <?=strip_tags(urldecode($internal_page['url']))?>:
                            </p>

                            <table class="table">


                                <?php if (!isset($internal_page['description'])) $internal_page['description'] = 'Не определено'; ?>

                               <? foreach ($internal_page as $key => $value): ?>

                                    <? if (strlen($value)>0 and $key!=='url'): ?>
                                        <tr>
                                            <td><?=ucfirst($key)?></td>
                                            <td style="width: 100%"> 
                                                <p><?=($key=='url'? strip_tags(urldecode($value)) : strip_tags($value))?></p> 
                                            </td>
                                            <td><img src="<?=HTML_RESOURCES_FOLDER?>/img/ok.png"/></td>
                                        </tr>
                                    <? endif; ?>

                                <? endforeach; ?>

                            </table>

                        </div>
                    <? endforeach; ?>
                </div>
                </div>
                </div>
             </div>
            <? endif; ?>


            
        <!--zWhoisDetailed-->
            <?php if (count(array_filter($z['whois_detailed']))>0): ?>
            <div class="whois-detailed">
                <h3 class="head-d clr-w">Данные регистратора</h3>
                <p class="nom">
                    <span class="bb"><?=$z['name']?></span> зарегистрирован на <?php echo($z['whois_detailed']['registrant_name'])?> в <?php echo($z['whois_detailed']['create_date'])?> и срок регистрации завершится <?php echo($z['whois_detailed']['expiry_date'])?>. Сервер сайта <?=$z['name']?> находится в <?php echo($z['whois_detailed']['registrant_city'])?>, <?php echo($z['whois_detailed']['registrant_country'])?>.
                </p>
            </div>
             
            
            <div class="border-block">
                <span class="head-d clr-d bdr-h">Whois информация</span>
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
            <? endif; ?>
            
        
            
             <!--TOOLS > bing -->
             
        
                <?
                // --- zPageInsights

                if (isset($z['google_insights_desktop']))
                        //  require_once VIEWS_PATH.'/content_blocks/pageInsights.php'; 

                ?>

                <!--TOOLS > alexa -->
                <?
                $tools = array();
                $tools_ = unserialize(TOOLS); 
                $tools[] = $tools_['alexa'];
                ?>
                <? foreach ($tools as $key => $value):
                $value = $this->toolsTagReplacer($value, $z);
                ?>
                <div class="useful-options">
                    <div class="row">
                        <div class="columns six pad25">
                            <span class="head-c clr-d"><?=$value['title']?></span>
                            <pre><?=$value['url']?></pre>
                        </div>
                        <div class="columns six pad25 ut-y">
                            <p class="clr-d"><?=$value['descr']?></p>
                        </div>
                    </div>
                </div>
                <? endforeach; ?>
                
                <?
                // --- zChartsTrafficAndCountries

                if (isset($z['sweb_traffic_by_months']))
                        require_once VIEWS_PATH.'/content_blocks/chartsTrafficAndCountries.php'; 

                ?>


                <div class="useful-options">
                    <div class="row">
                        <div class="columns six pad25">
                            <span class="head-c clr-d"><?=$value['title']?></span>
                            <pre><?=$value['url']?></pre>
                        </div>
                        <div class="columns six pad25 ut-y">
                            <p class="clr-d"><?=$value['descr']?></p>
                        </div>
                    </div>
                </div>
                <? endforeach; ?>
        
                
            <div class="border-block simdo">
                <span class="head-d clr-d bdr-h ">Похожие по названию</span>
                <?php
                if (isset($z['similarDomains']) and is_array($z['similarDomains']) and count($z['similarDomains'])>0)
                {
                        foreach ($z['similarDomains'] as $row) {

                                echo '<a href="/'.$row['name'].(isset($row['title']) && $row['name']!==$row['title'] ? '/'.URLify::filter(mb_substr(trim($row['title']),0,100)).'.html':'').'"><span>'.$row['name'].'</span>';
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
                                else echo $this->cleanstr($ll);
                                echo '</a>';
                        }


                }
                ?>
            </div>


                
            <!-- 
            <div class="well-gray pad25">
                <span class="head-d clr-d bdr-h">Frequent Alternatives (Misspellings)</span>
                <? //require_once VIEWS_PATH.'/content_blocks/misspel.php'; ?>
                <div class="u-cf"></div>
            </div> -->
                
                
                
                <!--RIGHT END-->
        </div>
    </div>
</div>
        
<div class="well2" id="hometop">
    <input id="headerSearchForm" type="text" placeholder="Поиск по названию сайта" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
</div>


<? if (isset($_SERVER['HTTP_REFERER']) && preg_match('/google|yandex|mail.ru|bing|rambler|yahoo/i', $_SERVER['HTTP_REFERER'])): ?>
 

    <? if (rand(2,3)>1): ?>

    <link rel="stylesheet" type="text/css" href="<?=HTML_RESOURCES_FOLDER?>/css/notie.css">
    <script src="<?=HTML_RESOURCES_FOLDER?>/js/notie.js"></script>

    <script>

        $('#update_result').hide();

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        //notie.alert({ type: 1, text: 'Data on this page is old. Want to update? <a href="/anytechinfo.com/manupd>Ok</a> <img style="float:right" src="https://cdn3.iconfinder.com/data/icons/sympletts-free-sampler/128/circle-close-16.png"/>', stay: true, position: 'bottom' }); 

        $(document).ready(function(){    
          //$(".inline").colorbox({inline:true, width:"50%"});
            //console.log(document.referrer.indexOf('dom-update'));

            if (document.referrer.indexOf('<?=$route_vars['update_page']?>') < 0) {

                    var cooker = getCookie("<?=$z['name']?>.ppp");
                             <? //----------------------------- РЕРАЙТ ----------------------------- ?>
                    if (cooker == "") {
                        setTimeout(function() {
                            //document.getElementById("updatebutton").href="/anytechinfo.com/update-manual"; 
                            notie.alert({ type: 1, text: 'Данные по <?=$z['name']?> неактуальны. Выполнить обновление? <a style="color: #ffffff; border: 1px solid; padding: 5px; border-radius: 4px; background: #45a545;" href="<?=APP_FOLDER.'/'.$z['name']?>/<?=$route_vars['update_page']?>">Да</a> <img style="float:right" src="<?=HTML_RESOURCES_FOLDER?>/img/circle-close-16.png"/>', stay: true, position: 'bottom' }); 
                        }, 5200);
                        setCookie("<?=$z['name']?>.ppp", "ok", 3);
                    } 
                
            } else {
                $('#lastupdated').html('только что');
            }

        });
    </script>

    <? else: ?>

     <script src="<?=HTML_RESOURCES_FOLDER?>/js/jquery.colorbox-min.js"></script>
        <link rel="stylesheet" href="<?=HTML_RESOURCES_FOLDER?>/css/colorbox.css" />

    <script>

            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires="+d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }


            $(document).ready(function(){    
              $(".inline").colorbox({inline:true, width:"50%"});
                //console.log(document.referrer.indexOf('dom-update'));

                if (document.referrer.indexOf('<?=$route_vars['update_page']?>') < 0) {

                        var cooker = getCookie("<?=$z['name']?>.ppp");

                        if (cooker == "") {
                            setTimeout(function() {
                                document.getElementById("updatebutton").href="/<?=$z['name']?>/<?=$route_vars['update_page']?>"; 
                                document.getElementsByClassName('inline')[0].click();
                            }, 3200);
                            setCookie("<?=$z['name']?>.ppp1", "ok", 3);
                        } 
                    
                } else {
                    $('#lastupdated').html('только что');
                }


            });
        </script>

         <? //----------------------------- РЕРАЙТ ----------------------------- ?>

        <p><a style="display:none" class='inline' href="#inline_content">Inline HTML</a></p>

        <div style='display:none'>
            <div id='inline_content' style='padding:10px; background:#fff;'>
            <p><h4>Сведения о проекте <?=$z['name']?> неактуальны</h4></p>
            <p>Выполнить быстрое (до 10 секунд) обновление сведений о <?=$z['name']?>?</p>
           
            <a id="updatebutton" class="button" href="#">Получить новые данные</a></p>
            </div>
        </div>

    <? endif; ?>

<? endif; ?>
<? $this->loadView('footer', $z); ?>
