<?php

namespace App\Http\Controllers;

use App\Services\ThirdPartyInstructionService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ThirdPartyInstructionController extends Controller
{
    protected $user;
    protected $thirdPartyInstructionService;

    public function __construct(ThirdPartyInstructionService $thirdPartyInstructionService)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->thirdPartyInstructionService = $thirdPartyInstructionService;
    }

    public function indexOpen()
    {
        return $this->thirdPartyInstructionService->getOpenByUserId($this->user->id)->toArray();
    }

    public function indexCompleted()
    {
        return $this->thirdPartyInstructionService->getCompletedByUserId($this->user->id)->toArray();
    }

    public function showOpen($keyword)
    {
        $thirdPartyInstruction = $this->thirdPartyInstructionService->findOpen($this->user->id, $keyword);

        if (!$thirdPartyInstruction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, '.$keyword.' can not be found in User '.$this->user->id.'`s Vendor Management for status Draft and In Progress.',
            ]);
        }

        return $thirdPartyInstruction;
    }

    public function showCompleted($keyword)
    {
        $thirdPartyInstruction = $this->thirdPartyInstructionService->findCompleted($this->user->id, $keyword);

        if (!$thirdPartyInstruction) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, '.$keyword.' can not be found in User '.$this->user->id.'`s Vendor Management for status Canceled and Completed.',
            ]);
        }

        return $thirdPartyInstruction;
    }
}
