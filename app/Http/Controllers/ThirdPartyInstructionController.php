<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use App\Services\ThirdPartyInstructionService;
use Illuminate\Http\Request;

class ThirdPartyInstructionController extends Controller
{
    protected $thirdpartyinstructionservice;

    public function __construct(
        ThirdPartyInstructionService $thirdpartyinstructionservice,
        FileService $fileService
    ) {
        $this->thirdpartyinstructionservice = $thirdpartyinstructionservice;
        $this->fileService = $fileService;

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
            $attachment = $this->fileService->saveMultipleFile($files);
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

    public function searchInstructions(Request $request)
    {
        $keyword = $request->query('keyWord', '');
        $tab = $request->query('status');
        $page = $request->query('page');
        $pageInt = intval($page);
        $status = [];
        if ($tab == 'open') {
            $status = ['draft', 'in progres'];
        } elseif ($tab == 'completed') {
            $status = ['cancelled', 'completed'];
        }

        // return response()->json([
        //     $pageInt,
        //     $status,
        //     $keyword,
        // ]);
        return $this->thirdpartyinstructionservice->searchInstructions($pageInt, $status, $keyword);
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
        // return response()->json($id);
        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->setToCompleted($id);
    }

    public function updateInstruction(Request $request, $id)
    {
        // Menangkap data JSON
        $editData = json_decode($request->input('data'), true);
        // Menangkap file []
        $files = $request->file('attachment');
        $attachment = [];

        // Mengiterasi setiap file yang diunggah
        if ($files) {
            $attachment = $this->fileService->saveMultipleFile($files);
        }
        // return response()->json([
        //     'id' => $id,
        //     'id2' => $editData,
        //     'id3' => $attachment,
        // ]);

        return $thirdPartyInstruction = $this->thirdpartyinstructionservice->updateInstruction($id, $editData, $attachment);
    }

}
