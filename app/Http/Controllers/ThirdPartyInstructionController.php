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



        // var_dump(($data));
        // die();
        $this->thirdpartyinstructionservice->createInstruction($request->all());

        // if ($result['success']) {
        //     return response()->json([
        //         'message' => 'Create New 3rd Party Instruction success',
        //         'data' => [
        //             'id' => $result[$data]->id,
        //         ]
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => 'Failed to create 3rd Party Instruction',
        //         'errors' => $result['errors']
        //     ], 422); // 422 Unprocessable Entity status code for validation errors
        // }

    }

    public function indexOpen()
    {
        return $this->thirdpartyinstructionservice->getOpenByUserIdtoArray();
    }

    public function indexCompleted()
    {
        return $this->thirdpartyinstructionservice->getCompletedByUserIdtoArray();
    }

    public function showOpen(Request $keyword,  $user_id)
    {
        $thirdPartyInstruction = $this->thirdpartyinstructionservice->findOpen($user_id, $keyword);

        if (!$thirdPartyInstruction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, ' . $keyword . ' can not be found in User ' . $user_id . '`s Vendor Management for status Draft and In Progress.',
            ]);
        }

        return $thirdPartyInstruction;
    }

    public function showCompleted(Request $keyword,  $user_id)
    {
        $thirdPartyInstruction = $this->thirdpartyinstructionservice->findCompleted($user_id, $keyword);

        if (!$thirdPartyInstruction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, ' . $keyword . ' can not be found in User ' . $user_id . '`s Vendor Management for status Canceled and Completed.',
            ]);
        }

        return $thirdPartyInstruction;
    }
}
