<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\v1\PharmacyService;
use League\Flysystem\Exception;

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
        $data = $this->pharmacies->getPharmacies($parameters);
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


    public function displayNearestPharms(Request $request){

        try{
            $lat = request()->input('latitude');
            $lng = request()->input('longitude');

            $data = $this->pharmacies->getNearestPharmacies($lat,$lng);
            return response()->json($data);

        } catch (Exception $exception) {
            $exception->getMessage();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        /*try{



        } catch (Exception $exception) {
            $exception->getMessage();
        }*/

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
