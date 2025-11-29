<?php 
$data =[
    "name" => "sarvar",
    "age" => 199,
    "city" => "XONQA"
];
$json = json_encode( $data);
echo $json. "<br>";

$json = '{"name":"sarvar","age":28}';
$array = json_decode($json, true);
print_r($array);
?>