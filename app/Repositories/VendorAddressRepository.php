<?php

namespace App\Repositories;

use App\Models\VendorAddress;

class VendorAddressRepository
{
    public function create(array $data)
    {
        return VendorAddress::create($data);
    }
}
