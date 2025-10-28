<?php
$mashina = "naxia 2";
$mashina1 = "malibu 2";
$mashina3 = "eqinox";
$mashina4 = "taxo";
$mashinalar = [ "naxia 2", "malibu 2","gentra","eqinox","taxo" ];

   echo $mashinalar[2];
$i = 0;
while ($i <= 50){
    echo $i.", ";
    if($i == 20)
        break;
    $i+=2; 
}

$i =1;
while ($i < 6) :
    echo $i;
    $i++;
 endwhile;
?>