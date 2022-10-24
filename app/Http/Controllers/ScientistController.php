<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\ScientistRepository;

class ScientistController extends Controller
{
    private $scientists;

    public function __construct(ScientistRepository $scientists)
    {
        $this->scientists = $scientists;
    }

    public function index()
    {
        dd($this->scientists->findAll());
    }
}
