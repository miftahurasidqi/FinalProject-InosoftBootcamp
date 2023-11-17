<?php

namespace App\Repositories;

use App\Models\ThirdPartyInstruction;

class ThirdPartyInstructionRepository
{
    protected $thirdpartyinstruction;

    public function __construct(ThirdPartyInstruction $thirdpartyinstruction)
    {
        $this->thirdpartyinstruction = $thirdpartyinstruction;
    }

    public function createInstructionRepository(array $data): array
    {
        try {
            $newData = new $this->thirdpartyinstruction($data);
            $newData->save();

            return [
                'success' => true,
                'data' => $newData->fresh(), // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'errors' => $e->getMessage(),
            ];
        }
    }
}
