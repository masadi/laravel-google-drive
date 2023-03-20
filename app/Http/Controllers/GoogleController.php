<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    public function index(){
        $path = request()->attachment->store(request()->npsn, 'google');
        //return $path;
        $data = [
            'request' => request()->all(),
            'attachment' => request()->attachment,
            'path' => $path,
        ];
        return response()->json($data);
    }
    private function create_folder($folder){
        return Storage::cloud()->makeDirectory($folder);
    }
    private function upload_file($folder, $file){
        return Storage::cloud()->makeDirectory($folder.'/'.$file);
    }
}
