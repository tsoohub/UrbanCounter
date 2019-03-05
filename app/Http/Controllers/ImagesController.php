<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagesController extends Controller
{

    public function upload(Request $request) {
        try {
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $path = $request->post('path');
                if(empty($path)) {
                    $destinationPath = public_path('/data');
                } else {
                    $destinationPath = public_path('/data/'.$path);
                }
                $name = $request->post('name');
                $image->move($destinationPath, $name);
                return response()->json('success');
            }
        } catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
