<?php

namespace App\Entities;

use App\Embeddables\Address;
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
     * @ORM\Embedded(class="App\Embeddables\Address", columnPrefix=false)
     */
    protected $address;

    /**
    * @ORM\OneToMany(targetEntity="Theory", mappedBy="scientist", cascade={"persist"})
    * @var ArrayCollection|Theory[]
    */
    protected $theories;

    /**
    * @ORM\OneToMany(targetEntity="Project", mappedBy="scientist", cascade={"persist"})
    * @var ArrayCollection|Project[]
    */
    protected $projects;

    /**
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="groupScientists")
     * @var ArrayCollection|Group[]
     */
    protected $scientistGroups;

    public function __construct()
    {
        $this->theories = new ArrayCollection;
        $this->projects = new ArrayCollection;
        $this->scientistGroups = new ArrayCollection();
        $this->address = new Address();
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

    public function addProject(Project $project)
    {
        if (!$this->projects->contains($project)) {
            $project->setScientist($this);
            $this->projects->add($project);
        }
    }

    public function getProjects()
    {
        return $this->projects;
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

    public function getStreet(): string
    {
        return $this->address->getStreet();
    }

    public function setStreet(string $street)
    {
        $this->address->setStreet($street);
    }

    public function getPostalCode(): string
    {
        return $this->address->getPostalCode();
    }

    public function setPostalCode(string $postalCode)
    {
        $this->address->setPostalCode($postalCode);
    }

    public function getCity(): string
    {
        return $this->address->getCity();
    }

    public function setCity(string $city)
    {
        $this->address->setCity($city);
    }

    public function getCountry(): string
    {
        return $this->address->getCountry();
    }

    public function setCountry(string $country)
    {
        $this->address->setCountry($country);
    }
}