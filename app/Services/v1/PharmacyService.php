<?php

namespace App\Services\v1;

use App\Pharmacy;

class PharmacyService {

    public function getPharmacies(){

        return Pharmacy::all();
    }

}