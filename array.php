<?php
// brinchi usul
$sonlar = array(2,4,7655,65,656,6,9, "Test", "qiymat");
// ikkinchi usul
$sonlar1 = [5,3,658,5654,98,9,8, 'test',true];

echo $sonlar[4];
echo "/n";
echo $sonlar[4];
echo "/n";
echo $sonlar[4] = 70;
echo $sonlar[4];
print_r(value:$sonlar);
// mssivga yangi elemat qoshish oxiriga
array_push( $sonlar,  133, 45);
$sonlar[] = 499;
var_dump(value:$sonlar);
$car = array("brand"=>"gentra", "brend"=>"chevrolet", "year"=>2023);
echo $car["model"];
$car["model"] = 'malibu';
echo "/n";
echo $car['model'];



?>