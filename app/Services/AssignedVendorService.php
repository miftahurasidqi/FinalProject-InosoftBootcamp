<?php

namespace App\Services;

use App\Repositories\AssignedVendorRepository;
use Illuminate\Support\Facades\Validator;

class AssignedVendorService
{
    protected $assignedvendorRepository;

    public function __construct(AssignedVendorRepository $assignedvendorRepository)
    {
        $this->assignedvendorRepository = $assignedvendorRepository;
    }

    public function createAssignedVendor($data): String
    {
        $validator = Validator::make($data, [
            'assignedVendor' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->assignedvendorRepository->store($data);

            return response()->json(['Create New Assigned Vendor Success' => true, 'data' => $result], 200);
        }

        return $this->assignedvendorRepository->store($data);
    }

    public function getAll()
    {
        return $this->assignedvendorRepository->all();
    }

    public function getOne($id)
    {
        $result =  $this->assignedvendorRepository->getById($id);
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
            'assignedVendor' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $result = $this->assignedvendorRepository->update($id, $data);

            if ($result) {
                return response()->json(['Update Assigned Vendor Success' => true, 'data' => $result], 200);
            } else {
                return response()->json(['error' => 'Assigned Vendor not found.'], 404);
            }
        }
    }

    public function delete($id)
    {
        $result =  $this->assignedvendorRepository->destroy($id);

        if ($result) {
            return response()->json(['Deleted Assigned Vendor Success' => true, 'id' => $result], 200);
        } else {
            return response()->json(['error' => 'Assigned Vendor not found.'], 404);
        }
    }
}
