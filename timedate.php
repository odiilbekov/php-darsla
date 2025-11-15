<?php
date_default_timezone_set("asia/tashkent");
echo date("y.m.d")."<br>";
echo date("y.m.d H:i:s")."<br>";
echo date("D F Y")."<br>";
echo date('d.m.y',  strtotime( "2025-11-11"));
// 15.11.2025
echo strtotime("+7 days"). "<br>";
echo date("d.m.Y H:i", strtotime("-7days")). "<br>";
echo date("d.m.Y H:i", strtotime("last monday")). "<br>";
echo date("d.m.Y H:i", strtotime("next year")). "<br>";
echo date("d.m.Y H:i", strtotime("2024-11-14")). "<br>";
$t_yil = "2011-06-15";
$yosh = (time () - strtotime($t_yil)) / (60*60*24*365);
echo (int) $yosh;
?>