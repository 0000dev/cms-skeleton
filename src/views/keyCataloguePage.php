<? $this->loadView('header', $z); ?>

<div class="well2" id="hometop">
    <input id="headerSearchForm" type="text" placeholder="Поиск по названию сайта" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
</div>
<div class="container gap-tb-50">
    <div class="row">
        <div class="twelve columns">
            
            <div class="letter-conts">
                <div class="row">
                    <div class="twelve columns">
                        <h1 class="head-c"><span class="ltrbx"><?=$z['key']?></span> <small>ведет на</small></h1>
                    </div>
                 </div>
                <br>

                <? 
                    $row = $z['list']['websites'][0];
                    $str = $row['title'];

                    if (strlen($str)<200)
                        $str.='. '.$row['description'];

                    unset($z['list']['websites'][0]);
                ?>
                <div class="letter-doms row">
                    <div class="seven columns">
                        <a class="head-c" href="<?='/'.$row['name'].(isset($row['title']) && $row['name']!==$row['title'] ? '/'.URLify::filter(mb_substr(trim($row['title']),0,100)).'.html':'')?>"><?=$row['name']?></a>
                        <span><?=$this->cleanstr($str)?></span><br>
                    </div>
                    <div class="five columns">
                        <ul>
                            <?php if(isset($row['registered'])) { ?><li><span class="bb">Регистрация: </span><?=(isset($row['registered']) ? $row['registered'] : '')?></li><?php } ?>
                            <?php if(isset($row['last_updated'])) { ?><li><span class="bb">Обновлен в базе: </span><?=(isset($row['last_updated']) ? $row['last_updated'] : '')?></li><?php } ?>
                            <?php if(isset($row['load_time'])) { ?><li><span class="bb">Скорость загрузки: </span><?=(isset($row['load_time']) ? $row['load_time'] : '')?></li><?php } ?>
                            <?php if(isset($row['alexa_rank'])) { ?><li><span class="bb">Alexa: </span><?=(isset($row['alexa_rank']) ? $row['alexa_rank'] : '')?></li><?php } ?>
                        </ul>

                        <? if (isset($row['alexa_keywords'])): ?>

                        <? $keys = json_decode($row['alexa_keywords']); ?>

                        <div class="defaultstyles">
                        <p><span class="bb">Ключевые слова:</span>

                        <?
                            $i = 0;
                            foreach ($keys as $key => $value) {
                                echo '<a href="/'.$route_vars['key_page'].'/'.str_replace(' ', '-', $key).'">'.$key.'</a> ';
                                $i++;
                                if ($i>=3)
                                    break;
                            }
                        ?>

                        </p>
                        </div>

                        <? endif; ?>

                    </div>
                </div>

                <? if (count($z['list']['websites'])>1): ?>
                    <hr>

                    <div class="row">
                        <div class="twelve columns">
                            <h2 class="head-c"><span class="ltrbx"><?=$z['key']?></span> <small>также ведет на</small></h2>
                        </div>
                     </div>
                    <br>


                    
                    <? foreach ($z['list']['websites'] as $row):

                        $str = $row['title'];
                        if (strlen($str)<200)
                        {
                            //if (!preg_match('#^(.|,|:|-|;)#', $row['description']))
                                $str =trim($str).'. '.$row['description']; 
                        }
                    ?>

                    <div class="letter-doms row">
                        <div class="seven columns">
                            <a class="head-c" href="<?='/'.$row['name'].(isset($row['title']) && $row['name']!==$row['title'] ? '/'.URLify::filter(mb_substr(trim($row['title']),0,100)).'.html':'')?>"><?=$row['name']?></a>
                            <span><?=$this->cleanstr($str)?></span><br>
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

                    <? endforeach; ?>

                <? endif;?>


                <? if (count($z['list']['keywords'])>0): ?>

                <div class="row">
                    <div class="twelve columns">
                        Подобные ключевые слова: <br>
                        <? foreach ($z['list']['keywords'] as $row):?>
                            <a href="/<?=$route_vars['key_page']?>/<?=str_replace(' ', '-', $row)?>"><?=$row?></a> 
                        <? endforeach; ?>
                    </div>
                </div>

                <? endif; ?>

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
    </div>
</div>
<? $this->loadView('footer', $z); ?>