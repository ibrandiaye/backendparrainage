<?php

namespace App\Imports;

use App\Models\Region;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RegionImport implements  ToArray, WithHeadingRow
{
    /**
    * @param ToArray $array
    */
    public function array(array $data)
    {

         foreach ($data as $key => $region) {
        Region::create([
            "nom"=>$region['nom']
        ]);
        }
       // dd($data);
}
}
