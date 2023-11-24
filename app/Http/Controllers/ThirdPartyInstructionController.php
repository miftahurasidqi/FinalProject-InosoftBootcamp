<?php

namespace App\Http\Controllers;

use App\Services\ThirdPartyInstructionService;
use Illuminate\Http\Request;

class ThirdPartyInstructionController extends Controller
{
    protected $thirdpartyinstructionservice;

    public function __construct(ThirdPartyInstructionService $thirdpartyinstructionservice)
    {
        $this->thirdpartyinstructionservice = $thirdpartyinstructionservice;
    }

    public function store(Request $request)
    {
        // Menangkap data JSON
        $jsonData = json_decode($request->input('data'), true);
        // Menangkap file []
        $files = $request->file('attachment');
        $attachment = [];

        // Mengiterasi setiap file yang diunggah
        if ($files) {
            foreach ($files as $index => $file) {
                // Lakukan sesuatu dengan setiap file, misalnya menyimpannya ke direktori
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $attachment[] = $fileName;
            }
        }

        $costDetail = $jsonData['costDetail'];
        $costDetail['attachment'] = $attachment;
        $jsonData['costDetail'] = $costDetail;
        $linkToJson = $jsonData['linkTo'];
        // $linkTo = json_decode($linkToJson, true);
        // $jsonData['linkTo'] = ['mifta', 'dani'];

        // return response()->json([$linkToJson]);

        return $this->thirdpartyinstructionservice->createInstruction($jsonData);
    }

    public function getOpenInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['draft', 'in progres'];

        return $this->thirdpartyinstructionservice->getInstructions($pageInt, $status);
    }

    public function getCompletedInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['cancelled', 'completed'];

        return $this->thirdpartyinstructionservice->getInstructions($pageInt, $status);
    }
    // ===

    public function searchOpenInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['draft', 'in progres'];
        $keyword = $request->input('keyword', ''); // Mendapatkan nilai query string 'q' (default: '')

        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->searchInstructions($request, $pageInt, $status, $keyword);
    }

    public function searchCompletedInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['cancelled', 'completed'];
        $keyword = $request->input('keyword', ''); // Mendapatkan nilai query string 'q' (default: '')

        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->searchInstructions($request, $pageInt, $status, $keyword);

        // $thirdPartyInstruction = $this->thirdpartyinstructionservice->findCompleted($user_id, $keyword);
        // if (!$thirdPartyInstruction) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Sorry, ' . $keyword . ' can not be found in User ' . $user_id . '`s Vendor Management for status Canceled and Completed.',
        //     ]);
        // }
        // return $thirdPartyInstruction;
    }
}
