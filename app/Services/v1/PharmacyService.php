<?php

namespace App\Services\v1;
use App\Pharmacy;

/**
 * Class PharmacyService
 * @package App\Services\v1
 *
 */

class PharmacyService {

    /**
     * @return array
     */

    public function getPharmacies(){
        return $this->filterPharmacies(Pharmacy::all());
    }

    /**
     * @param $pharmacy
     * @return array
     */

    public function getPharmacy($pharmacyId){
        return $this->filterPharmacies(Pharmacy::where('pharmacy_id', $pharmacyId)->get());
    }

    /**
     * @param $pharmacies
     * @return array
     */
    protected function filterPharmacies($pharmacies){

        $data = [];

        foreach ($pharmacies as $pharmacy){
            $entry = [
                'name' => $pharmacy->name,
                'description' => $pharmacy->description,
               /* 'pharmacy_address' => $pharmacy->pharmacy_address,
                'longitude' => $pharmacy->longitude,
                'latitude' => $pharmacy->latitude,*/
                'phone_number' => $pharmacy->phone_number,
                'href' => route('pharmacies.show', ['id' => $pharmacy->pharmacy_id])

            ];

            $data[] = $entry;
        }

        return $data;
    }

}