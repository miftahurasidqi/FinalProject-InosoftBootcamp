<?php

namespace App\Services;

use App\Repositories\ThirdPartyInstructionRepository;
use Illuminate\Support\Facades\Validator;

class ThirdPartyInstructionService
{
    protected $thirdpartyrepository;

    public function __construct(ThirdPartyInstructionRepository $thirdpartyrepository)
    {
        $this->thirdpartyrepository = $thirdpartyrepository;
    }

    public function createInstruction(array $data)
    {
        $validator = Validator::make($data, [
            'instructionType' => 'required|string',
            'linkTo' => 'required|array',
            'attentionOf' => 'required|string',
            'invoiceTo' => 'required|string',
            'assignedVendor' => 'required|string',
            'vendorAddress' => 'required|string',
            'vendorQuotationNo' => 'required|string',
            'customer' => 'required|string',
            'NoCustomerPO' => 'required|string',
            'status' => 'required|string',
            'costDetail' => 'required|array',
            'costDetail.costItem.*.description' => 'required|string',
            'costDetail.costItem.*.QTY' => 'required|numeric',
            'costDetail.costItem.*.UOM' => 'required|string',
            'costDetail.costItem.*.unitPrice' => 'required|numeric',
            'costDetail.costItem.*.GST' => 'required|numeric',
            'costDetail.costItem.*.currency' => 'required|string',
            'costDetail.costItem.*.vatAmount' => 'required|numeric',
            'costDetail.costItem.*.subTotal' => 'required|numeric',
            'costDetail.costItem.*.total' => 'required|numeric',
            'costDetail.grandTotal.*.currency' => 'required|string',
            'costDetail.grandTotal.*.vatAmount' => 'required|numeric',
            'costDetail.grandTotal.*.subTotal' => 'required|numeric',
            'costDetail.grandTotal.*.total' => 'required|numeric',
            'costDetail.notes' => 'string',
            'Attachment.*' => 'file|max:2048', // Validasi file, maksimum 2MB]);
        ]);


        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        return $this->thirdpartyrepository->create($data);
    }
}
