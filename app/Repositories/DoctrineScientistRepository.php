<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ScientistRepository;
use Doctrine\ORM\EntityRepository;

class DoctrineScientistRepository extends EntityRepository implements ScientistRepository
{
    public function findByName($name)
    {
        return $this->findBy(['firstname' => $name]);
    }
}