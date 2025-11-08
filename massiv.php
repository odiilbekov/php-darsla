<?php
$massiv = [];
$massiv[0] = "Ali";
$massiv[1] = "sarvar";
print_r($massiv);
$massiv1 = [];
$massiv1 ["ism"] = "Kamol";
$massiv1 ["familya"] = "rustamov";
$massiv1[0] = "test";
print_r($massiv1);
$sonlar = [5,4,5,82,834,343,24,23,34,];
print_r($sonlar);
$juft =[];
// forich
$users = ["ism" => "Ali", "Familya" => "Ozodov","year" => 1986];
foreach ($users as $key => $value) {
    echo $key. ": ". $value. ",";
}
foreach ($users as $value) {
    echo $value. ", ";
}
$users += ["manzil" => "xonqa", "yosh" => 24];
print_r($users);

array_splice($sonlar, 9, 2);
unset($sonlar[2]);
print_r($sonlar);

print_r( array_diff( $users,["Ozodov"]));

$sonlar = [5,4,5,82,834,343,24,23,34,];
sort( $sonlar);
print_r($sonlar);

rsort($sonlar);
print_r($sonlar);

$users = [
    ["ism" => "Ali",'familya' => "odilbekov","t_yili" => 2011],
    ["ism" => "zerib",'familya' => "otajonov","t_yili" => 2011],
];
print_r($users);
echo $users[0]['ism']. '/n';
echo $users[0]['familya']. "/n";
$sonlar = [
    [9404,493,434,[242,424,657,]],
    [7,5,6,7,8],
    [72,238,242,],
];
$print_r($users);



?>