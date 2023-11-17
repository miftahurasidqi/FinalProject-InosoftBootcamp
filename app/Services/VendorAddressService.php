<?php

namespace App\Services;

use App\Repositories\VendorAddressRepository;
use Illuminate\Support\Facades\Validator;

class VendorAddressService
{
    protected $vendoraddressRepository;

    public function __construct(VendorAddressRepository $vendoraddressRepository)
    {
        $this->vendoraddressRepository = $vendoraddressRepository;
    }

    public function createVendorAddress($data): Object
    {
        $validator = Validator::make($data, [

            'vendorAddress' => 'required|string',

        ]);


        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->vendoraddressRepository->store($data);

            return response()->json(['Create New Vendor Address Success' => true, 'data' => $result], 200);
        }

        return $this->vendoraddressRepository->store($data);
    }

    public function getAll()
    {
        return $this->vendoraddressRepository->all();
    }

    public function getOne($id)
    {
        $result =  $this->vendoraddressRepository->getById($id);
        // var_dump($result);
        // die();
        if (!$result) {
            return response()->json(['Data Tidak Ditemukan' => true, 'data' => $result], 404);
        } else {
            return response()->json(['Data Ditemukan' => true, 'data' => $result], 200);
        }
    }

    public function update($id, $data)
    {
        $validator = Validator::make($data, [
            'invoiceTo' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->vendoraddressRepository->update($id, $data);

            if ($result) {
                return response()->json(['Update Vendor Address Success' => true, 'data' => $result], 200);
            } else {
                return response()->json(['error' => 'Vendor Address not found.'], 404);
            }
        }
    }

    public function delete($id)
    {
        $result =  $this->vendoraddressRepository->destroy($id);

        if ($result) {
            return response()->json(['Deleted Vendor Address Success' => true, 'id' => $result], 200);
        } else {
            return response()->json(['error' => 'Vendor Address not found.'], 404);
        }
    }
}
