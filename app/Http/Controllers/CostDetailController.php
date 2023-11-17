<?php

namespace App\Http\Controllers;

use App\Models\CustomerContract;
use App\Services\CostDetailService;
use App\Services\CustomerContractService;
use Illuminate\Http\Request;

class CostDetailController extends Controller
{
    protected $costdetailService;

    public function __construct(CostDetailService $costdetailService)
    {
        $this->costdetailService = $costdetailService;
    }

    public function store(Request $request)
    {
        return $this->costdetailService->createCostDetail($request->all());
    }

    public function getCostDetailList()
    {
        return $this->costdetailService->getAll();
    }

    public function show($id)
    {
        return $this->costdetailService->getOne($id);
    }

    public function delete($id)
    {
        return $this->costdetailService->delete($id);
    }
}
