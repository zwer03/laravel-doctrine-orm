<?php
namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Dog extends Animal
{

    /** @ORM\Column(type="string") */
    private $kennel;

    public function getKennel()
    {
        return $this->kennel;
    }

    public function setKennel($kennel)
    {
        $this->kennel = $kennel;
    }
}