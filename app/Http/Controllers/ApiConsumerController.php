<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use  Illuminate\Support\Facades\Http;

class ApiConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // obtener a 10 gatos autenticados
        $response = Http::get('https://api.thecatapi.com/v1/images/search?limit=10&breed_ids=beng&api_key=live_8c1ZejcMmfFL4HpMcDmGwwZwlJckbhQRs5E5IZKHSFQPQd7BzIAOuuhrRdgTAjky');

       return  $response->successful() 
            ?  $response->json()
            :   response()->json(['error' => 'Ocurrio un error al obtener la respuesta de la api'],400 ) ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
