<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    public function info(Request $request)
    {
        return [
            'shop' => $request->hotel,
            'theme' => $request->hotel->themes()->wherePivot('status', 'ACTIVE')->first()
        ];
    }
}
