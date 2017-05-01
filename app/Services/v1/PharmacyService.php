<?php

namespace App\Services\v1;
use App\Pharmacy;
use DB;
use Validator;


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

    protected $rules = [
        'name' => 'required',
        'pharmacy_address' => 'required',
        'longitude' => 'required|decimal',
        'latitude' => 'required|decimal'

    ];


    public function validate($pharmacy){

        $validator = Validator::make($pharmacy, $this->rules);

        $validator->validate();
    }

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

        return $pharms = DB::select(
     'SELECT * FROM
                    (SELECT  pharmacy_id, name, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(' . $lng . ')) +
                    sin(radians(' . $lat . ')) * sin(radians(latitude))))
                    AS distance
                    FROM pharmacies) AS distances
                WHERE distance < ' . $max_distance . '
                ORDER BY distance
                LIMIT 20 OFFSET 0
                
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

    public function createPharmacy ($req){

        //implement if a  pharmacy doesn't exist if($req->input('name'))

        $pharmacy = new Pharmacy();
        $pharmacy->description = $req->input('description');
        $pharmacy->name = $req->input('name');
        $pharmacy->phone_number = $req->input('phone_number');
        $pharmacy->pharmacy_address = $req->input('pharmacy_address');
        $pharmacy->longitude = $req->input('longitude');
        $pharmacy->latitude = $req->input('latitude');
        $pharmacy->user_id = $req->input('user_id');

        $pharmacy->save();

        return $this->filterPharmacies($pharmacy);

        // else show a error message
    }


    public function updatePharmacy ($req, $pharmacyId){

        $pharmacy =  Pharmacy::where('pharmacy_id', $pharmacyId)->firstOrFail();

        $pharmacy->description = $req->input('description');
        $pharmacy->name = $req->input('name');
        $pharmacy->phone_number = $req->input('phone_number');
        $pharmacy->pharmacy_address = $req->input('pharmacy_address');
        $pharmacy->longitude = $req->input('longitude');
        $pharmacy->latitude = $req->input('latitude');
        $pharmacy->user_id = $req->input('user_id');

        $pharmacy->save();

        return $this->filterPharmacies($pharmacy);

    }

    public function deletePharmacy ($pharmacyId){

        $pharmacy =  Pharmacy::where('pharmacy_id', $pharmacyId)->firstOrFail();

        $pharmacy->delete();

    }

}