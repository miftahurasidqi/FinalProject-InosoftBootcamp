<?php

namespace Mocking\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructionsController extends Controller
{
    public function getData()
    {
        $path = base_path() . "/Mocking/Json/get_all_data.json";
        $json = json_decode(file_get_contents($path), true);
        return response()->json($json);
    }
    public function postData(Request $request)
    {
        $path = base_path() . "/Mocking/Json/get_all_data.json";
        $instructions = json_decode(file_get_contents($path), true);
        $newInstruction = [
            'instructionType' => $request->input('instructionType'),
            'assignedVendor' => $request->input('assignedVendor'),
            'status' => $request->input('status'),
            // Tambahkan data lagi di sini
            // Sesuaikan dengan data di get_all_data
        ];
        $instructions['instructions'][] = $newInstruction;
        File::put($path, json_encode($instructions));
        return response()->json(['message' => 'Data inserted successfully']);
    }
}
