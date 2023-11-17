<?php

namespace App\Repositories;

use App\Models\CustomerContract;
use Illuminate\Support\Facades\Request;

class CustomerContractRepository
{
    protected $customerContract;

    public function __construct(CustomerContract $customerContract)
    {
        $this->customerContract = $customerContract;
    }

    public function store($data): String
    {
        $newData = new $this->customerContract;
        $newData->customerContract = $data['customerContract'];
        $newData->created_at = now(); // Gunakan fungsi now() untuk mendapatkan timestamp saat ini
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }

    /**
     * Untuk mengambil semua data customerContract
     */
    public function all()
    {
        return $this->customerContract->get([]);
    }

    /**
     * Untuk mendapatkan customerContract bedasarkan id
     *  */
    public function getById(string $id)
    {
        $customerContract = $this->customerContract->find(['_id' => $id]);
        return $customerContract;
    }

    /**
     * Untuk update customerContract
     */
    public function update(string $id, array $data)
    {
        $customerContract = $this->customerContract->find($id);

        if (!$customerContract) {
            return null; // Atau Anda dapat melempar exception jika tidak ditemukan
        }

        $customerContract->update([
            'customerContract' => $data['customerContract'],
        ]);

        return $customerContract->fresh();
    }

    /**
     * Delete Data 
     *  */
    public function destroy(string $id)
    {
        $existcustomerContract = $this->customerContract->find(['_id' => $id]);

        if (!$existcustomerContract) {
            return false;
        }

        $this->customerContract->destroy(['_id' => $id]);
        return true;
    }
}
