<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list()
    {

        if (auth()->user()->user_role_id == 1) {
            $admins = User::where('user_role_id', 2)->with('userRole')->with('ammart')->with('halqa')->get();
            $ammart_secretaries = User::where('user_role_id', 3)->with('userRole')->with('ammart')->with('halqa')->get();
            $halqa_secretaries = User::where('user_role_id', 4)->with('userRole')->with('ammart')->with('halqa')->get();

            $data = array(
                "admins" => $admins,
                "ammart_secretaries" => $ammart_secretaries,
                "halqa_secretaries" => $halqa_secretaries,
            );

            if ($admins || $ammart_secretaries || $halqa_secretaries) {

                $response = [
                    'data' => $data,
                    'success' => true
                ];

                return response($response, 200);
            } else {
                return response()->json(['error' => 'Something went wrong', 'success' => false], 500);
            }
        } else if (auth()->user()->user_role_id == 2) {
            $ammart_secretaries = User::where('city', auth()->user()->city)->where('user_role_id', 3)->with('userRole')->with('ammart')->with('halqa')->get();
            $halqa_secretaries = User::where('city', auth()->user()->city)->where('user_role_id', 4)->with('userRole')->with('ammart')->with('halqa')->get();

            $data = array(
                "ammart_secretaries" => $ammart_secretaries,
                "halqa_secretaries" => $halqa_secretaries,
            );

            if ($ammart_secretaries || $halqa_secretaries) {

                $response = [
                    'data' => $data,
                    'success' => true
                ];

                return response($response, 200);
            } else {
                return response()->json(['error' => 'Something went wrong', 'success' => false], 500);
            }
        } else {
            $halqa_secretaries = User::where('city', auth()->user()->city)->where('user_role_id', 4)->with('userRole')->with('ammart')->with('halqa')->get();

            $data = array(
                "halqa_secretaries" => $halqa_secretaries,
            );

            if ($halqa_secretaries) {

                $response = [
                    'data' => $data,
                    'success' => true
                ];

                return response($response, 200);
            } else {
                return response()->json(['error' => 'Something went wrong', 'success' => false], 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user && $user->user_role_id < auth()->user()->user_role_id || $user && $user->id < auth()->user()->id) {
            // Define which fields are allowed to be updated
            $allowedFields = [
                'name',
                'email',
                'phone',
                'password',
                'postal_address',
                'jammat',
                'ammart_id',
                'halqa_id',
                'user_role_id',
                'city',
                'deleted',
            ];

            // Filter the request data to only allow the allowed fields
            $data = $request->only($allowedFields);

            $user->update($data);

            $response = [
                'message' => 'user updated.',
                'data' => $user,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'ammart not found.', 'success' => false], 404);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {

            $user->update(['status' => $request->status]);

            $response = [
                'message' => 'user updated.',
                'data' => $user,
                'success' => true
            ];

            return response($response, 201);
        } else {
            return response()->json(['error' => 'user not found.', 'success' => false], 404);
        }
    }

    public function destroy()
    {
        $user = User::find(auth()->user()->id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Ammart has been deleted.', 'success' => true], 200);
        } else {
            // handle the error, for example by returning a 404 response
            return response()->json(['error' => 'Record not found.', 'success' => false], 404);
        }
    }
}
