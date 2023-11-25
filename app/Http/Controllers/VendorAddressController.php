<?php

namespace App\Http\Controllers;

use App\Services\VendorAddressService;
use Illuminate\Http\Request;

class VendorAddressController extends Controller
{
    protected $vendoraddressService;

    public function __construct(VendorAddressService $vendoraddressService)
    {
        $this->vendoraddressService = $vendoraddressService;
    }

    public function store(Request $request)
    {
        return $this->vendoraddressService->createVendorAddress($request->all());
    }

    public function getVendorAddressList()
    {
        return $this->vendoraddressService->getAll();
    }

    public function show($id)
    {
        return $this->vendoraddressService->getOne($id);
    }

    public function delete($id)
    {
        return $this->vendoraddressService->delete($id);
    }
}
