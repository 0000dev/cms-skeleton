
<div class="side-white">
    <span class="head-d clr-d"><?= @str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_CONNECTION_SPEED) ?></span>
                <? if ($z['load_time']<2): ?>
                <p><?= str_replace(array('{SEC}', '{DOMAIN}'), array(round($z['load_time'], 2), $z['name']), DOMAIN_PAGE_SITE_SPEED_FAST) ?></p>

                <? elseif($z['load_time']<5): ?>
                <p><?= str_replace(array('{SEC}', '{DOMAIN}'), array(round($z['load_time'], 2), $z['name']), DOMAIN_PAGE_SITE_SPEED_NORM) ?></p>

                <? else: ?>
                <p><?= str_replace(array('{SEC}', '{DOMAIN}'), array(round($z['load_time'], 2), $z['name']), DOMAIN_PAGE_SITE_SPEED_SLOW) ?></p>

                <? endif; ?>
                <span class="clr-p"><?= $z['load_time'] ?> Seconds is Exact Time</h4>
            
                <div class="gauge-who">
                    <!--<div id="gauge"></div>-->
                    <div id="gaugea" class="gaugea" style="height: 190px;width: 190px;margin:  0 auto"></div>
                    <script>
                    $(function(){
                        $("#gaugea").dxCircularGauge({
                            scale: {
                                startValue: 0,
                                endValue: 6,
                                tickInterval: 1,
                                label: {
                                    useRangeColors: true
                                }
                            },
                            "geometry": {
                                "endAngle": 360,
                                "startAngle": 180
                            },
                            rangeContainer: {
                                palette: "pastel",
                                ranges: [
                                    {color: "#8587b7", startValue: 0, endValue: 2 },
                                    {color: "#676ba7", startValue: 2, endValue: 4 },
                                    {color: "#4d519c", startValue: 4, endValue: 6 }
                                ],
                                width: 15
                            },
                            "export": {
                                enabled: false
                            },
                            value: <?=$z['load_time']?>,
                            "valueIndicator": {
                                "type": "twoColorNeedle"
                            }
                        });
                    });
                    </script>
<!--                    <script>
                        var spscore = new JustGage({
                            id: "gauge",
                            value: <?= $z['load_time'] ?>,
                            min: 0,
                            max: 5,
                            title: "Loading Speed"
                        });
                    </script>-->
                    </div>
</div>