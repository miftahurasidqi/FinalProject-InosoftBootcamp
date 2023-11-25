<?php

namespace App\Repositories;

use App\Models\VendorAddress;
use Illuminate\Support\Facades\Validator;

class VendorAddressRepository
{
    protected $vendorAddress;

    public function __construct(VendorAddress $vendorAddress)
    {
        $this->vendorAddress = $vendorAddress;
    }

    public function store($data): String
    {
        $newData = new $this->vendorAddress;
        $newData->vendorAddress = $data['vendorAddress'];
        $newData->created_at = now(); // Gunakan fungsi now() untuk mendapatkan timestamp saat ini
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }

    /**
     * Untuk mengambil semua data VendorAddress
     */
    public function all()
    {
        return $this->vendorAddress->get([]);
    }

    /**
     * Untuk mendapatkan VendorAddress bedasarkan id
     *  */
    public function getById(string $id)
    {
        $vendorAddress = $this->vendorAddress->find(['_id' => $id]);
        return $vendorAddress;
    }

    /**
     * Untuk update vendorAddress
     */
    public function update($id, $vendorAddress)
    {
        $vendorAddress = VendorAddress::find($id);
        $vendorAddress->update($vendorAddress);
        return $vendorAddress;
    }

    /**
     * Delete Data 
     *  */
    public function destroy(string $id)
    {
        $existVendorAddress = $this->vendorAddress->find(['_id' => $id]);

        if (!$existVendorAddress) {
            return false;
        }

        $this->vendorAddress->destroy(['_id' => $id]);
        return true;
    }
}
