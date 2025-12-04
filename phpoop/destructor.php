<?php
class Mevalar{
    private $nomi;
    private $yosh;
    public $rangi;

    public function __construct($nomi, $rangi){
        $this->nomi = $nomi;
        $this->rangi = $rangi; 
    }
    public function __destruct(){
        echo "destructor ishga tushdi";
    }
    public function nominikriting($nomi) {
        if($nomi)
            $this->nomi = $nomi;
    }
    public function nominiolish($nomi) {
         return $this->nomi ;
    }
    public function yoshnikriting($yosh) {
        if($yosh < 0){
            echo "Yoshi  qiymati noldan katta bolsin";
        } else {
            $this->yosh = $yosh;
        }
    }
     public function yoshniolish () {
        return $this->yosh;
     }
} 
$olma = new Mevalar( 'olma', "qizil");
$olma->yoshnikriting(15);
echo "<br>";
$olma->nominikriting("olcha");
echo $olma->nominiolish()."<br>";
echo $olma->yoshniolish()."<br>"





?>