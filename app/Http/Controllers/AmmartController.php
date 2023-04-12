<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ammart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AmmartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ammarts = null;
        $response = null;
        $status_code = null;

        if (auth()->user()->user_role_id == 2) {
            $ammarts = Ammart::where('city', auth()->user()->city)->get();

            if (count($ammarts) > 0) {
                $response = [
                    'data' => $ammarts,
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
                $ammarts = Ammart::get();
            } else {
                $ammarts = Ammart::where('city', $request->input('city'))->get();
            }

            if (count($ammarts) > 0) {
                $response = [
                    'data' => $ammarts,
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
            'number' => 'required|string',
            'city' => 'required|string',
        ]);


        $ammart = Ammart::create($request->all());

        if ($ammart) {
            $response = [
                'message' => 'Ammart created.',
                'data' => $ammart,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'ammart not found.', 'success' => false], 404);
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
        // $ammart = Ammart::find($id);

        // if ($ammart) {
        //     $response = [
        //         'message' => 'Ammart found.',
        //         'data' => $ammart,
        //         'success' => true
        //     ];

        //     return response($response, 201);
        // } else {
        //     return response()->json(['message' => 'ammart not found.', 'success' => false], 404);
        // }
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
        $ammart = Ammart::find($id);

        if ($ammart) {
            $ammart->update($request->all());

            $response = [
                'message' => 'Ammart updated.',
                'data' => $ammart,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'ammart not found.', 'success' => false], 404);
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
        $ammart = Ammart::find($id);

        if ($ammart) {
            $ammart->delete();
            return response()->json(['message' => 'Ammart has been deleted.', 'success' => true], 200);
        } else {
            // handle the error, for example by returning a 404 response
            return response()->json(['error' => 'Record not found.', 'success' => false], 404);
        }
    }
}
