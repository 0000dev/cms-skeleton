<? $this->loadView('header', $z); ?>
<div class="well" id="hometop">
    
    <input id="headerSearchForm" type="text" placeholder="Введите сайт и нажмите Enter" aria-describedby="basic-search_icn" onkeydown="if (event.keyCode == 13) headerSearch(this.value)">
</div>

<div class="container gap-tb-50">
    <div class="row">
        <div class="five columns">
            <ul class="side-info">
                  <li>
                    <img src="<?=HTML_RESOURCES_FOLDER?>/img/ser-a.png"/>
                    <p>
                        <span>Анализа сайта</span>
                        Полный анализ сайта, включая трафик и контент.
                    </p>
                </li>
                <li>
                    <img src="<?=HTML_RESOURCES_FOLDER?>/img/ser-c.png"/>
                    <p>
                        <span>Предоставление отчетов</span>
                       Визуализация отчетов в виде таблиц и диаграмм.
                    </p>
                </li>
                <li>
                    <img src="<?=HTML_RESOURCES_FOLDER?>/img/ser-b.png"/>
                    <p>
                        <span>Статистика посещений</span>
                        Детальные данные посещений.  
                    </p>
                </li>
            </ul>
        </div>
        <div class="seven columns app-info">
            <?= MAIN_PAGE_PART1 ?>
            <?= MAIN_PAGE_PART2 ?>
        </div>
    </div>
</div>
<div class="well-gray">
    <div class="container gap-tb-50">
        <div class="row">
            <div class="five columns">
                <h3 class="head-c clr-d">Каталог</h3>
                <div class="app-letts">
                    <?php
                    $letters = array_merge(range('a', 'z'), range(0, 9));

                    foreach ($letters as $letter) {

                       echo '<a class="clr-p" href="'.$z['route_vars']['letter_page'].'/'.$letter.'/">'.$letter.'</a>';
                    }
                ?>
                </div>
            </div>
            <div class="seven columns">
                <h3 class="head-c clr-d">Примеры отчетов</h3>
                <div class="app-links">
                <? for ($i=0; $i < 10; $i++): ?>
                <a href="<?=APP_FOLDER.'/'.$z['list'][$i]['name'].(isset($z['list'][$i]['title']) && $z['list'][$i]['name']!==$z['list'][$i]['title'] ? '/'.URLify::filter(mb_substr(trim($z['list'][$i]['title']),0,100)).'.html':'')?>" style="min-width: 45%;display: inline-block"><?=$z['list'][$i]['name']?></a>
                <? endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>
        
        
        
<? $this->loadView('footer', $z); ?>