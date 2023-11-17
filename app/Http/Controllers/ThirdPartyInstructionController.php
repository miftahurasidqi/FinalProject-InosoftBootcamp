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
}
