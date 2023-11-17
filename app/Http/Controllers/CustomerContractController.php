<?php

namespace App\Http\Controllers;

use App\Models\CustomerContract;
use App\Services\CustomerContractService;
use Illuminate\Http\Request;

class CustomerContractController extends Controller
{
    protected $customercontractService;

    public function __construct(CustomerContractService $customercontractService)
    {
        $this->customercontractService = $customercontractService;
    }

    public function store(Request $request)
    {
        return $this->customercontractService->createCustomerContract($request->all());
    }

    public function getCustomerContractList()
    {
        return $this->customercontractService->getAll();
    }

    public function show($id)
    {
        return $this->customercontractService->getOne($id);
    }

    public function update($id, Request $request)
    {
        return $this->customercontractService->updateCustomerContract($id, $request->all());
    }


    public function delete($id)
    {
        return $this->customercontractService->delete($id);
    }
}
