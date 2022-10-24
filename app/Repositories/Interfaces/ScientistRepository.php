<?php

namespace App\Repositories\Interfaces;

use Doctrine\Persistence\ObjectRepository;

interface ScientistRepository extends ObjectRepository
{
    public function findByName($name);
}