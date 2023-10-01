<?php
namespace App\Repositories;

use App\Models\Delegue;
use App\Repositories\RessourceRepository;

class DelegueRepository extends RessourceRepository{
    public function __construct(Delegue $delegue){
        $this->model = $delegue;
    }
}
