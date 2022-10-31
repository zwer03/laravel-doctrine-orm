<?php

namespace App\Entities;

use App\ValueObject\Money;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
    * @ORM\ManyToOne(targetEntity="Scientist", inversedBy="projects")
    * @ORM\JoinColumn(name="scientist_id", referencedColumnName="id", onDelete="CASCADE")
    * @var Scientist
    */
    protected $scientist;

    /**
     * @ORM\Column(type="money", name="cost")
     *
     * @var Money
     */
    private $money;

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setScientist(Scientist $scientist)
    {
        $this->scientist = $scientist;
    }

    public function getScientist()
    {
        return $this->scientist;
    }

    /**
     * @param Money $money
     */
    public function setMoney(Money $money)
    {
        $this->money = $money;
    }

    /**
     * @return Money
     */
    public function getMoney()
    {
        return $this->money;
    }
}