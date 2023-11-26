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

    // belum
    public function searchOpenInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['draft', 'in progres'];
        $keyword = $request->input('keyword', '');

        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->searchInstructions($pageInt, $status, $keyword);
    }

    public function searchCompletedInstructions(Request $request)
    {
        $page = $request->input('page', '');
        $pageInt = intval($page);
        $status = ['cancelled', 'completed'];
        $keyword = $request->input('keyword', '');

        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->searchInstructions($pageInt, $status, $keyword);
    }
    public function getInstructionById(Request $request, $id)
    {
        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->getInstructionById($id);
    }
    public function destroy(Request $request, $id)
    {
        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->deleteById($id);
    }
    public function setInstructionToCanceled(Request $request, $id)
    {
        $statusInfo = json_decode($request->input('statusInfo'), true);
        $files = $request->file('statusAttachment');
        $attachment = [];

        // Mengiterasi setiap file yang diunggah
        if ($files) {
            foreach ($files as $index => $file) {
                // Lakukan sesuatu dengan setiap file menyimpannya ke direktori
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/cencel'), $fileName);
                $attachment[] = $fileName;
            }
        }
        $statusInfo['canceledAttachment'] = $attachment;
        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->setToCanceled($id, $statusInfo);
    }
    public function setInstructionToCompleted(Request $request, $id)
    {
        return response()->json($id);
        // return $thirdPartyInstruction = $this->thirdpartyinstructionservice->setToCompleted($id)
    }
}
