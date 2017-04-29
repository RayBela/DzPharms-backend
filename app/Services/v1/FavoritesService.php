<?php
/**
 * Created by PhpStorm.
 * User: Rayhane
 * Date: 29/04/2017
 * Time: 15:00
 */

namespace App\Services\v1;
use App\Favorite;

class FavoritesService
{

    protected $clauseProperties = [
        'user_id',
        'pharmacy_id'
    ];

    public function getFavorites($parameters){
        if (empty($parameters))
            return Favorite::all();
        else {
            $whereClauses = $this->getWhereClause($parameters);
            $favorites = Favorite::where($whereClauses)->get();

            return $favorites;
        }
    }


    public function getFavorite($favoriteId){
        return Favorite::where('favorite_id', $favoriteId)->get();
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


    public function createFavorite($req){

        //implement if a  pharmacy doesn't exist if($req->input('name'))

        $favorite = new Favorite();
        $favorite->user_id = $req->input('user_id');
        $favorite->pharmacy_id = $req->input('pharmacy_id');

        $favorite->save();

        return $favorite;

        // else show a error message
    }

    public function deleteFavorite($favoriteId){

        $favorite =  Favorite::where('favorite_id', $favoriteId)->firstOrFail();

        $favorite->delete();
    }

}