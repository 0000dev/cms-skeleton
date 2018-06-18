<? $this->loadView('header', $z); ?>


<? if (isset($z['links_list']) and count($z['links_list'])>0):?>
<div class="col-sm-2">
	<h3>List of articles</h3>

	<? 
	foreach ($z['links_list'] as $link) {
		echo '<a href="/'.$z['route_vars']['blog'].'/'.str_replace(' ', '-', $link).'">'.ucfirst($link).'</a><br/>';
	}
	?>

</div>
<? endif; ?>

<div class="col-sm-10">
<?	

      if (isset($z['blog_page']) and file_exists(BLOG_ARTICLES_FOLDER.'/'.$z['blog_page'].'.php')) {
        include_once (BLOG_ARTICLES_FOLDER.'/'.$z['blog_page'].'.php');
      }
      else {
        $file_to_render = glob(BLOG_ARTICLES_FOLDER."/*.php");
        
        if (isset($file_to_render[0]) and strlen($file_to_render[0])>0) 
        	include_once ($file_to_render[0]);
      }
?>
</div>

<? $this->loadView('footer', $z); ?>