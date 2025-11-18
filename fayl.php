<?php 
if(file_exists( "test.txt")){
    $file = fopen( "test.txt", "r");
    $content = fread( $file, filesize( 'test.txt'));
    fclose($file);
    echo $content;
} else {
    echo "fayl mavjud emas!<br>";
}
// faylga yozish
$file = fopen('data.txt', "w");
fwrite($file, "An integer data type 
 be stored as float, because it exceeds the limit
  of an integer.
ase 2 - prefixed with ");
fclose($file);
$file = fopen('data.txt', "a");
 fwrite($file, "yangi malumot qoshish");
fclose($file);
// unlink( 'data.txt');
// fayl mavjutligni tekshirish
if(file_exists( "data.txt"));{
}
// faylni oqish
$content =file_get_contents( "data.txt");
echo $content;
file_put_contents('data.txt', "hello world");
file_put_contents('data.txt', "hello world", FILE_APPEND);
?>