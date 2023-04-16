<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::get();
        $response = null;
        $status_code = null;

        if (count($cities) > 0) {
            $response = [
                'data' => $cities,
                'success' => true
            ];
            $status_code = 200;
        } else {
            $response = [
                'error' => 'No data found',
                'success' => false
            ];
            $status_code = 400;
        }

        return response()->json($response, $status_code);
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
        $request->validate([
            'name' => 'required|string',
        ]);

        $city = City::create($request->all());

        if ($city) {
            $response = [
                'message' => 'City created.',
                'data' => $city,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'Something went wrong.', 'success' => false], 404);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $city = City::find($id);

        if ($city) {
            $city->update($request->all());

            $response = [
                'message' => 'City updated.',
                'data' => $city,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'City not found.', 'success' => false], 404);
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
        $city = City::find($id);

        if ($city) {
            $city->delete();
            return response()->json(['message' => 'City has been deleted.', 'success' => true], 200);
        } else {
            // handle the error, for example by returning a 404 response
            return response()->json(['error' => 'Record not found.', 'success' => false], 404);
        }
    }
}
