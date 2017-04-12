<?php

namespace App\Services\v1;
use App\Pharmacy;
use DB;

/**
 * Class PharmacyService
 * @package App\Services\v1
 *
 */

class PharmacyService {


    protected $clauseProperties = [
        'latitude',
        'longitude'
    ];

    /**
     * @return array
     */

    public function getPharmacies($parameters){
        if (empty($parameters))
            return $this->filterPharmacies(Pharmacy::all());
        else {
            $whereClauses = $this->getWhereClause($parameters);
            $pharmacies = Pharmacy::where($whereClauses)->get();

            return $this->filterPharmacies($pharmacies);


        }
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
                'pharmacy_address' => $pharmacy->pharmacy_address,
                'longitude' => $pharmacy->longitude,
                'latitude' => $pharmacy->latitude,
                'phone_number' => $pharmacy->phone_number,
                'href' => route('pharmacies.show', ['id' => $pharmacy->pharmacy_id])

            ];

            $data[] = $entry;
        }

        return $data;
    }

    public function getNearestPharmacies($lat,$lng){
        $circle_radius = 3959;
        $max_distance = 20;

        return $pharmacies = DB::select(
     'SELECT * FROM
                    (SELECT  pharmacy_id, name, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(latitude))))
                    AS distance
                    FROM pharmacies) AS distances
                WHERE distance < ' . $max_distance . '
                ORDER BY distance
                LIMIT 10 OFFSET 0
                
            ');
    }

    protected function getWhereClause($parameters) {
        $clause = [];

        foreach ($this->clauseProperties as $prop) {
            if (in_array($prop, array_keys($parameters))) {
                $clause[$prop] = $parameters[$prop];
            }
        }

        return $clause;
    }

}