<?php

namespace App\Repositories;

use App\Models\ThirdPartyInstruction;
use App\Models\VendorInvoice;

class VendorInvoiceRepository
{
    protected $vendorInvoice;

    public function __construct(VendorInvoice $vendorInvoice)
    {
        $this->vendorInvoice = $vendorInvoice;
    }

    public function addVendorInvoice($id, $invoiceData)
    {
        $invoiceData['third_party_instruction_id'] = $id;
        try {
            $instruction = ThirdPartyInstruction::find($id);
            $instruction->vendorInvoice()->create($invoiceData);
            $freshInstruction = $instruction->fresh();

            return [
                'success' => true,
                'id' => $freshInstruction['_id'],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
    public function deleteVendorInvoice($id, $invoiceData)
    {
        try {
            $invoice = VendorInvoice::find($id);
            if ($invoice) {
                $invoice->delete();
                return response()->json(['message' => 'Deleted successfully']);
            } else {
                return response()->json(['message' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
    public function updateVendorInvoice($id, $invoiceData)
    {
        try {
            $instruction = ThirdPartyInstruction::find($id);
            $instruction->vendorInvoice()->create($invoiceData);
            $freshInstruction = $instruction->fresh();

            return [
                'success' => true,
                'id' => $freshInstruction['_id'],
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }

}
