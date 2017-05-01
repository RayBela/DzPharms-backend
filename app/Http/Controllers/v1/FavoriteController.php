<?php

namespace App\Http\Controllers\v1;

use App\Services\v1\FavoritesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use League\Flysystem\Exception;


class FavoriteController extends Controller
{

    protected $favorites;

    public function __construct(FavoritesService $service){
        $this->favorites = $service;

        $this->middleware('auth:api' , ['only' =>['store','update','destroy'] ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parameters = request()->input();
        $data = $this->favorites->getFavorites($parameters);

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
        try{
            $favorite = $this->favorites->createFavorite($request);
            return response()->json($favorite, 201);

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
        //
        $data = $this->favorties->getFavorite($id);
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



    public function destroy($id)
    {
        try{
            $favorite = $this->favorites->deleteFavorite($id);
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
