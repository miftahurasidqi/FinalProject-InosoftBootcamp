<?php

namespace App\Services;

use App\Repositories\ThirdPartyInstructionRepository;
use Illuminate\Support\Facades\Validator;

class ThirdPartyInstructionService
{
    protected $thirdPartyInstructionRepository;
    protected $vendoraddressService;
    protected $invoicetoService;

    public function __construct(
        ThirdPartyInstructionRepository $thirdPartyInstructionRepository,
        VendorAddressService $vendoraddressService,
        InvoiceToService $invoicetoService
    ) {
        $this->thirdPartyInstructionRepository = $thirdPartyInstructionRepository;
        $this->vendoraddressService = $vendoraddressService;
        $this->invoicetoService = $invoicetoService;
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
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        $result = $this->thirdPartyInstructionRepository->createInstructionRepository($data);
        return response()->json([
            'data' => $result,
        ]);
    }

    public function getInstructions($page, $status)
    {
        return $this->thirdPartyInstructionRepository->getByStatus($page, $status);
    }

    public function searchInstructions($page, $status, $keyword)
    {
        return $this->thirdPartyInstructionRepository->searchInstruction($user_id, $keyword);
    }

}
