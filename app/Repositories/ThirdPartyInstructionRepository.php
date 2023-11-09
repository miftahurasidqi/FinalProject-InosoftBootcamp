<?php

namespace App\Repositories;

use App\Models\ThirdPartyInstruction;

class ThirdPartyInstructionRepository
{
    public function create(array $data)
    {
        return ThirdPartyInstruction::create($data);
    }
}
