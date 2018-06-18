<?php
function ip2bin($ip) 
{ 
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false) 
        //return sprintf("%032s",base_convert(ip2long($ip),10,2)); 
        return base_convert(ip2long($ip),10,2); 
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) 
        return false; 
    if(($ip_n = inet_pton($ip)) === false) return false; 
    $bits = 15;  
    $ipbin = '';
    while ($bits >= 0) 
    { 
        $bin = sprintf("%08b",(ord($ip_n[$bits]))); 
        $ipbin = $bin.$ipbin; 
        $bits--; 
    } 
    return $ipbin; 
} 
 
function bin2ip($bin) 
{ 
   if(strlen($bin) <= 32)  
       return long2ip(base_convert($bin,2,10)); 
   if(strlen($bin) != 128) 
       return false; 
   $pad = 128 - strlen($bin); 
   for ($i = 1; $i <= $pad; $i++) 
   { 
       $bin = "0".$bin; 
   } 
   $bits = 0; 
   $ipv6 = '';
   while ($bits <= 7) 
   { 
       $bin_part = substr($bin,($bits*16),16); 
       $ipv6 .= dechex(bindec($bin_part)).":"; 
       $bits++; 
   } 
   return inet_ntop(inet_pton(substr($ipv6,0,-1))); 
}
 
function ip2hex($ip) 
{ 
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false) 
        return sprintf("%08x",ip2long($ip)); 
    if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) 
        return false; 
    if(($ip_n = inet_pton($ip)) === false) return false; 
    $bits = 15;  
    $ipbin = '';
    while ($bits >= 0) 
    { 
        $bin = sprintf("%02x",(ord($ip_n[$bits]))); 
        $ipbin = $bin.$ipbin; 
        $bits--; 
    } 
    return $ipbin; 
} 
 
function hex2ip($bin) 
{ 
   if(strlen($bin) <= 8)  
       return long2ip(base_convert($bin,16,10)); 
   if(strlen($bin) != 32) 
       return false; 
   $pad = 32 - strlen($bin); 
   for ($i = 1; $i <= $pad; $i++) 
   { 
       $bin = "0".$bin; 
   } 
   $bits = 0; 
   $ipv6 = '';
   while ($bits <= 7) 
   { 
       $bin_part = substr($bin,($bits*4),4); 
       $ipv6 .= $bin_part.":"; 
       $bits++; 
   } 
   return inet_ntop(inet_pton(substr($ipv6,0,-1))); 
}
?>
    <div class="border-block">
        <span class="head-d clr-d bdr-h"><?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_SERVER_LOCATION)?></span>
        <div class="row">
		<?php if (isset($z['latitude']) and isset($z['longitude'])): ?>
            
            <div class="twelve columns">

			<div id="world-map-markers"></div>
			<script>
                            $(function(){
                                $('#world-map-markers').height(450).vectorMap({
                                map: 'world_mill',
                                zoomButtons : false,
                                zoom: false,
                                zoomOnScroll: false,
                                scaleColors: ['#C8EEFF', '#0071A4'],
                                normalizeFunction: 'polynomial',
                                hoverOpacity: 0.7,
                                hoverColor: false,
                                markerStyle: {
                                  initial: {
                                    fill: '#e8ee51',
                                    stroke: '#383f47'
                                  }
                                },
                                backgroundColor: '#4d519c',
                                labels: {
                                    markers:  {
                                            render: function(index){
                                        return '<?=$z['city']?>, <?=$z['country_name']?>';
                                      },
                                    }
                                },
                                markers: [
                                  {latLng: [<?=$z['latitude']?>, <?=$z['longitude']?>], name: '<?=$z['country_name']?>'},
                                ]
                              });

                              map = $('#world-map-markers').vectorMap('get', 'mapObject');

                              map.setFocus({
                                    lat: <?=$z['latitude']?>,
                                    lng: <?=$z['longitude']?>,
                                    scale: 4
                              })
                            });
			</script>

		<?php else: ?>

	<?php endif; ?>
            </div>
            
            <div class="twelve columns">
                <table class="ctble" >
                    <tr>
                        <td><b>Страна:</b></td><td><?=(strlen($z['country_name'])>0 ? ''.$z['country_name'].'' : 'Not defined')?></td>
                    </tr>
                    <tr>
                        <td><b>Город: </b></td><td><?=(strlen($z['city'])>0 ? ''.$z['city'].'' : 'Not defined')?></td>
                    </tr>
                                <?php if (isset($z['latitude']) and isset($z['longitude'])): ?>
                    <tr>
                        <td><b>Широта: </b></td><td><?=$z['latitude']?></td>
                    </tr>
                    <tr>
                        <td><b>Долгота: </b></td><td><?=$z['longitude']?></td>
                    </tr>
                                <?php endif; ?>
                    <tr>
                        <td><b>IP: </b></td><td><?=$z['ip']?></td>
                    </tr>
                    <tr>
                        <td><b>IPV4 (Ip2long): </b></td><td><?php echo(ip2long($z['ip'])) ?></td>
                    </tr>
                    <tr>
                        <td><b>Бинарная кодировка IP: </b></td><td><p class="restrict-info" style="overflow: auto; max-width:300px; text-overflow: ellipsis;"><?php echo(ip2bin($z['ip'])) ?></p></td>
                    </tr>
                    <tr>
                        <td><b>Восьмеричная кодировка IP: </b></td><td><?php echo vsprintf("%o%o%o%o", sscanf($z['ip'], "%d.%d.%d.%d")); ?></td>
                    </tr>
                    <tr>
                        <td><b>Шестнадцатеричная кодировка IP: </b></td><td><?php echo(ip2hex($z['ip'])) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>