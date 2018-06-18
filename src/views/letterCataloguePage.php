<? $this->loadView('header', $z); ?>

<div class="well2" id="hometop">
    <input id="headerSearchForm" type="text" placeholder="Поиск по названию сайта" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
</div>
<div class="container gap-tb-50">
    <div class="row">
        <div class="eight columns">
            
            <div class="letter-conts">
                <div class="row">
                    <div class="seven columns">
                        <h1 class="head-c">Каталог сайтов с названием на букву <span class="ltrbx"><?=$z['letter']?></span></h1>
                    </div>
                    <div class="five columns ar-c">
                        <span class="bb">Page # <?=$z['page']?></span>
                    </div>
                 </div>
                <br>
                
                <? shuffle($z['list']); foreach ($z['list'] as $row): ?>

                <div class="letter-doms row">
                    <div class="seven columns">
                        <a class="head-c" href="<?='/'.$row['name'].(isset($row['title']) && $row['name']!==$row['title'] ? '/'.URLify::filter(mb_substr(trim($row['title']),0,100)).'.html':'')?>"><?=$row['name']?></a>
                        <?php if(isset($row['title'])) { ?><span><?=$this->cleanstr($row['title'])?></span><br><?php } ?>
                        <span class="clr-d"><?=str_replace('.',' \\ ',$row['ip'])?></span>
                        <a class="btn-s" href="<?='/'.$row['name'].(isset($row['title']) && $row['name']!==$row['title'] ? '/'.URLify::filter(mb_substr(trim($row['title']),0,100)).'.html':'')?>"><img src="<?=HTML_RESOURCES_FOLDER?>/img/r-arrow.png"/></a>
                    </div>
                    <div class="five columns">
                        <ul>
                            <?php if(isset($row['registered'])) { ?><li><span class="bb">Регистрация: </span><?=(isset($row['registered']) ? $row['registered'] : '')?></li><?php } ?>
                            <?php if(isset($row['last_updated'])) { ?><li><span class="bb">Обновлен в базе: </span><?=(isset($row['last_updated']) ? $row['last_updated'] : '')?></li><?php } ?>
                            <?php if(isset($row['load_time'])) { ?><li><span class="bb">Скорость загрузки: </span><?=(isset($row['load_time']) ? $row['load_time'] : '')?></li><?php } ?>
                            <?php if(isset($row['alexa_rank'])) { ?><li><span class="bb">Alexa: </span><?=(isset($row['alexa_rank']) ? $row['alexa_rank'] : '')?></li><?php } ?>
                        </ul>
                    </div>
                </div>


                <?



                ?>
                <? endforeach; ?>

                <!-- <div class="list-numbering">
                <?

                # paginator

                if ($z['page'] == 0)
                        $base_url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER["REQUEST_URI"]).'/'.$z['letter'].'/';
                else
                        $base_url = "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER["REQUEST_URI"]).'/';


                if ($z['page']<=10) {

                        for ($i=1; $i <= 10; $i++) 
                                echo ' <a href="'.$base_url.$i.'">'.($z['page'] == $i ? '<u>'.$i.'</u>' : $i).'</a> ';

                        echo ' <a href="'.$base_url.'11">'.'11'.'</a> ';
                }

                if ($z['page'] > 10) {

                        echo ' <a href="'.$base_url.'1">'.'1'.'</a>';

                        if ($z['page'] > 11) 
                                echo '... '; 
                        else 
                                echo ' ';

                        for ($i=$z['page']-9; $i <= $z['page']; $i++)
                                echo ' <a href="'.$base_url.$i.'">'.($z['page']==$i?'<u>'.$i.'</u>':$i).'</a> ';

                        for ($i=$z['page']+1; $i < $z['page']+6; $i++)
                                if ($i < $z['max_pages']) 
                                        echo ' <a href="'.$base_url.$i.'">'.$i.'</a> ';
                }

                if ($z['page'] < $z['max_pages'])
                        echo ' ... <a href="'.$base_url.$z['max_pages'].'">'.$z['max_pages'].'</a> ';

                ?>

                </div> -->
            </div>
        </div>
        <div class="four columns">
                <h3 class="head-c clr-d">Каталог</h3>
                <div class="app-letts">
                <?php
                $letters = array_merge(range('a', 'z'), range(0, 9));

                foreach ($letters as $letter) {

                   echo '<a class="clr-p" href="'.APP_FOLDER.'/'.$z['route_vars']['letter_page'].'/'.$letter.'/">'.$letter.'</a> ';
                }
            ?>
            </div>
        </div>
    </div>
</div>
<? $this->loadView('footer', $z); ?>