<?php
class Animal {
    public function eat () {
        echo "hayvon ovqat yemoqda<br>";
    }
}

class Cat extends Animal {
    public function meow() {
        echo "miyov <br>";
    }
}

$cat = new Cat();
$cat->eat();
$cat->meow();


class Car {
    public $model;
    protected $color;
    protected $probeg;

    public function drive() {
        return "Mashina harakatlanyapdi";
    }
}

class ElectricCar extends Car {
    public $power;

    public function probegnikriting($probeg) {
        $this->probeg = $probeg;
    }

    public function probegniolish() {
        return $this->probeg;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }
}

$byd = new ElectricCar();
$byd->setColor("oq");
$byd->probegnikriting(15000);

echo $byd->getColor();
echo "<br>";
echo $byd->probegniolish();
?>
