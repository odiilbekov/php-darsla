<?php
class Mevalar {
    private $nomi;
    private $yosh;
    public $rangi;

    public function __construct($nomi, $rangi) {
        $this->nomi = $nomi;
        $this->rangi = $rangi;
        $this->yosh = 0;
    }

    public function setNomi($nomi) {
        if ($nomi) {
            $this->nomi = $nomi;
        }
    }

    public function getNomi() {
        return $this->nomi;
    }

    public function setYosh($yosh) {
        if ($yosh < 0) {
            echo "Yosh qiymati noldan katta bo‘lsin";
        } else {
            $this->yosh = $yosh;
        }
    }

    public function getYosh() {
        return $this->yosh;
    }
}

$olma = new Mevalar("olma", "qizil");
$olma->setYosh(15);
$olma->setNomi("olcha");

echo $olma->getNomi() . "<br>";
echo $olma->getYosh() . "<br>";
?>