
    <ul class="misspellings">
   <?php $misspells = $this->getTypos($z['name']); ?>



   <?php 

   $misspells = @array_slice($misspells, 0, 50);

   foreach ($misspells as $key => $value) {
           echo '<li> <span>'.$key.'</span> '.$value.'</li> ';
   }


   ?>
   </ul>
            