<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="scientist_groups")
 */
class Group
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
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="Scientist", inversedBy="scientistGroups")
     */
    protected $groupScientists;

    public function __construct()
    {
        $this->groupScientists = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getGroupScientists()
    {
        return $this->groupScientists;
    }

    public function addScientistGroup(Scientist $scientist)
    {
        if ($this->groupScientists->contains($scientist)) {
            return;
        }
        
        $this->groupScientists[] = $scientist;
    }
}