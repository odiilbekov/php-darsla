<?php 
$name = "<h2>sarvar</h2>";
echo $name. "<br>";
$newname = filter_var($name, FILTER_SANITIZE_STRING);
echo $newname. "<br>";

$email = "test@example.com";
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  echo("email is valid");
} else {
  echo("email is not valid");
} 
echo "<br>";
$son ="15";
if (!filter_var($son, FILTER_VALIDATE_INT) === false) {
  echo("butun son");
} else {
  echo("butun son emas");
} 
?>