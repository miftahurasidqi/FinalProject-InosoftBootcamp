<?php

namespace App\Services;

use App\Repositories\VendorInvoiceRepository;

class VendorInvoiceService
{
    protected $vendorInvoiceRepository;

    public function __construct(VendorInvoiceRepository $vendorInvoiceRepository)
    {
        $this->vendorInvoiceRepository = $vendorInvoiceRepository;

    }

    public function createInvoice($id, $invoiceData)
    {
        $result = $this->vendorInvoiceRepository->addVendorInvoice($id, $invoiceData);
        return response()->json($result);
    }
    public function deleteInvoice($id)
    {
        $result = $this->vendorInvoiceRepository->deleteVendorInvoice($id);
        return response()->json($result);
    }

    public function updateInvoice($id, $invoiceData)
    {

        return response()->json([$id, $invoiceData]);
    }

}
