<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    public function index(){
        $data = [
            'request' => request()->all(),
            'attachment' => request()->attachment,
        ];
        return response()->json($data);
    }
}
