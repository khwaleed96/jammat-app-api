<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Halqa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HalqaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $halqas = null;
        $response = null;
        $status_code = null;

        if (auth()->user()->user_role_id == 3) {
            $halqas = Halqa::where('ammart_id', auth()->user()->ammart_id)->get();

            if (count($halqas) > 0) {
                $response = [
                    'data' => $halqas,
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
        } else if (auth()->user()->user_role_id == 2) {
            $halqas = Halqa::where('city', auth()->user()->city)->get();

            if (count($halqas) > 0) {
                $response = [
                    'data' => $halqas,
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
        } else {
            if ($request->input('city') == 'all') {
                $halqas = Halqa::get();
            } else {
                $halqas = Halqa::where('city', $request->input('city'))->get();
            }

            if (count($halqas) > 0) {
                $response = [
                    'data' => $halqas,
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
        }

        return response()->json($response, $status_code);
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
            'ammart_id' => 'required',
            'city' => 'required|string',
        ]);


        $halqa = Halqa::create($request->all());

        if ($halqa) {
            $response = [
                'message' => 'Halqa created.',
                'data' => $halqa,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'halqa not found.', 'success' => false], 404);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $halqa = Halqa::find($id);

        if ($halqa) {
            $halqa->update($request->all());

            $response = [
                'message' => 'Halqa updated.',
                'data' => $halqa,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'halqa not found.', 'success' => false], 404);
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
        $halqa = Halqa::find($id);

        if ($halqa) {
            $halqa->delete();
            return response()->json(['message' => 'halqa has been deleted.', 'success' => true], 200);
        } else {
            // handle the error, for example by returning a 404 response
            return response()->json(['error' => 'Record not found.', 'success' => false], 404);
        }
    }
}
