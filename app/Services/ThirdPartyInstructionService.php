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
            'costDetail.notes' => 'string',
            'Attachment.*' => 'file|max:2048', // Validasi file, maksimum 2MB]);
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Ambil data vendorAddress dari service VendorAddress
        $vendorAddressData = $this->vendoraddressService->getAll($data['vendorAddress']);

        // Ambil data invoiceTo dari service InvoiceTo
        $invoiceToData = $this->invoicetoService->getAll($data['invoiceTo']);

        // Gabungkan data vendorAddress dan invoiceTo dengan data instruksi pihak ketiga
        $data['vendorAddress'] = $vendorAddressData;
        $data['invoiceTo'] = $invoiceToData;

        $result = $this->thirdPartyInstructionRepository->createInstructionRepository($data);

        return response()->json(['Create New Third Party Instruction Success' => true, 'data' => $result], 200);
    }


    public function getOpenByUserId($user_id)
    {
        return $this->thirdPartyInstructionRepository->getOpenDatasByUserId($user_id);
    }

    public function getCompletedByUserId($user_id)
    {
        return $this->thirdPartyInstructionRepository->getCompletedDatasByUserId($user_id);
    }

    public function findOpen($user_id, $keyword)
    {
        return $this->thirdPartyInstructionRepository->findOpenTab($user_id, $keyword);
    }

    public function findCompleted($user_id, $keyword)
    {
        return $this->thirdPartyInstructionRepository->findCompletedTab($user_id, $keyword);
    }

    // public function store($data)
    // {
    //     return $this->todoRepository->store($data);
    // }

    // public function update($todo, $update)
    // {
    //     $updated = $todo->fill($update);
    //     return $this->todoRepository->updated($updated);
    // }
}
