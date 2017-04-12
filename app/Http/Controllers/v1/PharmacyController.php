<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\v1\PharmacyService;

/**
 * Class PharmacyController
 * @package App\Http\Controllers\v1
 *
 */

class PharmacyController extends Controller
{

    protected $pharmacies;



    /**
     * PharmacyController constructor.
     * @param PharmacyService $service
     *
     */

    public function __construct(PharmacyService $service) {
        $this->pharmacies = $service ;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //call service
        //return data to client
        //get paramaters from url

        $latitude = 35.70025 ;
        $longitude = -0.56576 ;

        $parameters = request()->input();
        //$data = $this->pharmacies->getPharmacies($parameters);
        $data = $this->pharmacies->getNearestPharmacies($latitude,$longitude);
        return response()->json($data);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //call service
        $data = $this->pharmacies->getPharmacy($id);
        return response()->json($data);


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }
}
