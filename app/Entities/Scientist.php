<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="scientist")
 */
class Scientist
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
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
    * @ORM\OneToMany(targetEntity="Theory", mappedBy="scientist", cascade={"persist"})
    * @var ArrayCollection|Theory[]
    */
    protected $theories;

    /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="groupScientists")
     * @var ArrayCollection|Group[]
     */
    protected $scientistGroups;

    public function __construct()
    {
        $this->theories = new ArrayCollection;
        $this->scientistGroups = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function addTheory(Theory $theory)
    {
        if (!$this->theories->contains($theory)) {
            $theory->setScientist($this);
            $this->theories->add($theory);
        }
    }

    public function getTheories()
    {
        return $this->theories;
    }

    public function getScientistGroups()
    {
        return $this->scientistGroups;
    }

    public function addScientistGroups(Group $group)
    {
        if ($this->scientistGroups->contains($group)) {
            return;
        }
        
        $this->scientistGroups[] = $group;
    }
}