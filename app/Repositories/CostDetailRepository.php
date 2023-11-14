<?php

namespace App\Repositories;

use App\Models\CostDetail;

class CostDetailRepository
{

    protected $costdetail;

    public function __construct(CostDetail $costdetail)
    {
        $this->costdetail = $costdetail;
    }

    public function store($data): Object
    {
        $newData = new $this->costdetail;
        $newData->title = $data['title'];
        $newData->description = $data['description'] ?? null; // Pastikan description diatur atau null jika tidak ada
        $newData->created_at = now(); // Gunakan fungsi now() untuk mendapatkan timestamp saat ini
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }
}
