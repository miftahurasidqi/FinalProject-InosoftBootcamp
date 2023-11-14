<?php

namespace Mocking\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class InstructionsController extends Controller

{

    public function getOpenInstructions(Request $request)
    {
        $page = $request->input('page', ''); // Mendapatkan nilai query string 'page' (default: '')
        $pageInt = intval($page);            // mengubah tipe data page menjadi integer

        $path = base_path() . "/Mocking/Json/get_all_data.json";

        $data = json_decode(file_get_contents($path));        // Membaca isi file JSON menjadi objek PHP
        $instructions = $data->openInstructions;                  // Mendapatkan instruksi yang ada dalam objek
        $perPage = 10;                                        // Menghitung berapa banyak data yang akan diambil per halaman
        $startIndex = ($pageInt - 1) * $perPage;                 // Menghitung indeks awal untuk halaman yang diminta
        $pagedInstructions = array_slice($instructions, $startIndex, $perPage);        // Mengambil data dari instruksi berdasarkan halaman yang diminta

        $size = count($pagedInstructions);
        $totalData = count($instructions);
        $totalPages = ceil($totalData / $perPage);

        $response = [
            'instructions' => $pagedInstructions,
            'page' => [
                'size' => $size,
                'totalData' => $totalData,
                'totalPages' => $totalPages,
                'currrentPage' => $pageInt,
            ]
        ];
        return response()->json($response);
    }

    public function getCompletedInstructions(Request $request)
    {
        $page = $request->input('page', ''); // Mendapatkan nilai query string 'page' (default: '')
        $pageInt = intval($page);            // mengubah tipe data page menjadi integer

        $path = base_path() . "/Mocking/Json/get_all_data.json";

        $data = json_decode(file_get_contents($path));        // Membaca isi file JSON menjadi objek PHP
        $instructions = $data->completedInstructions;                  // Mendapatkan instruksi yang ada dalam objek
        $perPage = 10;                                        // Menghitung berapa banyak data yang akan diambil per halaman
        $startIndex = ($pageInt - 1) * $perPage;                 // Menghitung indeks awal untuk halaman yang diminta
        $pagedInstructions = array_slice($instructions, $startIndex, $perPage);        // Mengambil data dari instruksi berdasarkan halaman yang diminta

        $size = count($pagedInstructions);
        $totalData = count($instructions);
        $totalPages = ceil($totalData / $perPage);

        $response = [
            'instructions' => $pagedInstructions,
            'page' => [
                'size' => $size,
                'totalData' => $totalData,
                'totalPages' => $totalPages,
                'currrentPage' => $pageInt,
            ]
        ];
        return response()->json($response);
    }

    public function searchOpenInstructions(Request $request)
    {

        $keyword = $request->input('keyword', ''); // Mendapatkan nilai query string 'q' (default: '')

        $page = $request->input('page', ''); // Mendapatkan nilai query string 'page' (default: '')
        $pageInt = intval($page);            // mengubah tipe data page menjadi integer

        // Lakukan sesuatu dengan nilai query string
        return response()->json([
            'keyword' => $keyword,
            'page' => $page

        ]);
    }

    public function searchCompletedInstructions(Request $request)
    {

        $keyword = $request->input('keyword', ''); // Mendapatkan nilai query string 'q' (default: '')

        $page = $request->input('page', ''); // Mendapatkan nilai query string 'page' (default: '')
        $pageInt = intval($page);            // mengubah tipe data page menjadi integer

        // Lakukan sesuatu dengan nilai query string
        return response()->json([
            'keyword' => $keyword,
            'page' => $page

        ]);
    }

    public function postData(Request $request)
    {
        $path = base_path() . "/Mocking/Json/get_all_data.json";
        $instructions = json_decode(file_get_contents($path), true);
        $costDetails = $request->input('costDetails');
        $newInstruction = [
            'id' => $request->input('id'),
            'instructionType' => $request->input('instructionType'),
            'assignedVendor' => $request->input('assignedVendor'),
            'attentionOf' => $request->input('attentionOf'),
            'quotationNo' => $request->input('quotationNo'),
            'invoiceTo' => $request->input('invoiceTo'),
            'vendorAddress' => $request->input('vendorAddress'),
            'costDetails' => $costDetails,
            'status' => $request->input('status'),
            // Tambahkan data lagi di sini
            // Sesuaikan dengan data di get_all_data
        ];
        $instructions['openInstructions'][] = $newInstruction;
        File::put($path, json_encode($instructions));
        return response()->json(['message' => 'Data inserted successfully']);
    }

    public function patchData(Request $request, $id)
    {
        $path = base_path() . "/Mocking/Json/get_all_data.json";
        $instructions = json_decode(file_get_contents($path), true);

        // Mencari instruction berdasarkan id
        $instructionId = array_search($id, array_column($instructions['openInstructions'], 'id'));

        if ($instructionId !== false) {
            $existingData['openInstructions'][$instructionId]['assignedVendor'] = $request->input('assignedVendor');
            $existingData['openInstructions'][$instructionId]['attentionOf'] = $request->input('attentionOf');
            $existingData['openInstructions'][$instructionId]['quotationNo'] = $request->input('quotationNo');
            $existingData['openInstructions'][$instructionId]['invoiceTo'] = $request->input('invoiceTo');
            $existingData['openInstructions'][$instructionId]['vendorAddress'] = $request->input('vendorAddress');

            // Untuk mengupdate costDetails
            $costDetails = $request->input('costDetails');
            if ($costDetails && is_array($costDetails)) {
                $instructions['openInstructions'][$instructionId]['costDetails'] = $costDetails;
            }

            file_put_contents($path, json_encode($instructions));
            return response()->json(['message' => 'Data updated successfully']);
        }

        return response()->json(['message' => 'Instruction not found'], 404);
    }
}
