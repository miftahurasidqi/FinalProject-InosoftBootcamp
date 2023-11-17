<?php

namespace App\Services;

use App\Repositories\CustomerContractRepository;
use Illuminate\Support\Facades\Validator;

class CustomerContractService
{
    protected $customercontractRepository;

    public function __construct(CustomerContractRepository $customercontractRepository)
    {
        $this->customercontractRepository = $customercontractRepository;
    }

    public function createCustomerContract($data): String
    {
        $validator = Validator::make($data, [
            'customerContract' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->customercontractRepository->store($data);

            return response()->json(['Create New Customer Contract Success' => true, 'data' => $result], 200);
        }

        return $this->customercontractRepository->store($data);
    }

    public function getAll()
    {
        return $this->customercontractRepository->all();
    }

    public function getOne($id)
    {
        $result =  $this->customercontractRepository->getById($id);
        // var_dump($result);
        // die();
        if (!$result) {
            return response()->json(['Data Tidak Ditemukan' => true, 'data' => $result], 404);
        } else {
            return response()->json(['Data Ditemukan' => true, 'data' => $result], 200);
        }
    }

    public function updateCustomerContract($id, $data)
    {
        $validator = Validator::make($data, [
            'customerContract' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->customercontractRepository->update($id, $data);

            if ($result) {
                return response()->json(['Update Customer Contract Success' => true, 'data' => $result], 200);
            } else {
                return response()->json(['error' => 'Customer Contract not found.'], 404);
            }
        }
    }

    public function delete($id)
    {
        $result =  $this->customercontractRepository->destroy($id);

        if ($result) {
            return response()->json(['Deleted Customer Contract Success' => true, 'id' => $result], 200);
        } else {
            return response()->json(['error' => 'Customer Contract not found.'], 404);
        }
    }
}
