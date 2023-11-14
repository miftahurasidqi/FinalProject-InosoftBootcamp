<?php

namespace App\Http\Controllers;

use App\Services\CostDetailService;
use Illuminate\Http\Request;

class CostDetailController extends Controller
{
    protected $costdetailservice;

    public function __construct(CostDetailService $costdetailservice)
    {
        $this->costdetailservice = $costdetailservice;
    }

    public function create(Request $request)
    {

        $data = $request->all();

        // var_dump(($data));
        // die();
        $result = $this->costdetailservice->createInvoiceTo($data);

        if ($result['success']) {
            return response()->json([
                'message' => 'Create Invoice To success',
                'data' => [
                    'invoiceTo' => $result['data']->invoiceToName,
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
