<?php

namespace App\Repositories;

use App\Models\LinkTo;

class LinkToRepository
{
    protected $linkTo;

    public function __construct(LinkTo $linkTo)
    {
        $this->linkTo = $linkTo;
    }

    public function store($data): String
    {
        $newData = new $this->linkTo;
        $newData->linkTo = $data['linkTo'];
        $newData->created_at = now(); // Gunakan fungsi now() untuk mendapatkan timestamp saat ini
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }

    /**
     * Untuk mengambil semua data linkTo
     */
    public function all()
    {
        return $this->linkTo->get([]);
    }

    /**
     * Untuk mendapatkan linkTo bedasarkan id
     *  */
    public function getById(string $id)
    {
        $linkTo = $this->linkTo->find(['_id' => $id]);
        return $linkTo;
    }

    /**
     * Untuk update linkTo
     */
    public function update($id, $linkTo)
    {
        $linkTo = linkTo::find($id);
        $linkTo->update($linkTo);
        return $linkTo;
    }

    /**
     * Delete Data 
     *  */
    public function destroy(string $id)
    {
        $existlinkTo = $this->linkTo->find(['_id' => $id]);

        if (!$existlinkTo) {
            return false;
        }

        $this->linkTo->destroy(['_id' => $id]);
        return true;
    }
}
