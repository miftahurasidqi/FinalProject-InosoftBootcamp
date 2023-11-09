<?php

namespace App\Services;

use App\Repositories\VendorAddressRepository;
use Illuminate\Support\Facades\Validator;

class VendorAddressService
{
    protected $vendoraddressrepository;

    public function __construct(VendorAddressRepository $vendoraddressrepository)
    {
        $this->vendoraddressrepository = $vendoraddressrepository;
    }

    public function createInvoiceTo(array $data)
    {
        $validator = Validator::make($data, [

            'vendorAddress' => 'required|string',

        ]);


        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        return $this->vendoraddressrepository->create($data);
    }
}
