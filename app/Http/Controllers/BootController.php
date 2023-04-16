<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Ammart;
use App\Models\Halqa;
use App\Models\UserRole;

class BootController extends Controller
{
    public function bootSetting()
    {
        $cities = City::get();
        $ammarts = Ammart::get();
        $halqas = Halqa::get();
        $userRoles = UserRole::get();

        $data = [
            'cities' => $cities,
            'ammarts' => $ammarts,
            'halqas' => $halqas,
            'user_roles' => $userRoles,
        ];
        $response = [
            'data' => $data,
            'success' => true
        ];
        $status_code = 200;
        return response()->json($response, $status_code);
    }
}
