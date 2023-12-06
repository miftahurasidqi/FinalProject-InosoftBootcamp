<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function downloadFile(Request $request)
    {
        // $path = $request->input('path', '');
        // $file = json_decode($request->input('file'), true);
        $name = $request->query('name', '');
        $path = $request->query('path', '');

        $filePath = storage_path('app/' . $path); // Ganti dengan path file yang ingin diunduh

        return response()->download($filePath, $name);

        // $response = FileService::downloadFile($name,$path);
        // return $response;

        // return response()->json($name);
    }
}
