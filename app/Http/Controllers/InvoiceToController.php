<?php

namespace App\Http\Controllers;

use App\Services\InvoiceToService;
use Illuminate\Http\Request;

class InvoiceToController extends Controller
{
    protected $invoicetoservice;

    public function __construct(InvoiceToService $invoicetoservice)
    {
        $this->invoicetoservice = $invoicetoservice;
    }

    public function create(Request $request)
    {

        $data = $request->all();

        // var_dump(($data));
        // die();
        $result = $this->invoicetoservice->createInstruction($data);

        if ($result['success']) {
            return response()->json([
                'message' => 'Create New 3rd Party Instruction success',
                'data' => [
                    'invoiceToName' => $result['data']->invoiceToName,
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
