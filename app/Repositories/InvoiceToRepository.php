<?php

namespace App\Repositories;

use App\Models\InvoiceTo;
use Illuminate\Support\Facades\Validator;

class InvoiceToRepository
{
    protected $invoiceTo;

    public function __construct(InvoiceTo $invoiceTo)
    {
        $this->invoiceTo = $invoiceTo;
    }

    public function store($data): String
    {
        $newData = new $this->invoiceTo;
        $newData->invoiceTo = $data['invoiceTo'];
        $newData->created_at = now(); // Gunakan fungsi now() untuk mendapatkan timestamp saat ini
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }

    /**
     * Untuk mengambil semua data InvoiceTo
     */
    public function all()
    {
        return $this->invoiceTo->get([]);
    }

    /**
     * Untuk mendapatkan InvoiceTo bedasarkan id
     *  */
    public function getById(string $id)
    {
        $invoiceTo = $this->invoiceTo->find(['_id' => $id]);
        return $invoiceTo;
    }

    /**
     * Untuk update invoiceTo
     */
    public function update($id, $invoiceTo)
    {
        $invoiceTo = InvoiceTo::find($id);
        $invoiceTo->update($invoiceTo);
        return $invoiceTo;
    }

    /**
     * Delete Data 
     *  */
    public function destroy(string $id)
    {
        $existInvoiceTo = $this->invoiceTo->find(['_id' => $id]);

        if (!$existInvoiceTo) {
            return false;
        }

        $this->invoiceTo->destroy(['_id' => $id]);
        return true;
    }
}
