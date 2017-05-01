<?php

namespace App\Http\Controllers\v1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Flysystem\Exception;

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

        $this->middleware('auth:api' , ['only' =>['store','update','destroy'] ]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        //get paramaters from url
        //call service
        //return data to client

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
            $data = $request->json()->all();
            $lat = $data['latitude'];
            $lng = $data['longitude'];

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

        $this->pharmacies->validate($request->all());
        try{
            $pharmacy = $this->pharmacies->createPharmacy($request);
            return response()->json($pharmacy, 201);

        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }

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
        $this->pharmacies->validate($request->all());
        try{
            $pharmacy = $this->pharmacies->updatePharmacy($request, $id);
            return response()->json($pharmacy, 200);

        }
        catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        try{
            $pharmacy = $this->pharmacies->deletePharmacy($id);
            return response()->make('', 204);

        }
        catch (ModelNotFoundException $ex){
            throw $ex;
        }
        catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }

    }
}
