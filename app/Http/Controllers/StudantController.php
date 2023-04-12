<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studant;

class StudantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $studant = null;
        $response = null;
        $status_code = null;
        if (auth()->user()->user_role_id == 4) {
            $studant = Studant::where('ammart_id', auth()->user()->halqa_id)->get();

            if (count($studant) > 0) {
                $response = [
                    'data' => $studant,
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
        } else if (auth()->user()->user_role_id == 3) {
            $studant = Studant::where('ammart_id', auth()->user()->ammart_id)->get();

            if (count($studant) > 0) {
                $response = [
                    'data' => $studant,
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
            $studant = Studant::where('city', auth()->user()->city)->get();

            if (count($studant) > 0) {
                $response = [
                    'data' => $studant,
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
                $studant = Studant::get();
            } else {
                $studant = Studant::where('city', $request->input('city'))->get();
            }

            if (count($studant) > 0) {
                $response = [
                    'data' => $studant,
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
            'father_name' => 'required|string',
            'date_of_birth' => 'required',
            'permanent_address' => 'required|string',
            'city' => 'required|string',
            'tajneed_number' => 'required',
            'ammart_id' => 'required',
            'halqa_id' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'current_class' => 'required|string',
            'group' => 'required|string',
            'name_of_institution' => 'required|string',
            'current_education_status' => 'required',
            'year_of_education_completed' => 'required|string',
            'added_by' => 'required',
        ]);


        $studant = Studant::create($request->all());

        if ($studant) {
            $response = [
                'message' => 'studant created.',
                'data' => $studant,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'studant not found.', 'success' => false], 404);
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
        $studant = Studant::find($id);

        if ($studant) {
            $studant->update($request->all());

            $response = [
                'message' => 'Studant updated.',
                'data' => $studant,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'Studant not found.', 'success' => false], 404);
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
        $studant = Studant::find($id);

        if ($studant) {
            $studant->delete();
            return response()->json(['message' => 'Studant has been deleted.', 'success' => true], 200);
        } else {
            // handle the error, for example by returning a 404 response
            return response()->json(['error' => 'Studant not found.', 'success' => false], 404);
        }
    }
}
