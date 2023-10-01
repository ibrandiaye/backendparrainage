<?php
namespace App\Repositories;

use App\Models\Region;
use App\Repositories\RessourceRepository;
use Illuminate\Support\Facades\DB;

class RegionRepository extends RessourceRepository{
    public function __construct(Region $region){
        $this->model = $region;
    }

}
