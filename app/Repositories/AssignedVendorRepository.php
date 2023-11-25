<?php

namespace App\Repositories;

use App\Models\AssignedVendor;
use Illuminate\Support\Facades\Validator;

class AssignedVendorRepository
{
    protected $assignedVendor;

    public function __construct(AssignedVendor $assignedVendor)
    {
        $this->assignedVendor = $assignedVendor;
    }

    public function store($data): String
    {
        $newData = new $this->assignedVendor;
        $newData->assignedVendor = $data['assignedVendor'];
        $newData->created_at = now(); // Gunakan fungsi now() untuk mendapatkan timestamp saat ini
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }

    /**
     * Untuk mengambil semua data assignedVendor
     */
    public function all()
    {
        return $this->assignedVendor->get([]);
    }

    /**
     * Untuk mendapatkan assignedVendor bedasarkan id
     *  */
    public function getById(string $id)
    {
        $assignedVendor = $this->assignedVendor->find(['_id' => $id]);
        return $assignedVendor;
    }

    /**
     * Untuk update assignedVendor
     */
    public function update($id, $assignedVendor)
    {
        $assignedVendor = AssignedVendor::find($id);
        $assignedVendor->update($assignedVendor);
        return $assignedVendor;
    }

    /**
     * Delete Data 
     *  */
    public function destroy(string $id)
    {
        $existassignedvendor = $this->assignedVendor->find(['_id' => $id]);

        if (!$existassignedvendor) {
            return false;
        }

        $this->assignedVendor->destroy(['_id' => $id]);
        return true;
    }
}
