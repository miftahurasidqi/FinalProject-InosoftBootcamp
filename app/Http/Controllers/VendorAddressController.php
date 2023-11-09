<?php

namespace App\Http\Controllers;

use App\Services\VendorAddressService;
use App\Services\VendroAddressService;
use Illuminate\Http\Request;

class VendorAddressController extends Controller
{
    protected $vendoraddressservice;

    public function __construct(VendorAddressService $vendoraddressservice)
    {
        $this->vendoraddressservice = $vendoraddressservice;
    }

    public function create(Request $request)
    {

        $data = $request->all();

        // var_dump(($data));
        // die();
        $result = $this->vendoraddressservice->createInstruction($data);

        if ($result['success']) {
            return response()->json([
                'message' => 'Create New 3rd Party Instruction success',
                'data' => [
                    'vendorAddress' => $result['data']->vendorAddress,
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to create 3rd Party Instruction',
                'errors' => $result['errors']
            ], 422); // 422 Unprocessable Entity status code for validation errors
        }
    }
}
