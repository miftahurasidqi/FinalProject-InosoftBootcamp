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
                // Lakukan sesuatu dengan setiap file
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $attachment[] = $fileName;
            }
        }

        $costDetail = $jsonData['costDetail'];
        $costDetail['attachment'] = $attachment;
        $jsonData['costDetail'] = $costDetail;

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

    public function searchOpenInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['draft', 'in progress'];
        $keyword = $request->input('keyword', '');

        return $this->thirdpartyinstructionservice->searchInstructions($pageInt, $status, $keyword);
    }

    public function searchCompletedInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['cancelled', 'completed'];
        $keyword = $request->input('keyword', '');

        return $this->thirdpartyinstructionservice->searchInstructions($pageInt, $status, $keyword);
    }

    public function setInstructionToCompleted($id)
    {
        // return response()->json($id);
        return $this->thirdpartyinstructionservice->setToCompleted($id);
    }

    public function getInstructionById($id)
    {
        return $this->thirdpartyinstructionservice->getInstructionByIdService($id);
    }


    public function setInstructionToCanceled(Request $request, $id, $statusInfo)
    {

        return $this->thirdpartyinstructionservice->setToCanceled($request, $id, $statusInfo);
    }

    public function destroy($id)
    {
        return $this->thirdpartyinstructionservice->deleteById($id);
    }
}
