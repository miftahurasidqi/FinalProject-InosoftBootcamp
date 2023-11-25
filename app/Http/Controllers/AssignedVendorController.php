<?php

namespace App\Http\Controllers;

use App\Services\AssignedVendorService;
use Illuminate\Http\Request;

class AssignedVendorController extends Controller
{
    protected $assignedvendorService;

    public function __construct(AssignedVendorService $assignedvendorService)
    {
        $this->assignedvendorService = $assignedvendorService;
    }

    public function store(Request $request)
    {
        return $this->assignedvendorService->createAssignedVendor($request->all());
    }

    public function getAssignedVendorList()
    {
        return $this->assignedvendorService->getAll();
    }

    public function show($id)
    {
        return $this->assignedvendorService->getOne($id);
    }

    public function delete($id)
    {
        return $this->assignedvendorService->delete($id);
    }
}
