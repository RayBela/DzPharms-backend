<?php
/**
 * Created by PhpStorm.
 * User: Rayhane
 * Date: 29/04/2017
 * Time: 15:13
 */

namespace App\Services\v1;
use App\Address;

class AddressService
{

    protected $clauseProperties = [
        'user_id',
    ];

    public function getAddresses($parameters){
        if (empty($parameters))
            return Address::all();
        else {
            $whereClauses = $this->getWhereClause($parameters);
            $addresses = Address::where($whereClauses)->get();

            return $addresses;

        }
    }


    public function getAddress($addressId){
        return Address::where('Address_id', $addressId)->get();
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

    public function createAddress($req){

        //implement if a  pharmacy doesn't exist if($req->input('name'))

        $address = new Address();
        $address->name = $req->input('name');
        $address->user_id = $req->input('user_id');
        $address->pharmacy_id = $req->input('pharmacy_id');
        $address->longitude = $req->input('longitude');
        $address->latitude = $req->input('latitude');

        $address->save();

        return $address;

        // else show a error message
    }

    public function updateAddress($req, $addressId){

        $address =  Address::where('address_id', $addressId)->firstOrFail();

        $address->name = $req->input('name');
        $address->user_id = $req->input('user_id');
        $address->pharmacy_id = $req->input('pharmacy_id');
        $address->longitude = $req->input('longitude');
        $address->latitude = $req->input('latitude');

        $address->save();

        return $address;
    }

    public function deleteAddress($addressId){

        $pharmacy =  Address::where('pharmacy_id', $addressId)->firstOrFail();

        $pharmacy->delete();

    }


}