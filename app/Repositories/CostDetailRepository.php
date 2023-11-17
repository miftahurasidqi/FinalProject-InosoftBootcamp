<?php

namespace App\Repositories;

use App\Models\CostDetail;
use Illuminate\Support\Facades\Validator;

class CostDetailRepository
{
    protected $model;

    public function __construct(CostDetail $costDetail)
    {
        $this->model = $costDetail;
    }

    public function store(array $data)
    {
        $newData = new $this->model;
        $newData->costItem = $data['costItem'];
        $newData->grandTotal = $data['grandTotal'];
        $newData->description = $data['description'] ?? null;
        $newData->QTY = $data['QTY'] ?? null;
        $newData->UOM = $data['UOM'] ?? null;
        $newData->unitPrice = $data['unitPrice'] ?? null;
        $newData->GST = $data['GST'] ?? null;
        $newData->currency = $data['currency'] ?? null;
        $newData->vatAmount = $data['vatAmount'] ?? null;
        $newData->subTotal = $data['subTotal'] ?? null;
        $newData->total = $data['total'] ?? null;
        $newData->created_at = now();
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }

    /**
     * Untuk mengambil semua data costDetail
     */
    public function all()
    {
        // return $this->model->get([]);
        return $this->model->with('costItems', 'grandTotals')->get();
    }

    /**
     * Untuk mendapatkan costDetail bedasarkan id
     *  */
    public function getById(string $id)
    {
        $costDetail = $this->model->find(['_id' => $id]);
        return $costDetail;
    }

    /**
     * Untuk update costDetail
     */
    public function update($id, $costDetail)
    {
        $costDetail = CostDetail::find($id);
        $costDetail->update($costDetail);
        return $costDetail;
    }

    /**
     * Delete Data 
     *  */
    public function destroy(string $id)
    {
        $existcustomerContract = $this->model->find(['_id' => $id]);

        if (!$existcustomerContract) {
            return false;
        }

        $this->model->destroy(['_id' => $id]);
        return true;
    }

    /**
     * Get Data Relation CostDetail  
     *  */
    // public function getAllCostDetailsWithRelations()
    // {
    //     return $this->model->with('costItems', 'grandTotals')->get();
    // }
}
