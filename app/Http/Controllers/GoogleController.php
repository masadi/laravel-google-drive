<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class GoogleController extends Controller
{
    public function index(){
        $path = request()->attachment->store(request()->npsn, 'google');
        //return $path;
        $data = [
            'path' => $path,
            'new_path' => Str::of($path)->basename(),
        ];
        return response()->json($data);
    }
    private function create_folder($folder){
        return Storage::cloud()->makeDirectory($folder);
    }
    private function upload_file($folder, $file){
        return Storage::cloud()->makeDirectory($folder.'/'.$file);
    }
    public function get(){
        $filename = request()->filename;
        $rawData = Storage::cloud()->get($filename); // raw content
        $file = Storage::cloud()->getAdapter()->getMetadata($filename); // array with file info
        return response()->json(['file' => $file]);
        return response($rawData, 200)
            ->header('ContentType', $file['mimetype'])
            ->header('Content-Disposition', "attachment; filename=$filename");
    }
}
